# Secret Republic - Browser Based Futuristic PHP Hacker Game - V3

[![PHP Composer](https://github.com/nenuadrian/Secret-Republic-Hacking-Browser-Game-V3/actions/workflows/php.yml/badge.svg)](https://github.com/nenuadrian/Secret-Republic-Hacking-Browser-Game-V3/actions/workflows/php.yml)

<p align="center">

![Cover](screens/cover.jpg)

</p>

A PHP & MySQL browser-based, mobile-compatible role-playing game with a post-apocalyptic futuristic hacking theme. Built from the ground up over multiple iterations, this is the 3rd full version.

**Tech Stack:** PHP 8.3/8.4 | MySQL 5.7+ / 8.x / MariaDB 10.5+ | Smarty 5.7 | Composer 2.x | Bootstrap UI

> **Note:** The UI/theme is the original Bootstrap-based design and has not been redesigned.

**Links:**
- Live Demo: https://secretrepublic-v3.nenuadrian.com
- Audio Trailer: https://www.youtube.com/watch?v=6thfiGb-b7c
- [Medium article about the project journey](https://medium.com/@adrian.n/secret-republic-open-sourced-hacker-simulation-futuristic-rpg-browser-based-game-php-843d393cb9d7)
- V4 (mobile-first, fewer features): https://github.com/nenuadrian/Secret-Republic-Hacker-Game-ORPBG-Alpha

---

## Table of Contents

1. [Features](#features)
2. [Requirements](#requirements)
3. [Installation](#installation)
4. [Configuration](#configuration)
5. [Languages (DE/EN)](#languages-deen)
6. [Webserver Setup](#webserver-setup)
7. [Cronjobs](#cronjobs)
8. [Upgrade from Older Versions](#upgrade-from-older-versions)
9. [Changelog](#changelog)
10. [Framework Details](#framework-details)
11. [Tests](#tests)
12. [Troubleshooting](#troubleshooting)
13. [Security & Deployment](#security--deployment)
14. [Screenshots](#screenshots)
15. [Contributors & License](#contributors--license)

---

## Features

| Feature | Description |
|---|---|
| Missions | UNIX terminal-like missions with multi-objective design, party support, and a full mission designer in the admin panel. See `MISSION-GUIDES/` for PDFs. |
| Servers | Players build servers with upgradable hardware (motherboard, RAM, HDD, PSU) and installable software. |
| The Grid | Zone/cluster/node world map. Players conquer nodes, launch attacks, spy, and compete for territory. |
| Organizations | Guild system with ranks, internal forums, hacking points, and inter-org wars. |
| Hackdown | Weekly scheduled hacking competition (via cronjob). |
| Forums & Blogs | Integrated forum system with guild-private forums. Player blog system with articles and votes. |
| Skills & Abilities | Point-based skills and time-based abilities that enhance player stats. Configured in `includes/constants/`. |
| Tutorial | Multi-step guided tutorial with rewards. Configured in `includes/constants/tutorial.php`. |
| Rankings | Player and organization rankings, generated via cronjob. |
| Alpha Coins | Premium currency with an in-game shop and coupons. |
| Jobs & Training | Daily jobs and training mini-games for rewards. |
| Messaging & Friends | Thread-based messaging and friend system. |
| Admin Panel | User management, mission designer, group management, achievement management, and more. |
| Audio AI | Pre-recorded audio cues that play on specific in-game events (can be muted). |

---

## Requirements

| Component | Version | Required |
|---|---|---|
| PHP | **8.3** or **8.4** | Yes |
| MySQL / MariaDB | MySQL 5.7+ / 8.x or MariaDB 10.5+ | Yes |
| Webserver | Apache 2.4+ with `mod_rewrite` **or** Nginx | Yes |
| Composer | 2.x | Yes (for installation) |

### Required PHP Extensions

`mysqli`, `mbstring`, `json`, `curl`, `session`, `gd`

These are tested in CI (see `.github/workflows/php.yml`). Additionally, `xml` and `zip` are used during Composer operations.

### Writable Directories

The following directories must be writable by the webserver process:

| Directory | Purpose |
|---|---|
| `includes/templates_c/` | Smarty compiled templates |
| `includes/cache/` | Smarty cache |
| `includes/configs/` | Smarty config (created automatically if missing) |

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/nenuadrian/Secret-Republic-Hacking-Browser-Game-V3.git
cd Secret-Republic-Hacking-Browser-Game-V3
```

### 2. Install Composer Dependencies

```bash
composer install --prefer-dist --no-progress
```

Dependencies are installed into `includes/vendor/` (configured via `composer.json` `vendor-dir`).

### 3. Create a MySQL Database

```bash
mysql -u root -p -e "CREATE DATABASE secretrepublic CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 4. Option A: Automated Setup (Recommended)

1. Make sure `includes/database_info.php` does **not** exist yet (delete it if it does).
2. Upload all project files directly into your webserver's document root (e.g. Hostinger `public_html/`). **Do not** place them in a subfolder.
3. Open `http://your-domain/setup` in a browser.
4. Fill in the database connection details and admin account credentials.
5. The setup wizard imports the schema (`includes/install/DB.sql`) and creates your admin user.

![Setup Screenshot](screens/setup.png)

### 4. Option B: Manual Setup

```bash
# Import the database schema
mysql -u DB_USER -p secretrepublic < includes/install/DB.sql

# Create the database config from the template
cp includes/database_info.php.template includes/database_info.php
```

Edit `includes/database_info.php` with your database credentials:

```php
<?php
$db['server_name'] = 'localhost';
$db['username'] = 'your_db_user';
$db['password'] = 'your_db_password';
$db['name'] = 'secretrepublic';
$db['port'] = 3306;

return $db;
```

Then create your first user account via the registration page and promote it to admin:

```sql
-- After registering, set your user as full administrator
UPDATE user_credentials SET group_id = 1, email_confirmed = 1 WHERE uid = 1;
```

Log out and log back in for the admin role to take effect.

### 5. Set Directory Permissions

```bash
chmod -R 775 includes/templates_c/
chmod -R 775 includes/cache/
chmod -R 775 includes/configs/
```

---

## Configuration

All application settings are in **`includes/constants/constants.php`**. This file is already present in the repository with default/empty values. No `.env` file is used.

### SMTP (Email)

Email sending uses **PHPMailer** (via Composer). Configure the SMTP settings in `includes/constants/constants.php`:

```php
"smtp_host"     => "smtp.example.com",
"smtp_port"     => 587,          // 587 for TLS, 465 for SSL
"smtp_secure"   => "tls",        // "tls" or "ssl"
"smtp_username" => "your_smtp_user",
"smtp_password" => "your_smtp_password",
"smtp_from"     => "noreply@example.com",
"smtp_name"     => "Secret Republic",
```

If `smtp_host` is left empty, **no emails will be sent** but registration and all other flows will continue normally (non-blocking). A notice is written to the PHP error log so you can verify the skip.

#### Hostinger SMTP Setup

Hostinger provides a built-in SMTP server for every email account you create in the control panel.

1. **Create an email account** in Hostinger → *Emails* → *Email Accounts* (e.g. `noreply@yourdomain.com`).
2. Set the following values in `includes/constants/constants.php`:

```php
"smtp_host"     => "smtp.hostinger.com",
"smtp_port"     => 465,
"smtp_secure"   => "ssl",
"smtp_username" => "noreply@yourdomain.com",   // full email address
"smtp_password" => "YourEmailAccountPassword",  // the password you set in step 1
"smtp_from"     => "noreply@yourdomain.com",    // must match the email account
"smtp_name"     => "Secret Republic",
```

| Setting | Value | Notes |
|---|---|---|
| `smtp_host` | `smtp.hostinger.com` | Same for all Hostinger plans |
| `smtp_port` | `465` | SSL port (recommended by Hostinger) |
| `smtp_secure` | `ssl` | Use `ssl` with port 465 |
| `smtp_username` | `noreply@yourdomain.com` | The full email address you created |
| `smtp_password` | *(your email password)* | The password for the above email account |
| `smtp_from` | `noreply@yourdomain.com` | Must match `smtp_username` on Hostinger |
| `smtp_name` | `Secret Republic` | Display name shown in emails |

> **Tip:** If emails land in spam, add SPF and DKIM DNS records for your domain in Hostinger's DNS Zone Editor. Hostinger's guide: https://support.hostinger.com/en/articles/1583588

### reCAPTCHA v2

Registration and training pages use Google reCAPTCHA v2. Get your keys at https://www.google.com/recaptcha/admin/create and configure:

```php
'recaptcha_site_key'   => 'your_site_key',
'recaptcha_secret_key' => 'your_secret_key',
```

If keys are left empty, a warning is shown instead of the captcha widget.

### Other Settings

| Key | Default | Description |
|---|---|---|
| `contact_email` | `undefined@undefined.com` | Displayed contact email |
| `tutorialSteps` | `20` | Number of tutorial steps |
| `trainEvery` | `36000` (10h) | Cooldown between training sessions (seconds) |
| `timeBetweenJobs` | `43200` (12h) | Cooldown between jobs (seconds) |
| `max_tasks` | `3` | Max concurrent tasks per player |
| `defaultGroup` | `2` | Default user permission group on registration |

The `url` setting is auto-detected from `$_SERVER` and does not need manual configuration.

---

## Languages (DE/EN)

The game supports **German** (default) and **English**. The language can be switched at any time via a "DE | EN" toggle in the top-right corner of every page.

### How Switching Works

- Click **DE** or **EN** in the header, or append `?lang=de` / `?lang=en` to any URL.
- The selection is persisted via:
  1. **Database** (`users.language` column) for logged-in users
  2. **Cookie** (`sr_lang`, 1 year) for all visitors
  3. **Session** as fallback

### Translation Files

| File | Content |
|---|---|
| `lang/de.php` | German dictionary (~180 keys) |
| `lang/en.php` | English dictionary (~180 keys) |

Both files return a PHP array with translation keys and values.

### How to Add/Edit Translations

1. Open `lang/de.php` and `lang/en.php`.
2. Add a new key to **both** files (same key, different value):

```php
// lang/de.php
'MY_NEW_KEY' => 'Mein neuer Text',

// lang/en.php
'MY_NEW_KEY' => 'My new text',
```

3. Use in **templates**: `{$L.MY_NEW_KEY}`
4. Use in **PHP**: `t('MY_NEW_KEY')` or `t('MY_KEY', null, [':name' => $value])`

### Key Naming Convention

| Prefix | Usage |
|---|---|
| `NAV_` | Navigation items |
| `BTN_` | Buttons |
| `ERR_` | Error messages |
| `MSG_` | Success/info messages |
| `ADMIN_` | Admin panel |
| `INSTALL_` | Installer |
| `GAME_` | Generic game terms |
| `UI_` | UI elements |

### Technical Details

- **Loader:** `includes/i18n.php` provides `t()`, `get_lang()`, `set_lang()`
- **Smarty:** The full dictionary is assigned as `$L` to all templates
- **DB migration:** For existing installations, run: `ALTER TABLE users ADD COLUMN language VARCHAR(2) NOT NULL DEFAULT 'de';`

For detailed coverage, see `docs/I18N_CHECKLIST.md`.

---

## Webserver Setup

All files live directly in the webroot. Upload all project files to your webserver's document root directory (e.g. Hostinger `public_html/`). **Do not** create a subfolder like `public_html/sr/`.

The `.htaccess` file included in the project root handles URL rewriting **and** blocks direct access to sensitive directories (`includes/`, `templates/`, `tests/`, `docs/`, etc.) and files (`composer.json`, `*.md`, `*.sh`, `*.log`, etc.).

### Hostinger

1. Upload all files to `public_html/` via File Manager or FTP.
2. `index.php` must be directly inside `public_html/`, not in a subfolder.
3. `.htaccess` handles everything automatically (mod_rewrite is enabled by default on Hostinger).
4. Set up cronjobs in Hostinger's "Cron Jobs" panel (see [Cronjobs](#cronjobs)).

### Apache

`mod_rewrite` must be enabled. The `.htaccess` file in the project root handles all URL rewriting and security rules automatically. It supports `mod_php`, `mod_fcgid`, and PHP-FPM.

```bash
# Enable mod_rewrite (Debian/Ubuntu)
sudo a2enmod rewrite
sudo systemctl restart apache2
```

Make sure your Apache `<Directory>` block allows `.htaccess` overrides:

```apache
<Directory /path/to/webroot>
    AllowOverride All
</Directory>
```

### Nginx

A reference configuration is provided at `nginx.conf`. Key parts:

```nginx
server {
    root /path/to/project;
    index index.php;

    # Block sensitive directories
    location ~ ^/(includes|templates|tests|docs|lang|\.git)/ {
        deny all;
        return 403;
    }

    location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php-fpm.sock;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

---

## Cronjobs

Cronjobs are triggered via HTTP requests to the cron module. Each request requires an authentication key.

The **default cron key** is configured in `includes/modules/cron/cron.php`. Change this in production.

| Job | URL Path | Schedule |
|---|---|---|
| Attacks & Tasks | `/cron/key1/{CRON_KEY}/attacks/true` | Every 1-2 minutes |
| Resources | `/cron/key1/{CRON_KEY}/resources/true` | Every minute |
| Hourly | `/cron/key1/{CRON_KEY}/hourly/true` | Every hour |
| Daily | `/cron/key1/{CRON_KEY}/daily/true` | Once daily |
| Rankings | `/cron/key1/{CRON_KEY}/rankings/true` | Every hour |
| Hackdown | `/cron/key1/{CRON_KEY}/hackdown/true` | Once daily (Saturdays) |
| Hackdown End | `/cron/key1/{CRON_KEY}/hackdownEnd/true` | Once daily (Sundays) |
| Monthly | `/cron/key1/{CRON_KEY}/monthly/true` | Once monthly |

### Example Crontab (VPS / Dedicated Server)

```bash
# Attacks & tasks - every 2 minutes
*/2 * * * * wget -qO /dev/null http://your-domain/cron/key1/YOUR_KEY/attacks/true

# Resources - every minute
* * * * * wget -qO /dev/null http://your-domain/cron/key1/YOUR_KEY/resources/true

# Hourly tasks + rankings
0 * * * * wget -qO /dev/null http://your-domain/cron/key1/YOUR_KEY/hourly/true
5 * * * * wget -qO /dev/null http://your-domain/cron/key1/YOUR_KEY/rankings/true

# Daily
0 3 * * * wget -qO /dev/null http://your-domain/cron/key1/YOUR_KEY/daily/true

# Hackdown (Saturday start, Sunday end)
0 0 * * 6 wget -qO /dev/null http://your-domain/cron/key1/YOUR_KEY/hackdown/true
0 0 * * 0 wget -qO /dev/null http://your-domain/cron/key1/YOUR_KEY/hackdownEnd/true

# Monthly
0 4 1 * * wget -qO /dev/null http://your-domain/cron/key1/YOUR_KEY/monthly/true
```

### Hostinger Cron Jobs

In the Hostinger control panel, go to **Advanced > Cron Jobs** and add entries with these settings:

| Job | Command | Schedule |
|---|---|---|
| Attacks & Tasks | `wget -qO /dev/null https://your-domain/cron/key1/YOUR_KEY/attacks/true` | Every 2 minutes (`*/2 * * * *`) |
| Resources | `wget -qO /dev/null https://your-domain/cron/key1/YOUR_KEY/resources/true` | Every minute (`* * * * *`) |
| Hourly | `wget -qO /dev/null https://your-domain/cron/key1/YOUR_KEY/hourly/true` | Every hour (`0 * * * *`) |
| Rankings | `wget -qO /dev/null https://your-domain/cron/key1/YOUR_KEY/rankings/true` | Every hour (`5 * * * *`) |
| Daily | `wget -qO /dev/null https://your-domain/cron/key1/YOUR_KEY/daily/true` | Once daily (`0 3 * * *`) |
| Monthly | `wget -qO /dev/null https://your-domain/cron/key1/YOUR_KEY/monthly/true` | Once monthly (`0 4 1 * *`) |

> **Note:** Hostinger's free/shared plans may limit cron frequency. If you cannot run jobs every minute, combine attacks and resources into one cron at the lowest available interval.

Replace `YOUR_KEY` with the cron key configured in `includes/modules/cron/cron.php`.

---

## Upgrade from Older Versions

If you are upgrading from an older PHP 7.x/8.1 version of this project:

### 1. Update the Code

```bash
git pull origin master
```

### 2. Update Composer Dependencies

```bash
composer install --prefer-dist --no-progress
```

### 3. Clear Smarty Cache

This is **required** after upgrading, especially after the Smarty 4 to 5 migration:

```bash
rm -rf includes/templates_c/*
rm -rf includes/cache/*
```

### 4. Database

All tables use `utf8mb4` encoding. If upgrading from an older installation, re-import the schema or run:

```sql
-- Verify charset (should show utf8mb4 for all tables)
SELECT TABLE_NAME, TABLE_COLLATION
FROM information_schema.TABLES
WHERE TABLE_SCHEMA = 'your_database_name';
```

No `sql_mode` changes are needed. All queries are `ONLY_FULL_GROUP_BY` compliant.

### 5. PHP Version

Ensure your server runs **PHP 8.3 or 8.4**. The `composer.json` requires `^8.3`.

```bash
php -v   # Must show 8.3.x or 8.4.x
```

---

## Changelog

### 2026-02-09: fix: decode unicode escaped translations

- **Fixed:** German translation strings containing `\uXXXX` unicode escape sequences (e.g. `Zur\u00fcck`) were rendered literally instead of as proper UTF-8 characters (e.g. `Zurück`).
- **Root cause:** Language files use single-quoted PHP strings, which do not interpret `\u` escapes. The values were stored with literal backslash-u sequences.
- **Fix:** Added `_sr_decode_unicode()` helper in `includes/i18n.php` that converts `\uXXXX` sequences to real UTF-8 characters at dictionary load time using `preg_replace_callback` and `mb_chr`. Applied via `array_map` in `_sr_load_dict()` — no template or language file changes needed.
- **Changed files:** `includes/i18n.php`

### 2026-02-09: Flat Webroot Layout (no more public_html/ subfolder)

- **Breaking change:** The `public_html/` wrapper directory has been removed. All files now live directly in the webroot.
- **Moved to root:** `index.php`, `api.php`, `.htaccess`, `nginx.conf`, `favicon.ico`, `robots.txt`, `images/`, `layout/`, `mp3/`
- **New constant:** `SR_ROOT` defined in `index.php` as `__DIR__` — replaces all `../` path hacks
- **Path fixes:** 30+ PHP files updated from `require('../includes/...')` to `require(ABSPATH . 'includes/...')` or `require(SR_ROOT . '/includes/...')`
- **ABSPATH** in `cardinal.php` now uses `SR_ROOT` when available (with fallback for standalone usage)
- **Security:** `.htaccess` now blocks direct access to: `includes/`, `templates/`, `tests/`, `docs/`, `screens/`, `lang/`, `MISSION-GUIDES/`, `.git/`, `composer.json`, `composer.lock`, `*.md`, `*.sh`, `*.log`, `*.tpl`, `*.sql`
- **Nginx:** `nginx.conf` updated with security location blocks
- **CI:** Updated phplint path in GitHub Actions workflow
- **Deployment:** Upload all files directly to `public_html/` on Hostinger (no subfolder). See updated [Installation](#installation) and [Webserver Setup](#webserver-setup) sections.

### 2026-02-09: Admin Registered Page Fix (groups table / join)

- **Fixed:** `/admin/view/registered/` crashed with "Table \<db\>.groups doesn't exist"
- **Root cause:** Code in `includes/class/class.admin.php` (`get_registered()`) and `includes/modules/profile.php` referenced a non-existent `groups` table instead of the correct `user_groups` table
- **Fix 1:** Changed `LEFT JOIN groups` → `LEFT JOIN user_groups` in both `class.admin.php` and `profile.php`
- **Fix 2:** Changed filter from `hg.group_id` to `uc.group_id` in the group filter branch of `get_registered()`, consistent with the count query
- No DB schema change required — the `user_groups` table already existed with the correct `group_id` primary key and `name` column

### 2026-02-09: i18n / Internationalization (DE/EN)

- Added bilingual support: **German** (default) and **English**
- Language switch "DE | EN" in header on every page
- Language persistence: DB (`users.language`) > Cookie (`sr_lang`) > Session > Default `de`
- i18n infrastructure: `includes/i18n.php` with `t()`, `get_lang()`, `set_lang()`
- Translation dictionaries: `lang/de.php` + `lang/en.php` (~280 keys each)
- Smarty integration: `{$L.KEY}` in all translated templates
- **Fully translated (no mixed language):**
  - Login / Splash screen
  - Registration
  - Password recovery (forgot password)
  - Missions page (overview, groups, quest info, feedback)
  - Training page (all difficulties, history, pattern games)
  - Profile page (reputation, friends, blogs, achievements, org)
  - Admin navigation
  - Installer / Setup
  - Header / Footer / Navigation (desktop + mobile)
  - All PHP error/success/info messages in: `loginSystem`, `registrationSystem`, `header`, `quests`, `train`, `profile`
- DB schema: `users.language VARCHAR(2) DEFAULT 'de'` added
- Documentation: `docs/I18N_PROJECT_MAP.md`, `docs/I18N_CHECKLIST.md`

### 2026-02-09: ONLY_FULL_GROUP_BY Fix

- All GROUP BY queries on the missions page are now ONLY_FULL_GROUP_BY compliant
- No `SET GLOBAL/SESSION sql_mode` workarounds needed
- Fixed queries in `quests_show.php` and `manageUsers.php`
- Documentation: `docs/sql_missions_audit.md`

### PHP 8.3/8.4 Compatibility Update

| Area | Details |
|---|---|
| **PHP 8.3/8.4** | All 128 PHP files pass `phplint` without errors. Fixed: null-safety issues, deprecated `session.hash_function`, `Mobile_Detect` API change, old-style constructors, `var` to `public`, undefined variables. |
| **Smarty 5.7** | Upgraded from Smarty 4.5.6. Namespace changed to `\Smarty\Smarty`. 35 PHP built-in functions + 6 custom functions registered as Smarty modifiers (required by Smarty 5). |
| **Composer** | `php ^8.3`, `smarty/smarty ^5.7`, `mobiledetect/mobiledetectlib ^4.8`, `phpmailer/phpmailer ^6.9`, `google/recaptcha ^1.3`, `phpunit/phpunit ^10.5`, `overtrue/phplint ^9.0` |
| **Database** | All 100 tables converted to `utf8mb4` + `utf8mb4_unicode_ci`. All GROUP BY queries are `ONLY_FULL_GROUP_BY` compliant -- no `SET GLOBAL/SESSION sql_mode` workarounds needed. |
| **CI** | GitHub Actions matrix tests PHP 8.3 and 8.4. Runs phplint and PHPUnit. |

### Known Remaining Points

| Item | Status | Recommendation |
|---|---|---|
| `joshcam/mysqli-database-class` | `dev-master` | Pin to a specific commit or fork |
| `danielstjules/php-pretty-datetime` | `dev-master` | Pin to a specific commit or fork |
| `#[AllowDynamicProperties]` | Used on several classes | Will be removed in PHP 9.0; declare properties explicitly long-term |
| `includes/class/recaptchalib.php` | Legacy reCAPTCHA v1 lib | Not actively used (replaced by `google/recaptcha` Composer package); can be removed |

For detailed upgrade documentation, see `docs/STATUS.md`.

---

## Framework Details

The application is built with vanilla PHP, using Smarty as the template engine and a few Composer libraries. There is no traditional MVC framework.

### Directory Structure

Everything lives in the webroot (no `public_html/` subfolder):

```
webroot/                        # = Document Root (e.g. Hostinger public_html/)
├── index.php                   # Front controller (entry point, defines SR_ROOT)
├── api.php                     # API endpoint
├── .htaccess                   # Apache URL rewriting + security rules
├── nginx.conf                  # Nginx reference config
├── composer.json               # (protected by .htaccess)
├── images/                     # Game images
├── layout/                     # CSS, JS, fonts
│   ├── css/                    # Stylesheets
│   ├── js/                     # JavaScript
│   └── fonts/                  # Web fonts
├── mp3/                        # Audio files (mp3, ogg)
├── includes/                   # (protected by .htaccess – 403)
│   ├── class/                  # PHP classes
│   │   ├── cardinal.php        # Core application class
│   │   ├── alpha.class.php     # Base class (email, captcha, etc.)
│   │   ├── loginSystem.php     # Authentication
│   │   ├── userclass.php       # User operations
│   │   ├── qclass.php          # Quest/mission engine
│   │   ├── class.forum.php     # Forum system
│   │   └── ...
│   ├── constants/              # Application configuration
│   │   ├── constants.php       # Main config (SMTP, reCAPTCHA, etc.)
│   │   ├── abilities.php       # Ability definitions
│   │   ├── skills.php          # Skill definitions
│   │   ├── tutorial.php        # Tutorial step definitions
│   │   └── jobs.php            # Job definitions
│   ├── modules/                # Controllers (one per route)
│   │   ├── main/               # Homepage (visitor.php, player.php)
│   │   ├── admin/              # Admin panel
│   │   ├── quests/             # Missions
│   │   ├── cron/               # Cronjob handlers
│   │   └── ...
│   ├── install/
│   │   └── DB.sql              # Full database schema
│   ├── vendor/                 # Composer packages (gitignored)
│   ├── templates_c/            # Smarty compiled templates (writable)
│   ├── cache/                  # Smarty cache (writable)
│   ├── configs/                # Smarty configs (writable)
│   ├── database_info.php       # DB credentials (not in repo)
│   └── database_info.php.template
├── templates/                  # Smarty .tpl templates (protected by .htaccess)
├── lang/                       # Language files (protected by .htaccess)
├── MISSION-GUIDES/             # PDF guides (protected by .htaccess)
├── tests/                      # PHPUnit tests (protected by .htaccess)
├── docs/                       # Documentation (protected by .htaccess)
├── screens/                    # Screenshots (protected by .htaccess)
└── LICENSE.md                  # MIT License
```

### Routing

All requests are rewritten to `index.php` via `.htaccess` / nginx. The first URL segment maps to a module file in `includes/modules/`:

```
http://domain/quests            → includes/modules/quests/quests.php
http://domain/forum             → includes/modules/forum.php
http://domain/admin             → includes/modules/admin/admin.php
http://domain/pages/about       → templates/pages/about.tpl (static page)
```

URL parameters are parsed as key/value pairs from the path:

```
http://domain/quests/group/5/mission/10
→ $GET["group"] = "5", $GET["mission"] = "10"
```

### Creating New Missions

See the PDF guides in `MISSION-GUIDES/`:
- `missions-console-guide.pdf` - Console commands and syntax
- `missions-designer-guide.pdf` - Using the admin mission designer

### Adding Skills, Abilities, or Tutorial Steps

Edit the corresponding file in `includes/constants/`:
- `abilities.php` - Ability definitions
- `skills.php` - Skill definitions
- `tutorial.php` - Tutorial steps (also add a `tutorial_step_N_check` function for each step)

### Adding Simple Pages

Create a `.tpl` file in `templates/pages/`. It becomes available at `/pages/FILENAME` immediately.
Use `templates/pages/template.tpl` as a starting point.

---

## Tests

### PHP Lint

```bash
./includes/vendor/bin/phplint --no-cache --exclude=vendor includes/ index.php
```

### PHPUnit

```bash
./includes/vendor/bin/phpunit tests
```

Currently 4 tests with 23 assertions covering abilities, skills, tutorial, and basic functionality.

---

## Troubleshooting

### Smarty: "templates_c is not writable"

```bash
chmod -R 775 includes/templates_c/
chmod -R 775 includes/cache/
chmod -R 775 includes/configs/
```

If using SELinux:

```bash
chcon -R -t httpd_sys_rw_content_t includes/templates_c/ includes/cache/ includes/configs/
```

### 500 Internal Server Error

1. Check that `mod_rewrite` is enabled (Apache) or that nginx config has proper `try_files`.
2. Verify Document Root points to the project root (where `index.php` lives).
3. Check PHP error log: `tail -f /var/log/php_errors.log` (or your configured path).

### Database Connection Error

1. Verify `includes/database_info.php` exists and has correct credentials.
2. Check that the MySQL service is running.
3. Ensure the `mysqli` PHP extension is installed: `php -m | grep mysqli`.

### reCAPTCHA Not Working

1. Ensure `recaptcha_site_key` and `recaptcha_secret_key` are set in `includes/constants/constants.php`.
2. Keys must match your domain. Localhost requires separate test keys from Google.

### Email Not Sending

1. Verify SMTP settings in `includes/constants/constants.php`.
2. `smtp_host` must not be empty for emails to work. If it is empty, emails are silently skipped (check the PHP error log for `[SecretRepublic] sendEmail skipped` messages).
3. Check that your SMTP provider allows the configured authentication method (TLS/SSL).
4. On Hostinger, use `smtp.hostinger.com`, port `465`, secure `ssl`. The `smtp_from` address **must** match the email account you created in the Hostinger panel.
5. For debugging, temporarily add `$mail->SMTPDebug = 2;` after `$mail->isSMTP();` in `includes/class/alpha.class.php`.
6. Check the PHP error log for `[SecretRepublic] sendEmail failed:` messages that contain the PHPMailer error details.

### Missions Page: GROUP BY Errors

All SQL queries are `ONLY_FULL_GROUP_BY` compliant. **No `sql_mode` changes are needed.**

If you see GROUP BY errors, ensure you are running the latest code from this branch. See `docs/sql_missions_audit.md` for details on the query fixes.

### "Class Smarty not found"

Smarty 5 requires the namespaced class. Ensure:
1. You ran `composer install` successfully.
2. The `includes/vendor/` directory exists and contains Smarty.

### Template Rendering Issues After Upgrade

Clear the Smarty compile cache:

```bash
rm -rf includes/templates_c/*
rm -rf includes/cache/*
```

---

## Security & Deployment

### Production Checklist

- [ ] Change the cron key in `includes/modules/cron/cron.php` (default is a base64 string)
- [ ] Set SMTP credentials in `includes/constants/constants.php`
- [ ] Set reCAPTCHA keys in `includes/constants/constants.php`
- [ ] Ensure `includes/database_info.php` is **not** committed to version control
- [ ] Set correct file permissions (`775` for Smarty dirs, `644` for PHP files)
- [ ] Use HTTPS in production
- [ ] Set `display_errors` to `0` in production (already set in `index.php`)
- [ ] Consider enabling PHP OPcache for performance

### File Permissions

```bash
# Writable directories for Smarty
chmod -R 775 includes/templates_c/ includes/cache/ includes/configs/

# Restrict database config
chmod 640 includes/database_info.php
```

### OPcache (Recommended)

In `php.ini`:

```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
opcache.validate_timestamps=0   # Only for production; set to 1 during development
```

### Smarty Compile Check

For production performance, you can disable Smarty compile checks by adding this after the Smarty initialization in `index.php`:

```php
$smarty->setCompileCheck(\Smarty\Smarty::COMPILECHECK_OFF);
```

After any template change, clear `includes/templates_c/` manually.

---

## Screenshots

| Main Page | Player Dashboard | Mission |
|---|---|---|
| ![Main](screens/1.jpg) | ![Dashboard](screens/2.jpg) | ![Mission](screens/3.jpg) |

| Organization | Skills | The Grid |
|---|---|---|
| ![Org](screens/4.jpg) | ![Skills](screens/5.jpg) | ![Grid](screens/6.jpg) |

| Mission Designer | | |
|---|---|---|
| ![Designer 1](screens/7.jpg) | ![Designer 2](screens/8.jpg) | ![Designer 3](screens/9.jpg) |

| Forum | |
|---|---|
| ![Forum 1](screens/10.jpg) | ![Forum 2](screens/11.jpg) |

---

## Contributors & License

### Contributors

- [nenuadrian](https://github.com/nenuadrian) - Main developer
- [SKSaki](https://github.com/SKSaki) - Initial user and bug-finder

If your pull request is merged, your name will be added here.

### License

MIT License - Copyright (c) 2012 Adrian Mircea Nenu

See [LICENSE.md](LICENSE.md) for the full license text.

Please link and contribute back to this repository if using the code or assets.
