# I18N Project Map: Secret Republic V3

**Stand:** 2026-02-09

---

## Entry Points

| Entry Point | Datei | Beschreibung |
|---|---|---|
| Frontend | `public_html/index.php` | Front-Controller, Smarty-Init, Routing |
| Setup | `includes/modules/setup.php` | Erstinstallation, DB-Import |
| Cron | `includes/modules/cron/cron.php` | Cronjob-Dispatcher (kein UI) |
| Admin | `includes/modules/admin/admin.php` | Admin-Panel (via index.php Routing) |

## Smarty Integration

- **Smarty Version:** 5.7.0 (`\Smarty\Smarty`)
- **Template Dir:** `templates/` (~133 .tpl Dateien)
- **Compile Dir:** `includes/templates_c/`
- **Modifier Registration:** In `index.php` (PHP-Builtins + Custom)
- **Template Assign:** Via `$tVars` Array -> `$smarty->assign($tVars)` in `index.php`

## Wo Texte hart codiert sind

### Templates (~133 Dateien)
Alle UI-Texte sind direkt als englischer Klartext in .tpl Dateien:
- Navigation: `header_home.tpl`, `footer_home.tpl`, `admin/adminNavigation.tpl`
- Login/Register: `home/splash_screen.tpl`, `home/reg_form.tpl`
- Setup: `setup.tpl`
- Alle Modul-Templates (quests, grid, forum, blog, etc.)

### PHP-Dateien (~60+ Module)
Hartkodierte englische Strings in:
- `$errors[]`, `$success[]`, `$info[]`, `$warnings[]` Arrays
- `$_SESSION['error']`, `$_SESSION['success']` Meldungen
- `includes/header.php` (Tutorial-Texte)
- `includes/constants/tutorial.php` (Tutorial Steps)
- `includes/class/alpha.class.php` (E-Mail Templates)
- `includes/modules/*.php` (Fehlermeldungen, Bestätigungen)

### JavaScript
- Minimal: Meist serverseitig gerenderte Texte
- `layout/js/global.js` - Wenige Strings
- Inline `<script>` Blöcke in Templates

## Existierendes Language-System

**Keines vorhanden.** Kein i18n-Framework, keine Sprachdateien, kein Language-Switching.

## User/DB Language Storage

- **Tabelle `users`:** Kein `language` Feld vorhanden
- **Plan:** `language VARCHAR(2) DEFAULT 'de'` zu `users` hinzufügen
- **Fallback:** Cookie `sr_lang` + `$_SESSION['sr_lang']`

## I18N-Strategie

1. **PHP:** `t('KEY')` Funktion in `includes/i18n.php`
2. **Smarty:** `{$L.KEY}` via Assign des kompletten Language-Arrays
3. **Dictionaries:** `lang/de.php` + `lang/en.php` (PHP Arrays)
4. **Persistenz:** DB (User) > Cookie > Session > Default ('de')
