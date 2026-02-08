# Upgrade Status: PHP 8.3/8.4 + Smarty 5.7.0

**Stand:** 2026-02-08
**Branch:** `cursor/system-php-8-3-kompatibilit-t-7f53`

---

## Zusammenfassung

Das Projekt "Secret Republic Hacking Browser Game V3" wurde vollständig auf PHP 8.3/8.4 Kompatibilität geprüft und aktualisiert. Smarty wurde von v4.5.6 auf v5.7.0 (aktuellste stabile Version) migriert, inklusive der kritischen Modifier-Registrierung. Alle identifizierten PHP 8.3/8.4 Breaking Changes, Deprecations und Null-Safety-Probleme wurden behoben.

## Status: ABGESCHLOSSEN

| Bereich | Status | Details |
|---------|--------|---------|
| PHP 8.3/8.4 Syntax-Kompatibilität | Fertig | Alle 128 PHP-Dateien fehlerfrei (phplint) |
| Smarty Upgrade 4.5.6 -> 5.7.0 | Fertig | Namespace, Modifier-Registrierung, Template-Fixes |
| Smarty Template Rendering | Fertig | 11 Core-Templates erfolgreich gerendert |
| Composer Dependencies | Fertig | Alle auf kompatible Versionen aktualisiert |
| Null-Safety Fixes | Fertig | `$_SESSION`, `array_merge`, undefined array keys |
| Dynamic Properties | Fertig | `#[AllowDynamicProperties]` auf alle relevanten Klassen |
| DB/SQL Kompatibilität | Fertig | utf8mb4, ONLY_FULL_GROUP_BY kompatibel |
| Vanilla Forum | N/A | Nicht im Projekt vorhanden (eigenes Forum-System) |
| PHPUnit Tests | 4/4 bestanden | Alle Unit-Tests grün |
| Phplint | 0 Fehler / 128 Dateien | Alle Projektdateien syntaktisch korrekt |

---

## Phasen-Dokumentation

### Phase 1: Repo-Scan + Kompatibilitätsanalyse
- 113 eigene PHP-Dateien + 15 Vendor-relevante analysiert
- Kein Vanilla Forum im Repository (eigenes Forum unter `class.forum.php`)
- Smarty 4.5.6 war vorinstalliert, Templates nutzen Standard Smarty 3/4/5 Syntax
- Identifiziert: Null-Safety-Probleme, undefined array keys, Session-Zugriffe, Variable-Bugs

### Phase 2: Fatal Errors / TypeErrors / Deprecations behoben
**Commit 1 (17 Dateien):**
- `loginSystem.php`: `array_merge()` mit `(array)session()` Cast
- `oclass.php`: Required Parameter nach optionalem → `$user_id = null`
- `header.php`: `$info = "string"` → `$info[] = "string"`
- `class.server.php`: `$server->server_id` → `$this->server_id`, `$component` → `$app`
- `class.battleSystem.php`: Null-Coalescing für undefined Layer/Spy-Array-Keys
- `userclass.php`: Null-Coalescing für `$commandsInfluence`, `$_SESSION['premium']`
- 8 Module: `$_SESSION['premium'][x]` → `empty()` Checks
- `grid/occupy.php`, `cron/tasks_and_attacks.php`: Null-Coalescing

**Commit 2 (7 Dateien):**
- `gclass.php`: Undefined `$nr` → `$nrIndex = 1`
- `RewardsManager.class.php`: Null-Coalescing für `$skills[]`
- `abclass.php`: `$userAbilities` Initialisierung
- `qclass.php`: Typo `$_SESSTION` → `$_SESSION`
- `dna.php`: `$success = "Updated"` → `$success[]`, Session-Counter
- `grid/grid.php`: `empty()` für `$_SESSION['gridZone']`
- `cron/daily.php`: `$types` Array Initialisierung

### Phase 3: Composer Dependencies
- `smarty/smarty`: ^4.5.6 → ^5.7 (Major Upgrade)
- `php`: ^8.1 → ^8.3
- PHPMailer, PHPUnit, phplint bleiben auf kompatiblen Versionen

### Phase 4: Smarty 5.7.0 Migration (KRITISCH)
**Namespace-Änderung:**
- `new Smarty` → `new \Smarty\Smarty`

**Modifier-Registrierung (Smarty 5 Breaking Change):**
- 35 PHP built-in Funktionen als Modifier registriert (ceil, number_format, date, count, strtoupper, etc.)
- 6 Custom App-Funktionen als Modifier registriert (date_fashion, profile_link, romanic_number, sec2hms, ordinal, ordinalSuffix)

**Template Case-Sensitivity Fixes:**
- `date_Fashion` → `date_fashion` (organization_wars)
- `number_Format` → `number_format` (profile_header, attack)

### Phase 5: Vanilla Forum
- Nicht im Projekt vorhanden
- Eigenes Forum-System unter `includes/class/class.forum.php`
- Kein SSO, keine externe Integration

### Phase 6: DB/SQL-Kompatibilität
- Alle 100 Tabellen bereits auf utf8mb4 (vorherige PR)
- Keine GROUP BY Queries in PHP-Dateien
- ONLY_FULL_GROUP_BY kompatibel

### Phase 7: Smoke-Test Ergebnisse

#### PHP Lint
```
128 files, 0 errors (PHP 8.3.30)
```

#### PHPUnit
```
4 tests, 23 assertions - OK
```

#### Smarty 5 Template Rendering (Runtime-Test)
| Template | Status | Bytes |
|----------|--------|-------|
| home/splash_screen.tpl | PASS | 4275 |
| header_home.tpl | PASS | 4371 |
| footer_home.tpl | PASS | 3302 |
| pages/404.tpl | PASS | 4967 |
| setup.tpl | PASS | 5262 |
| forum/forum.tpl | PASS | 4728 |
| shop/shop.tpl | PASS | 5786 |
| dna/dna.tpl | PASS | 11509 |
| bank/bank.tpl | PASS | 5962 |
| search/search.tpl | PASS | 5397 |
| faq/faq.tpl | PASS | 4558 |

---

## Bekannte Restpunkte

### Ohne Runtime/DB nicht verifizierbar
1. **Login/Registrierung End-to-End**: Benötigt aktive DB-Verbindung
2. **Cron-Jobs**: Funktionieren nur mit DB
3. **E-Mail-Versand**: SMTP-Konfiguration erforderlich
4. **reCAPTCHA**: Google API Keys nötig

### Mittelfristige Empfehlungen
1. `joshcam/mysqli-database-class` (dev-master) - Version pinnen
2. `danielstjules/php-pretty-datetime` (dev-master) - Version pinnen
3. `#[AllowDynamicProperties]` - In PHP 9.0 entfernt, Properties deklarieren
4. `recaptchalib.php` (Legacy) - Kann entfernt werden

---

## Nächste Schritte (Deploy)

```bash
composer install --prefer-dist --no-dev
rm -rf includes/templates_c/* includes/cache/*
chmod -R 775 includes/templates_c/ includes/cache/ includes/configs/
# PHP 8.3+ als Runtime, Apache mit mod_rewrite
```
