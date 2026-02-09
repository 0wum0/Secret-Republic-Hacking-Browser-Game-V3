# Upgrade Notes: PHP 8.3/8.4 Kompatibilität

## Project Map (Phase 0)

### Entry Points
- **`index.php`** - Haupteingang, Frontcontroller, Smarty-Init, Routing (im Webroot)
- **`includes/modules/setup.php`** - Erstinstallation (DB-Import, Admin-Account)
- **`includes/modules/cron/cron.php`** - Cronjob-Dispatcher (daily, hourly, hackdown, rankings, resources, tasks_and_attacks)
- **`includes/modules/admin/admin.php`** - Admin-Panel
- **Kein eigenständiger API-Endpoint** - Alle Requests laufen über `index.php`

### Routing/Controller Flow
- Alle Requests werden via `.htaccess` Rewrite auf `index.php` umgeleitet
- `index.php` parst `PATH_INFO` / `QUERY_STRING` in `$GETQuery` Array
- Erster Segment = Modulname -> `includes/modules/{module}.php` oder `includes/modules/{module}/{module}.php`
- Module setzen `$tVars['display']` = Smarty Template-Pfad
- Am Ende rendert `index.php` das Template via `$smarty->display()`

### Datenbank
- **Config**: `includes/database_info.php` (erstellt durch Setup aus `.template`)
- **Schema**: `includes/install/DB.sql` (100 Tabellen, ~6000 Zeilen)
- **DB-Klasse**: `joshcam/mysqli-database-class` (MysqliDb via Composer)
- **Keine Migration-Engine** - Schema wird direkt per SQL-Import erstellt

### Templating (Smarty)
- **Version vorher**: Smarty 4.5.3
- **Version jetzt**: Smarty 4.5.6 (PHP 8.3/8.4 kompatibel)
- **Template Dir**: `templates/` (163 .tpl Dateien)
- **Compile Dir**: `includes/templates_c/`
- **Cache Dir**: `includes/cache/`
- **Config Dir**: `includes/configs/` (neu erstellt)
- **Keine Custom Smarty Plugins** - Standardfunktionalität wird genutzt
- Templates verwenden Standard Smarty 3/4 Syntax (`{$var}`, `{if}`, `{foreach}`, `{include}`)

### Vanilla Forum
- **NICHT im Repository enthalten**
- Das Projekt nutzt ein **eigenes Forum-System** (`includes/class/class.forum.php`)
- Forum-Templates liegen in `templates/forum/` (6 .tpl Dateien)
- Kein Vanilla Forum, kein SSO, keine externe Forum-Integration

### Composer Dependencies
| Package | Vorher | Nachher | Anmerkung |
|---------|--------|---------|-----------|
| `smarty/smarty` | 4.5.3 | ^4.5.6 | PHP 8.3/8.4 Bugfixes |
| `mobiledetect/mobiledetectlib` | ^2.8 | ^4.8 | API-Änderung: `Mobile_Detect` -> `\Detection\MobileDetect` |
| `phpmailer/phpmailer` | ^6.0 | ^6.9 | Security Patches |
| `google/recaptcha` | ^1.2 | ^1.3 | Kompatibilität |
| `phpunit/phpunit` | ^9.5 | ^10.5 | PHP 8.3+ kompatibel |
| `overtrue/phplint` | ^5.3 | ^9.0 | PHP 8.3+ kompatibel |
| `danielstjules/php-pretty-datetime` | dev-master | dev-master | Unverändert |
| `joshcam/mysqli-database-class` | dev-master | dev-master | Unverändert |
| `jbbcode/jbbcode` | ^1.3 | ^1.3 | Unverändert |

### Manuelle Libs (ohne Composer)
- `includes/class/recaptchalib.php` - Legacy reCAPTCHA v1 Lib (wird durch `google/recaptcha` Composer-Paket ersetzt/ergänzt)

### Server-Anforderungen
- **PHP**: 8.1+ (getestet mit 8.3, CI-Matrix inkl. 8.4)
- **Extensions**: `mysqli`, `mbstring`, `json`, `curl`, `session`, `gd`
- **Webserver**: Apache mit `mod_rewrite` oder Nginx (Config in `nginx.conf`)
- **Document Root**: Projektverzeichnis selbst (flat webroot layout)
- **Writable Dirs**: `includes/templates_c/`, `includes/cache/`, `includes/configs/`

---

## Geänderte Dateien und Gründe

### Composer / Dependencies
| Datei | Änderung |
|-------|----------|
| `composer.json` | PHP ^8.1 Requirement, Smarty ^4.5.6, mobiledetect ^4.8, phpmailer ^6.9, recaptcha ^1.3, phpunit ^10.5, phplint ^9.0 |

### PHP 8.3/8.4 Kompatibilität - Klassen
| Datei | Änderung |
|-------|----------|
| `includes/class/alpha.class.php` | `#[AllowDynamicProperties]` Attribut, `redirect()` Null-Safety Fixes |
| `includes/class/loginSystem.php` | Entfernt `session.hash_function`/`session.hash_bits_per_character` (PHP 8.1+), Fix `isTable()` -> `isTablet()`, `Mobile_Detect` -> `\Detection\MobileDetect` |
| `includes/class/oclass.php` | Old-Style Constructor `Organization()` -> `__construct()`, `var` -> `public` |
| `includes/class/Item.class.php` | Fix `serialize()` Fehlnutzung -> `array_merge()`, `var` -> `public`, `#[AllowDynamicProperties]` |
| `includes/class/RewardsManager.class.php` | Fix undefinierte Variable `$login_days_in_row` -> `$login_days_in_a_row` |
| `includes/class/class.server.php` | `var` -> `public` |
| `includes/class/registrationSystem.php` | Fix `array_pop(explode())` by-ref Warning -> `substr(strrchr())` |
| `includes/class/gclass.php` | `#[AllowDynamicProperties]` |
| `includes/class/paginator.class.php` | `var` -> `public`, `#[AllowDynamicProperties]` |
| `includes/class/recaptchalib.php` | `var` -> `public`, `#[AllowDynamicProperties]` |

### Smarty `number_format` Strict-Type Fix (PHP 8.3+)
| Datei | Änderung |
|-------|----------|
| `index.php` | `number_format` nicht mehr als Raw-PHP-Modifier registriert, sondern via `safe_number_format()` Wrapper (castet Argument #1 zu float). Behebt `Smarty\Extension\DefaultExtension::smarty_modifier_number_format(): Argument #1 must be ?float, string given`. |
| `templates/home/main_stats.tpl` | `\|number_format` nach `\|replace` aufgelöst: Zahl wird per `{assign}` vorformatiert, dann in `\|replace` eingesetzt. |
| `templates/train/train.tpl` | Gleicher Fix für 2 Stellen (`TRAIN_DECRYPT`, `TRAIN_FEELING_LUCKY`). |
| `templates/quests/questsCached.tpl` | Gleicher Fix für 2 Stellen (`QUEST_FINISHED_TIMES`, `QUEST_DONE_FROM`). |

> **WICHTIG nach Deploy**: Kompilierte Smarty-Templates müssen neu generiert werden.
> Entweder `includes/templates_c/` leeren (`rm -rf includes/templates_c/*`) oder
> Smarty mit `$smarty->force_compile = true;` einmalig laufen lassen.

### PHP 8.3/8.4 Kompatibilität - Core
| Datei | Änderung |
|-------|----------|
| `index.php` | Initialisierung `$GET = array()`, Smarty Config-Dir Fix, Null-Safety für Session-Zugriffe, `SR_ROOT` Konstante, `safe_number_format()` Modifier |
| `includes/header.php` | Initialisierung `$messenger`, `$voice`, `eval()` -> direkter Funktionsaufruf, Null-Safety für `$GET['i']` |
| `includes/functions.php` | Null-Safety für `$_SESSION['premium']`, `$pages` instanceof Check |
| `.htaccess` | Apache Rewrite + Security Rules (blockiert includes/, templates/, etc.) |

### Datenbank / MySQL 8
| Datei | Änderung |
|-------|----------|
| `includes/install/DB.sql` | Alle Tabellen von `latin1`/`utf8` auf `utf8mb4` + `utf8mb4_unicode_ci` konvertiert |
| `includes/modules/admin/questManagement.php` | Entfernt unnötiges `GROUP BY` (ONLY_FULL_GROUP_BY Kompatibilität) |

### CI/CD
| Datei | Änderung |
|-------|----------|
| `.github/workflows/php.yml` | PHP 8.3/8.4 Matrix, shivammathur/setup-php, phplint-Step, korrekter vendor-path |

---

## Runbook

### Voraussetzungen
```bash
# PHP 8.3 oder 8.4
php -v  # Muss >= 8.1 zeigen

# Benötigte Extensions
php -m | grep -E 'mysqli|mbstring|json|curl|session'

# Composer
composer --version
```

### Installation
```bash
# 1. Dependencies installieren
composer install --prefer-dist --no-progress

# 2. Datenbank-Konfiguration
cp includes/database_info.php.template includes/database_info.php
# -> DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT anpassen

# 3. DB-Schema importieren
mysql -u USER -p DBNAME < includes/install/DB.sql

# 4. Verzeichnisse beschreibbar machen
chmod -R 775 includes/templates_c/ includes/cache/ includes/configs/

# 5. Document Root = Projektverzeichnis (flat webroot)

# 6. Apache: mod_rewrite aktivieren
# Nginx: nginx.conf als Referenz nutzen
```

### Smoke Test Flow
1. **Setup**: `http://domain/setup` - Sollte Installations-Formular zeigen
2. **Startseite**: `http://domain/` - Splash Screen ohne PHP Errors
3. **Registrierung**: `http://domain/register` - Formular laden
4. **Login**: Login-Formular auf Startseite
5. **Dashboard**: Nach Login -> Index mit Tasks, News, Grid
6. **Quests**: `http://domain/quests` - Mission-Liste
7. **Forum**: `http://domain/forum` - Forum-Kategorien
8. **Shop**: `http://domain/shop` - Shop-Seite
9. **Admin**: `http://domain/admin` (als Admin-User)
10. **Cronjobs**: `http://domain/cron/key1/MDMwN2Q3OGRiYmM4Y2RkOWZjNTBmMzA4MzViZDZiNjQ=/daily/1`

### Produktion
```bash
# Error Reporting für Produktion
# In index.php ist bereits gesetzt:
# error_reporting(E_ALL ^E_NOTICE);
# ini_set('display_errors','0');

# PHP OPcache aktivieren (empfohlen)
# php.ini: opcache.enable=1

# Smarty Compile Check deaktivieren für Performance
# $smarty->compile_check = Smarty::COMPILECHECK_OFF;
```

---

## Offene Risiken / ToDos

1. **`joshcam/mysqli-database-class` (dev-master)**: Nutzt `dev-master`, keine feste Version. Bei Breaking Changes in upstream könnte dies Probleme verursachen. Empfehlung: Fork oder Version pinnen.

2. **`danielstjules/php-pretty-datetime` (dev-master)**: Ebenfalls `dev-master`. Minimal Risiko, da kleine Lib.

3. **`recaptchalib.php` (Legacy)**: Die alte reCAPTCHA v1 Lib liegt noch im Repo. Wird nicht aktiv genutzt (Alpha-Klasse nutzt `google/recaptcha` Composer-Paket), könnte aber bei einem `require` Definitionskonflikte verursachen. Empfehlung: Datei entfernen wenn sicher ist, dass sie nicht referenziert wird.

4. **Dynamic Properties**: `#[AllowDynamicProperties]` ist eine Übergangslösung. In PHP 9.0 wird dies entfernt. Langfristig sollten alle Properties explizit deklariert werden.

5. **`eval()` in header.php**: Wurde durch direkten Funktionsaufruf ersetzt (`$functionName()`). Funktioniert identisch, ist aber sicherer.

6. **Session Handling**: `session.hash_function` ist in PHP 8.1+ entfernt. Der Code prüft jetzt die PHP-Version. Für neue Installationen ist die Standard-Session-Konfiguration von PHP 8.x ausreichend.

7. **MySQL `int(11)` Display Width**: MySQL 8.0.17+ ignoriert Display Width für Integer-Typen. Die SQL-Dumps enthalten noch `int(11)` etc. Dies ist kosmetisch und hat keine funktionale Auswirkung.

8. **Smarty 5.x Migration**: Das Projekt nutzt Smarty 4.5.6 (latest 4.x). Ein Upgrade auf Smarty 5.x erfordert Namespace-Änderungen (`new Smarty` -> `new \Smarty\Smarty`) und ist als separates Projekt empfohlen.

9. **`mcrypt` in recaptchalib.php**: Die Legacy-reCAPTCHA-Lib nutzt `mcrypt_encrypt()`, welches in PHP 7.2+ entfernt wurde. Da diese Lib nicht aktiv genutzt wird (siehe Punkt 3), ist dies kein Runtime-Problem.

10. **Encoding der E-Mail-Templates**: E-Mail-Templates werden in der DB gespeichert. Bei der Migration zu `utf8mb4` sollten bestehende Daten auf korrekte Encoding geprüft werden.
