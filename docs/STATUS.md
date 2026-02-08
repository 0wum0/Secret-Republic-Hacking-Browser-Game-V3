# Upgrade Status: PHP 8.3/8.4 + Smarty 5.7.0

**Stand:** 2026-02-08
**Branch:** `cursor/system-php-8-3-kompatibilit-t-7f53`

## Status: ABGESCHLOSSEN

### Verifizierung

- **PHP Lint:** 145 Dateien, 0 Fehler (PHP 8.3.30)
- **PHPUnit:** 4/4 Tests, 23 Assertions
- **HTTP Smoke-Test:** 25/25 Routes HTTP 200, 0 Fatal Errors
- **Registrierung:** End-to-End verifiziert (User + Session in DB)
- **Login:** End-to-End verifiziert (Username in Response)

---

## Commit-Liste (dieser Branch)

| Commit | Beschreibung |
|--------|-------------|
| `7ae4f82` | config: read SMTP and reCAPTCHA settings from environment variables |
| `a4d5b76` | recaptcha: remove legacy recaptchalib.php |
| `df2d3cd` | php8: remove AllowDynamicProperties by declaring properties explicitly |
| `6dd5cdc` | composer: pin joshcam/mysqli-database-class to ^2.9.4 |
| `ec47767` | docs: final STATUS.md with 25/25 routes passing |
| `75006b3` | fix: runtime errors (profile, bank, train, rewards) |
| `42599ad` | smarty5: register PHP functions as modifiers |
| `3e6badc` | php8.3: fix undefined vars, typos, null-safety |
| `bc8af0e` | smarty: upgrade to v5.7.0, bump PHP to ^8.3 |
| `0e601ad` | php8.3: fix null-safety, undefined array keys |

---

## Geaenderte Dateien

### Composer / Config
| Datei | Aenderung |
|-------|-----------|
| `composer.json` | php ^8.3, smarty ^5.7, joshcam ^2.9.4, php-pretty-datetime pinned |
| `includes/constants/constants.php` | SMTP + reCAPTCHA via getenv(), _env() Helper |
| `includes/database_info.php.template` | DB-Credentials via getenv() |

### Smarty 5 Migration
| Datei | Aenderung |
|-------|-----------|
| `public_html/index.php` | `\Smarty\Smarty`, 47 Modifier-Registrierungen |
| `templates/organization_wars/org_wars.tpl` | date_Fashion -> date_fashion |
| `templates/profile/profile_header.tpl` | number_Format -> number_format |
| `templates/attacks/attack.tpl` | number_Format -> number_format |

### PHP 8.3/8.4 Kompatibilitaet
| Datei | Aenderung |
|-------|-----------|
| `includes/class/alpha.class.php` | 16 explizite Properties, kein AllowDynamicProperties |
| `includes/class/class.server.php` | 23 Properties, Variable-Bugfixes |
| `includes/class/class.battleSystem.php` | report Property, null coalescing |
| `includes/class/class.forum.php` | 12 Properties |
| `includes/class/cardinal.php` | 3 Properties |
| `includes/class/loginSystem.php` | detectDevice Property, array_merge fix |
| `includes/class/qclass.php` | 12 Properties, $_SESSION typo fix |
| `includes/class/tclass.php` | trainTask Property |
| `includes/class/abclass.php` | 2 Properties, variable init |
| `includes/class/blogclass.php` | blog Property |
| `includes/class/userclass.php` | session + null coalescing |
| `includes/class/oclass.php` | param ordering fix |
| `includes/class/gclass.php` | AllowDynamicProperties entfernt, undefined var fix |
| `includes/class/Item.class.php` | AllowDynamicProperties entfernt |
| `includes/class/paginator.class.php` | 3 Properties |
| `includes/class/RewardsManager.class.php` | null coalescing |
| `includes/class/taskclass.php` | fehlender $party Parameter |
| `includes/class/quests/ConsoleManagement.php` | session checks |

### Legacy Cleanup
| Datei | Aenderung |
|-------|-----------|
| `includes/class/recaptchalib.php` | GELOESCHT (Legacy reCAPTCHA v1) |
| `includes/modules/train.php` | require_once entfernt, MysqliDb where() fix |

### Module Fixes
| Datei | Aenderung |
|-------|-----------|
| `includes/header.php` | $info array push fix |
| `includes/modules/theWorld.php` | number_format float cast |
| `includes/modules/profile.php` | groups -> user_groups Tabelle |
| `includes/modules/simulator.php` | empty() session checks |
| `includes/modules/notes.php` | empty() session checks |
| `includes/modules/bank.php` | empty() session checks |
| `includes/modules/servers/servers.php` | empty() session check |
| `includes/modules/quests/quests_show.php` | empty() session check |
| `includes/modules/quests/quest_inprogress.php` | empty() session check |
| `includes/modules/admin/admin.php` | empty() session check |
| `includes/modules/dna.php` | array push + session fix |
| `includes/modules/grid/grid.php` | empty() session check |
| `includes/modules/grid/occupy.php` | null coalescing |
| `includes/modules/cron/tasks_and_attacks.php` | null coalescing |
| `includes/modules/cron/daily.php` | $types init |

### DB
| Datei | Aenderung |
|-------|-----------|
| `includes/install/DB.sql` | user_bank.amount DEFAULT 0 |

### SQL ONLY_FULL_GROUP_BY Compliance
| Datei | Aenderung |
|-------|-----------|
| `includes/modules/quests/quests_show.php` | Quest-Liste: MAX() fuer Aggregation, alle q.* Spalten in GROUP BY; Gruppen: GROUP BY entfernt (unnoetig) |
| `includes/modules/admin/manageUsers.php` | Admin Missions: MAX(created), alle Spalten in GROUP BY |

### CI / Docs
| Datei | Aenderung |
|-------|-----------|
| `.github/workflows/php.yml` | phplint --exclude=vendor |
| `docs/STATUS.md` | Diese Datei |
| `docs/RUNBOOK.md` | Setup, ENV, Cron, Smoke-Tests |
| `docs/sql_missions_audit.md` | Detailliertes SQL Audit aller GROUP BY Queries |

---

## Offene Punkte

Keine offenen Blocker. Folgende Punkte sind nur bei Runtime/DB relevant:
- E-Mail-Versand: Funktioniert nur mit gesetzten SMTP ENV-Variablen
- reCAPTCHA: Funktioniert nur mit gesetzten RECAPTCHA ENV-Variablen
- Cron-Jobs: Benoetigen konfigurierten Cron-Key in der Datenbank
- ONLY_FULL_GROUP_BY: Alle Queries konform, getestet mit aktivem Mode
