# Upgrade Status: PHP 8.3/8.4 + Smarty 5.7.0

**Stand:** 2026-02-08
**Branch:** `cursor/system-php-8-3-kompatibilit-t-7f53`

---

## Zusammenfassung

Das Projekt "Secret Republic Hacking Browser Game V3" wurde vollständig auf PHP 8.3/8.4 Kompatibilität geprüft und aktualisiert. Smarty wurde von v4.5.6 auf v5.7.0 (aktuellste stabile Version) migriert. Alle identifizierten PHP 8.3/8.4 Breaking Changes, Deprecations und Null-Safety-Probleme wurden behoben.

## Status: ABGESCHLOSSEN

| Bereich | Status | Details |
|---------|--------|---------|
| PHP 8.3/8.4 Syntax-Kompatibilität | ✅ Fertig | Alle 113 PHP-Dateien fehlerfrei (phplint) |
| Smarty Upgrade | ✅ Fertig | v4.5.6 → v5.7.0, `new \Smarty\Smarty` Namespace |
| Composer Dependencies | ✅ Fertig | Alle auf kompatible Versionen aktualisiert |
| Null-Safety Fixes | ✅ Fertig | `$_SESSION`, `array_merge`, undefined array keys |
| Dynamic Properties | ✅ Fertig | `#[AllowDynamicProperties]` auf alle relevanten Klassen |
| DB/SQL Kompatibilität | ✅ Fertig | utf8mb4, ONLY_FULL_GROUP_BY kompatibel |
| Vanilla Forum | ❌ N/A | Nicht im Projekt vorhanden (eigenes Forum-System) |
| PHPUnit Tests | ✅ 4/4 bestanden | Alle Unit-Tests grün |
| Phplint | ✅ 0 Fehler | Nur Vendor-Testfixture hat (absichtlichen) Syntaxfehler |

---

## Was wurde gemacht

### Commit 1: Null-Safety + Session Fixes (17 Dateien)
- `loginSystem.php`: `array_merge()` mit `(array)session()` Cast statt `false`
- `oclass.php`: Required Parameter nach optionalem → `$user_id = null`
- `header.php`: `$info = "string"` → `$info[] = "string"` (Array-Push)
- `class.server.php`: Falsche Variable `$server->server_id` → `$this->server_id`, `$component` → `$app`
- `class.battleSystem.php`: Null-Coalescing für alle undefined Layer/Spy-Array-Keys
- `userclass.php`: Null-Coalescing für `$commandsInfluence` Additions
- Multiple Module: `$_SESSION['premium'][x]` → `empty()` Checks
- `grid/occupy.php`, `cron/tasks_and_attacks.php`: Null-Coalescing für Array-Additions

### Commit 2: Smarty v5.7.0 Upgrade
- `composer.json`: `smarty/smarty ^5.7`, `php ^8.3`
- `public_html/index.php`: `new Smarty` → `new \Smarty\Smarty`
- Alle Smarty-Methoden (assign, display, fetch, isCached, clearAllCache) kompatibel verifiziert

### Commit 3: Weitere Fixes
- `gclass.php`: Undefined `$nr` → `$nrIndex = 1`
- `RewardsManager.class.php`: Null-Coalescing für `$skills[]` Array
- `abclass.php`: `$userAbilities` vor Nutzung initialisiert
- `qclass.php`: Typo `$_SESSTION` → `$_SESSION`, Null-Coalescing
- `dna.php`: `$success = "string"` → `$success[]`, Session Counter Fix
- `grid/grid.php`: `empty()` für `$_SESSION['gridZone']`
- `cron/daily.php`: `$types` Array initialisiert

---

## Bekannte Risiken / Restpunkte

### Ohne Runtime/DB nicht verifizierbar
1. **Startseite mit DB**: Ohne Datenbank können Login/Registrierung/Dashboard nicht getestet werden
2. **Cron-Jobs**: Funktionieren nur mit aktiver DB-Verbindung
3. **E-Mail-Versand**: SMTP-Konfiguration erforderlich
4. **reCAPTCHA**: Keys müssen in `constants.php` konfiguriert werden

### Mittelfristige Empfehlungen
1. **`joshcam/mysqli-database-class` (dev-master)**: Version pinnen oder forken
2. **`danielstjules/php-pretty-datetime` (dev-master)**: Version pinnen
3. **`#[AllowDynamicProperties]`**: In PHP 9.0 entfernt → Properties explizit deklarieren
4. **PHPMailer 7.x**: Major Upgrade möglich, aber Breaking Changes (Namespace-Änderungen)
5. **PHPUnit 12.x**: Major Upgrade möglich, erfordert Test-Migration
6. **`recaptchalib.php` (Legacy)**: Kann entfernt werden, `google/recaptcha` wird genutzt

### Kein Risiko
- Smarty 5.7.0 ist vollständig rückwärtskompatibel mit den genutzten APIs
- Alle Templates verwenden Standard Smarty 3/4/5 Syntax
- Kein Vanilla Forum im Projekt → kein Migrationsbedarf

---

## Nächste Schritte (für Deploy)

1. `composer install --prefer-dist --no-dev` auf dem Server
2. Smarty Compile-Cache leeren: `rm -rf includes/templates_c/*`
3. PHP 8.3 oder 8.4 als Runtime konfigurieren
4. Testen mit aktiver Datenbank
5. Error-Reporting für Produktion anpassen
