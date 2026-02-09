<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * Minimal stub for the $db global used by storage functions.
 * Records calls instead of talking to a real database.
 */
class FakeDb
{
    /** @var array Log of method calls for assertions */
    public array $log = [];

    public function where(string $col, mixed $val): self
    {
        $this->log[] = ['where', $col, $val];
        return $this;
    }

    public function delete(string $table, int $limit = 0): bool
    {
        $this->log[] = ['delete', $table, $limit];
        return true;
    }

    public function insert(string $table, array $data): int
    {
        $this->log[] = ['insert', $table, $data];
        return 1;
    }

    public function rawQuery(string $sql, array $params = []): array
    {
        $this->log[] = ['rawQuery', $sql, $params];
        return [];
    }

    public function join(string $table, string $on, string $type = ''): self
    {
        return $this;
    }

    public function getOne(string $table, string $columns = '*'): ?array
    {
        return null;
    }
}

/**
 * Minimal stub for the Server object expected by replaceComponentWithComponent().
 */
class FakeServer
{
    public int $server_id;
    /** @var array */
    public array $server = [];

    public function __construct(int $server_id = 1)
    {
        $this->server_id = $server_id;
    }

    public function recomputeServerResources(): void
    {
        // no-op in tests
    }
}

final class StorageTypeGuardsTest extends TestCase
{
    private FakeDb $fakeDb;

    protected function setUp(): void
    {
        global $db, $errors, $success;
        $this->fakeDb = new FakeDb();
        $db = $this->fakeDb;
        $errors = [];
        $success = [];

        // Ensure helpers are loaded exactly once.
        if (!function_exists('there_are_errors')) {
            require_once './includes/functions.php';
        }
        if (!function_exists('replaceComponentWithComponent')) {
            require_once './includes/modules/storage/storage_functions.php';
        }
    }

    // -----------------------------------------------------------------
    //  replaceComponentWithComponent – the main crash site
    // -----------------------------------------------------------------

    /**
     * Regression: passing the string "freeSlot" as $componentToReplace
     * must NOT throw a TypeError on PHP 8.3.
     */
    public function testReplaceWithFreeSlotStringDoesNotThrow(): void
    {
        $server = new FakeServer(42);
        $component = [
            'storage_id' => 100,
            'component_id' => 7,
            'type' => 5,
            'damage' => 10,
            'name' => 'RAM 4 GB',
        ];
        $componentToReplace = 'freeSlot';

        $result = replaceComponentWithComponent($server, $component, $componentToReplace, 1);

        $this->assertTrue($result, 'Function should return true on success');
        // After the call, $componentToReplace must have been normalised to an array.
        $this->assertIsArray($componentToReplace);
        $this->assertSame('Free slot', $componentToReplace['name']);
    }

    /**
     * When $componentToReplace is a valid array with relation_id,
     * the old component should be moved to storage.
     */
    public function testReplaceWithArrayComponentSucceeds(): void
    {
        $server = new FakeServer(42);
        $component = [
            'storage_id' => 100,
            'component_id' => 7,
            'type' => 5,
            'damage' => 10,
            'name' => 'RAM 4 GB',
        ];
        $componentToReplace = [
            'relation_id' => 55,
            'component_id' => 3,
            'damage' => 5,
            'name' => 'RAM 2 GB',
        ];

        $result = replaceComponentWithComponent($server, $component, $componentToReplace, 1);

        $this->assertTrue($result);
        // Verify the old component was inserted into storage.
        $insertCalls = array_filter($this->fakeDb->log, fn($e) => $e[0] === 'insert' && $e[1] === 'storage');
        $this->assertNotEmpty($insertCalls, 'Old component should be inserted into storage');
    }

    /**
     * When $componentToReplace is null/false, the function auto-detects.
     * With an empty DB result it should gracefully treat it as a free slot.
     */
    public function testReplaceWithNullComponentToReplaceFallsBackToFreeSlot(): void
    {
        $server = new FakeServer(42);
        $component = [
            'storage_id' => 100,
            'component_id' => 7,
            'type' => 5,
            'damage' => 10,
            'name' => 'RAM 4 GB',
        ];
        $componentToReplace = null;

        $result = replaceComponentWithComponent($server, $component, $componentToReplace, 1);

        $this->assertTrue($result);
        // Should have been normalised to the "Free slot" array.
        $this->assertIsArray($componentToReplace);
        $this->assertSame('Free slot', $componentToReplace['name']);
    }

    /**
     * If $component is not an array (e.g. a plain string), the function
     * must return false instead of crashing.
     */
    public function testReplaceReturnsFalseForScalarComponent(): void
    {
        $server = new FakeServer(42);
        $component = 'some-invalid-string';
        $componentToReplace = null;

        $result = replaceComponentWithComponent($server, $component, $componentToReplace, 1);

        $this->assertFalse($result, 'Should return false for non-array $component');
    }

    /**
     * If $component is a JSON-encoded string, it should be decoded automatically.
     */
    public function testReplaceDecodesJsonComponent(): void
    {
        $server = new FakeServer(42);
        $component = json_encode([
            'storage_id' => 100,
            'component_id' => 7,
            'type' => 5,
            'damage' => 10,
            'name' => 'RAM 4 GB',
        ]);
        $componentToReplace = 'freeSlot';

        $result = replaceComponentWithComponent($server, $component, $componentToReplace, 1);

        $this->assertTrue($result);
        // $component should now be an array (passed by reference).
        $this->assertIsArray($component);
        $this->assertSame(100, $component['storage_id']);
    }

    // -----------------------------------------------------------------
    //  fetchComponentFromStorage – guard against non-array DB result
    // -----------------------------------------------------------------

    /**
     * fetchComponentFromStorage must return false when DB returns a non-array.
     */
    public function testFetchComponentReturnsFalseOnEmptyResult(): void
    {
        $result = fetchComponentFromStorage(1, 999);
        $this->assertFalse($result);
    }

    // -----------------------------------------------------------------
    //  sellComponentFromStorage – guard against non-array
    // -----------------------------------------------------------------

    /**
     * sellComponentFromStorage must return false for a nonexistent item.
     */
    public function testSellComponentReturnsFalseOnMissing(): void
    {
        $result = sellComponentFromStorage(1, 999);
        $this->assertFalse($result);
    }
}
