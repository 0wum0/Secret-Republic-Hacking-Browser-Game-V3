# Upgrade Status: PHP 8.3/8.4 + Smarty 5.7.0

**Stand:** 2026-02-08
**Branch:** `cursor/system-php-8-3-kompatibilit-t-7f53`

## Status: ABGESCHLOSSEN

### Runtime-Verifizierung (mit echtem HTTP-Server + MariaDB)

| Route | HTTP | Bytes | Status |
|-------|------|-------|--------|
| `/` (Startseite) | 200 | 29652 | PASS |
| `/register` | 200 | 26302 | PASS |
| `/forum` | 200 | 29319 | PASS |
| `/shop` | 200 | 27653 | PASS |
| `/rankings` | 200 | 21946 | PASS |
| `/frequently-asked-questions` | 200 | 34776 | PASS |
| `/theWorld` | 200 | 29725 | PASS |
| `/search` | 200 | 22599 | PASS |
| `/blogs` | 200 | 21633 | PASS |
| `/dna` (Settings) | 200 | 28669 | PASS |
| `/bank` | 200 | 23010 | PASS |
| `/conversations` | 200 | 23633 | PASS |
| `/quests` | 200 | 27941 | PASS |
| `/skills` | 200 | 46364 | PASS |
| `/abilities` | 200 | 42963 | PASS |
| `/notes` | 200 | 21640 | PASS |
| `/grid` | 200 | 158163 | PASS |
| `/rewards` | 200 | 23064 | PASS |
| `/referrals` | 200 | 23598 | PASS |
| `/profile` | 200 | 25194 | PASS |
| `/train` | 200 | 23046 | PASS |
| `/data-points` | 200 | 24899 | PASS |
| `/hackdown` | 200 | 24515 | PASS |
| `/achievements` | 200 | 21634 | PASS |
| `/friends` | 200 | 22458 | PASS |

**Ergebnis: 25/25 Routes bestanden**

### End-to-End Tests

| Test | Status | Details |
|------|--------|---------|
| Registrierung | PASS | User in DB angelegt (id=18151, level=1) |
| Login | PASS | Session erstellt, Username in Response |
| Eingeloggte Seiten | PASS | Alle 25 Routes mit Session-Cookie getestet |
| Smarty 5 Rendering | PASS | Alle Templates kompilieren und rendern fehlerfrei |
| PHPUnit | PASS | 4/4 Tests, 23 Assertions |
| PHP Lint | PASS | 160 Dateien, 0 Fehler |

---

## Zusammenfassung der Aenderungen

### Composer / Dependencies
- `smarty/smarty`: v4.5.6 -> v5.7.0
- `php`: ^8.1 -> ^8.3

### Smarty 5.x Migration
- `new Smarty` -> `new \Smarty\Smarty`
- 41 PHP-Funktionen als Modifier registriert (ceil, number_format, date, count, rand, etc.)
- 6 Custom-Funktionen als Modifier registriert (date_fashion, profile_link, etc.)
- Template Case-Fixes: `date_Fashion` -> `date_fashion`, `number_Format` -> `number_format`

### PHP 8.3/8.4 Null-Safety
- `$_SESSION['premium'][...]` -> `empty()` Checks (12 Dateien)
- `array_merge()` mit `(array)` Cast fuer `session()` Returns
- Null-Coalescing fuer undefined Array-Keys in battle/server/user Klassen
- `$userAbilities`, `$types`, `$commandsInfluence` vor Nutzung initialisiert

### Bug-Fixes (pre-existing, durch PHP 8 striktere Typisierung aufgedeckt)
- `$_SESSTION` Typo -> `$_SESSION` in qclass.php
- `$server->server_id` -> `$this->server_id` in class.server.php
- `$component` -> `$app` in dealAppDamage()
- `$nr` (undefined) -> `1` in gclass.php
- `$info = "string"` -> `$info[] = "string"` in header.php/dna.php
- `"groups"` Tabelle -> `"user_groups"` in profile.php
- `user_bank.amount` DEFAULT 0 in DB.sql
- `check_fetch_task()` fehlender `$party` Parameter
- `train.php` MysqliDb where() Syntax-Fix
- `theWorld.php` number_format() mit String-Argument -> (float) Cast

### Vanilla Forum
Nicht im Projekt vorhanden. Eigenes Forum-System unter `includes/class/class.forum.php`.

---

## Deploy-Schritte

```bash
git pull origin cursor/system-php-8-3-kompatibilit-t-7f53
composer install --prefer-dist --no-dev
rm -rf includes/templates_c/* includes/cache/*
chmod -R 775 includes/templates_c/ includes/cache/ includes/configs/
# PHP 8.3/8.4, Apache mit mod_rewrite
```
