# Secret Republic - Browser-Based Hacking RPG (V3)

[![PHP Composer](https://github.com/nenuadrian/Secret-Republic-Hacking-Browser-Game-V3/actions/workflows/php.yml/badge.svg)](https://github.com/nenuadrian/Secret-Republic-Hacking-Browser-Game-V3/actions/workflows/php.yml)

<p align="center">

![Cover](screens/cover.jpg)

</p>

A futuristic, post-apocalyptic hacker simulation RPG built with PHP and MySQL. Features include single- and multi-player missions with a UNIX-like terminal interface, player-owned servers with upgradeable hardware, organization/guild warfare, a full Grid-world system, forums, blogs, rankings, and an in-game economy with premium currency.

> **UI/Theme note:** The original design and all visual assets are preserved unchanged.

---

## Table of Contents

1. [Tech Stack](#tech-stack)
2. [Requirements](#requirements)
3. [Installation](#installation)
4. [Configuration](#configuration)
5. [Webserver Setup](#webserver-setup)
6. [Cron Jobs](#cron-jobs)
7. [Upgrading](#upgrading)
8. [Changelog](#changelog)
9. [Development](#development)
10. [Troubleshooting](#troubleshooting)
11. [Security Notes](#security-notes)
12. [Features](#features)
13. [Screenshots](#screenshots)
14. [Framework Details](#framework-details)
15. [License](#license)

---

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Language | PHP 8.3 / 8.4 |
| Database | MySQL 5.7+ / 8.x or MariaDB 10.5+ |
| Template Engine | Smarty 5.7 |
| Package Manager | Composer 2.x |
| Webserver | Apache 2.4+ (mod_rewrite) or Nginx |
| Mail | PHPMailer 6.x via SMTP |
| Captcha | Google reCAPTCHA v2 (`google/recaptcha`) |
| CI | GitHub Actions (PHP 8.3 + 8.4 matrix) |

---

## Requirements

- **PHP 8.3** or **8.4**
- **PHP Extensions:** `mysqli`, `mbstring`, `json`, `curl`, `session`, `gd`, `xml`, `zip`
- **MySQL 5.7+ / 8.x** or **MariaDB 10.5+**
- **Composer 2.x**
- **Apache** with `mod_rewrite` enabled, or **Nginx**

Verify PHP extensions:

```bash
php -m | grep -E 'mysqli|mbstring|json|curl|session|gd'
```

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/nenuadrian/Secret-Republic-Hacking-Browser-Game-V3.git
cd Secret-Republic-Hacking-Browser-Game-V3
```

### 2. Install Dependencies

```bash
composer install --prefer-dist --no-progress
```

Dependencies are installed to `includes/vendor/`.

### 3. Create the Database

```bash
mysql -u root -p -e "CREATE DATABASE secretrepublic CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p secretrepublic < includes/install/DB.sql
```

### 4. Configure Database Connection

```bash
cp includes/database_info.php.template includes/database_info.php
```

The file reads from environment variables by default. Either set the ENV vars (see [Configuration](#configuration)) or edit the file directly:

```php
$db['server_name'] = getenv('DB_HOST') ?: 'localhost';
$db['username']    = getenv('DB_USER') ?: 'your_user';
$db['password']    = getenv('DB_PASS') ?: 'your_password';
$db['name']        = getenv('DB_NAME') ?: 'secretrepublic';
$db['port']        = (int) (getenv('DB_PORT') ?: 3306);
```

### 5. Set Directory Permissions

Smarty needs write access to its compile and cache directories:

```bash
chmod -R 775 includes/templates_c/
chmod -R 775 includes/cache/
chmod -R 775 includes/configs/
```

### 6. Set Up Webserver

Point your Document Root to `public_html/`. See [Webserver Setup](#webserver-setup).

### 7. Run the Setup Wizard

Open `http://your-domain/setup` to create the initial admin account.

### 8. Make Yourself Admin (Manual)

If you registered a user manually instead of using setup, promote it to admin:

```sql
UPDATE user_credentials SET group_id = 1 WHERE uid = YOUR_USER_ID;
```

---

## Configuration

All secrets and service credentials are read from **environment variables** with safe fallback defaults. Set them on your server, in your shell, or via your hosting panel.

### Database

| Variable | Required | Default | Description |
|----------|----------|---------|-------------|
| `DB_HOST` | Yes | `localhost` | Database host |
| `DB_USER` | Yes | — | Database user |
| `DB_PASS` | Yes | — | Database password |
| `DB_NAME` | Yes | — | Database name |
| `DB_PORT` | No | `3306` | Database port |

### SMTP (E-Mail)

Leave `SMTP_HOST` empty to disable email sending entirely.

| Variable | Required | Default | Description |
|----------|----------|---------|-------------|
| `SMTP_HOST` | No | — | SMTP server hostname |
| `SMTP_PORT` | No | `587` | SMTP port |
| `SMTP_USER` | No | — | SMTP username |
| `SMTP_PASS` | No | — | SMTP password |
| `SMTP_SECURE` | No | `tls` | `tls` or `ssl` |
| `SMTP_FROM` | No | `undefined@undefined.com` | Sender address |
| `SMTP_FROM_NAME` | No | `Secret Republic` | Sender display name |

### reCAPTCHA v2

Leave empty to disable captcha. Create keys at https://www.google.com/recaptcha/admin/create.

| Variable | Required | Default | Description |
|----------|----------|---------|-------------|
| `RECAPTCHA_SITE_KEY` | No | — | reCAPTCHA v2 site key |
| `RECAPTCHA_SECRET_KEY` | No | — | reCAPTCHA v2 secret key |

### Other

| Variable | Required | Default |
|----------|----------|---------|
| `CONTACT_EMAIL` | No | `undefined@undefined.com` |

### Example (Shell)

```bash
export DB_HOST=localhost
export DB_USER=secretrepublic
export DB_PASS=s3cret
export DB_NAME=secretrepublic
export SMTP_HOST=smtp.example.com
export SMTP_PORT=587
export SMTP_USER=mail@example.com
export SMTP_PASS=mailpass
export RECAPTCHA_SITE_KEY=6Le...
export RECAPTCHA_SECRET_KEY=6Le...
```

All configuration is in `includes/constants/constants.php` (reads ENV via `_env()` helper) and `includes/database_info.php` (reads ENV via `getenv()`).

---

## Webserver Setup

The Document Root must point to `public_html/`.

### Apache

A `.htaccess` with mod_rewrite rules is already included. Enable mod_rewrite:

```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

Make sure your VirtualHost allows `.htaccess` overrides:

```apache
<Directory /path/to/public_html>
    AllowOverride All
</Directory>
```

### Nginx

A reference configuration is included at `public_html/nginx.conf`:

```nginx
server {
    root /path/to/secretrepublic/public_html;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

---

## Cron Jobs

The game uses HTTP-triggered cron jobs for attacks, rankings, resource generation, and competitions. A secret key is required in the URL (configured in the database).

| Job | Route | Schedule |
|-----|-------|----------|
| Tasks & Attacks | `/cron/key1/CRON_KEY/attacks/1` | Every 2 minutes |
| Hourly | `/cron/key1/CRON_KEY/hourly/1` | Every hour |
| Daily | `/cron/key1/CRON_KEY/daily/1` | Once daily |
| Resources | `/cron/key1/CRON_KEY/resources/1` | Every minute |
| Rankings | `/cron/key1/CRON_KEY/rankings/1` | Every 6 hours |
| Hackdown | `/cron/key1/CRON_KEY/hackdown/1` | Daily |

Replace `CRON_KEY` with the key stored in your database. The default key in a fresh install is `MDMwN2Q3OGRiYmM4Y2RkOWZjNTBmMzA4MzViZDZiNjQ=`.

### Example Crontab

```crontab
* * * * *   curl -s http://yourdomain.com/cron/key1/CRON_KEY/resources/1 > /dev/null
*/2 * * * * curl -s http://yourdomain.com/cron/key1/CRON_KEY/attacks/1 > /dev/null
0 * * * *   curl -s http://yourdomain.com/cron/key1/CRON_KEY/hourly/1 > /dev/null
0 0 * * *   curl -s http://yourdomain.com/cron/key1/CRON_KEY/daily/1 > /dev/null
0 */6 * * * curl -s http://yourdomain.com/cron/key1/CRON_KEY/rankings/1 > /dev/null
0 0 * * 6   curl -s http://yourdomain.com/cron/key1/CRON_KEY/hackdown/1 > /dev/null
```

---

## Upgrading

### From PHP 7.x / 8.1 / 8.2 to PHP 8.3+

```bash
# 1. Pull latest code
git pull

# 2. Install updated dependencies
composer install --prefer-dist --no-progress

# 3. Clear Smarty compiled templates (required after Smarty 5 upgrade)
rm -rf includes/templates_c/*
rm -rf includes/cache/*

# 4. Apply DB schema patch (one-time, if upgrading existing database)
mysql -u root -p secretrepublic -e "ALTER TABLE user_bank MODIFY amount int(11) NOT NULL DEFAULT 0;"

# 5. Restart PHP-FPM / webserver
sudo systemctl restart php8.3-fpm
sudo systemctl restart apache2
```

### Key Upgrade Notes

- **Smarty** was upgraded from 4.x to **5.7.0**. The compiled template cache **must** be cleared.
- **`ONLY_FULL_GROUP_BY`:** All SQL queries are now compliant. No `SET GLOBAL sql_mode` workarounds are needed.
- **Legacy `recaptchalib.php`** has been removed. reCAPTCHA uses the `google/recaptcha` Composer package.
- All dynamic properties are now explicitly declared. No `#[AllowDynamicProperties]` attributes remain in project code.
- `joshcam/mysqli-database-class` is pinned to `^2.9.4` (no longer `dev-master`).

---

## Changelog

### PHP 8.3/8.4 Compatibility Update

**Dependencies:**

- `smarty/smarty` 4.5.3 &rarr; **5.7.0** (namespace change: `\Smarty\Smarty`)
- `mobiledetect/mobiledetectlib` 2.8 &rarr; **4.8**
- `phpmailer/phpmailer` 6.0 &rarr; **6.9**
- `google/recaptcha` 1.2 &rarr; **1.3**
- `joshcam/mysqli-database-class` dev-master &rarr; **^2.9.4**
- `phpunit/phpunit` 9.5 &rarr; **10.5**; `overtrue/phplint` 5.3 &rarr; **9.0**
- PHP requirement: `^8.1` &rarr; **`^8.3`**

**Code changes:**

- All `#[AllowDynamicProperties]` removed; properties declared explicitly in all classes
- `$_SESSION` accesses wrapped in `empty()` / null-coalescing for null-safety
- Old-style constructors replaced with `__construct()`
- `var` visibility replaced with `public`
- `eval()` replaced with direct function call
- Undefined variable bugs fixed (`$_SESSTION` typo, `$nr`, `$party`, etc.)
- `session.hash_function` / `session.hash_bits_per_character` guarded for PHP 8.1+
- `array_merge()` calls safe-casted to `(array)` where `session()` could return `false`
- `number_format()` arguments cast to `(float)` for null/string safety

**Smarty 5 migration:**

- `new Smarty` &rarr; `new \Smarty\Smarty`
- 47 PHP functions registered as Smarty modifiers (Smarty 5 no longer auto-exposes PHP functions)
- Template case-sensitivity fixes (`date_Fashion` &rarr; `date_fashion`, `number_Format` &rarr; `number_format`)

**SQL / Database:**

- All tables converted to `utf8mb4` + `utf8mb4_unicode_ci`
- All `GROUP BY` queries are `ONLY_FULL_GROUP_BY` compliant (no `sql_mode` workarounds)
- `user_bank.amount` now has `DEFAULT 0`
- `profile.php`: Fixed table reference `groups` &rarr; `user_groups`

**Configuration:**

- SMTP and reCAPTCHA keys read from environment variables (`getenv()`)
- `database_info.php.template` reads DB credentials from environment variables
- Legacy `recaptchalib.php` deleted; all captcha handled via Composer package

**Files changed:** See `docs/STATUS.md` for the full list.

---

## Development

### Lint

```bash
./includes/vendor/bin/phplint --no-cache --exclude=vendor includes/ public_html/index.php
```

### Tests

```bash
./includes/vendor/bin/phpunit tests
```

### Routing

Routing is path-based via `public_html/index.php`. Adding `includes/modules/example.php` makes `http://yourdomain.com/example` available. Path segments become key-value pairs:

```
/example/key1/value1/key2/value2  -->  $GET['key1'] = 'value1', $GET['key2'] = 'value2'
```

### Creating Missions

Refer to the `MISSION-GUIDES/` folder for the Mission Designer documentation.

### Adding Skills, Abilities, or Tutorial Steps

Edit the files in `includes/constants/`:

- `skills.php` — skill definitions and rates
- `abilities.php` — ability tree and requirements
- `tutorial.php` — tutorial steps and reward configuration

### Creating Static Pages

Create a `.tpl` file in `templates/pages/`. It will be available at `/pages/FILENAME` automatically. Use `templates/pages/template.tpl` as a starting point.

---

## Troubleshooting

| Problem | Solution |
|---------|----------|
| **500 error on all pages** | Check that Document Root points to `public_html/` and Apache `mod_rewrite` is enabled (`sudo a2enmod rewrite`). |
| **Smarty "templates_c is not writable"** | `chmod -R 775 includes/templates_c/ includes/cache/ includes/configs/` |
| **"Class Smarty not found"** | Smarty 5 uses `\Smarty\Smarty`. Run `composer install` to ensure dependencies are up to date. |
| **"unknown modifier" in templates** | A PHP function needs to be registered as a Smarty modifier in `public_html/index.php`. |
| **Database connection error** | Verify ENV variables `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME` or edit `includes/database_info.php` directly. |
| **GROUP BY / ONLY_FULL_GROUP_BY errors** | All queries are compliant. Do **not** use `SET GLOBAL sql_mode` workarounds. If you see this error, ensure you are running the latest code. |
| **reCAPTCHA not showing** | Set `RECAPTCHA_SITE_KEY` and `RECAPTCHA_SECRET_KEY` environment variables. |
| **Emails not sending** | Set `SMTP_HOST`, `SMTP_USER`, `SMTP_PASS` environment variables. Verify your SMTP server accepts connections on the configured port. |
| **Blank page after upgrade** | Clear Smarty cache: `rm -rf includes/templates_c/* includes/cache/*` |

---

## Security Notes

- **Never commit secrets** (`database_info.php`, API keys) to the repository. The `.gitignore` already excludes `database_info.php`.
- Use **environment variables** for all credentials (database, SMTP, reCAPTCHA).
- Set restrictive **file permissions**: web-writable only for `includes/templates_c/`, `includes/cache/`, and `includes/configs/`.
- **HTTPS** is strongly recommended for all production deployments.
- Change the default cron key in the database for production use.

---

## Features

| Feature | Description |
|---------|-------------|
| Futuristic UI | Bootstrap-based, custom-built, responsive design |
| Abilities | Upgradeable abilities that enhance stats, with time-gated leveling |
| Skills | Point-based skill system earned through leveling |
| Tutorial | Multi-step guided tutorial with rewards and skip option |
| Rewards | Packaged reward system (money, items, achievements, skill XP) |
| Audio AI | Pre-recorded audio cues triggered by in-game actions |
| Admin Panel | User management, mission designer, game data overview |
| Mission Designer | Visual mission editor with objectives, sub-objectives, and BBCode |
| Missions | UNIX terminal-like missions for story, guild, hackdown, and training |
| Servers | Player-owned servers with upgradeable hardware and software |
| Forums | Integrated forum system with organization-specific sub-forums |
| Organizations | Guild system with ranks, permissions, wars, and applications |
| Messaging | Thread-based player messaging |
| Blogs | Player-created blogs with articles, comments, and subscriptions |
| Hackdown | Weekly cron-scheduled hacking competition |
| Friends | Friend request and friend list system |
| The Grid | Zone/cluster/node world map with attack, spy, and occupy mechanics |
| Attacks | Node-based attack system using player servers |
| Data Points | Cron-generated resource based on server software |
| Alpha Coins | Premium currency with in-game shop and coupons |
| Rankings | Cron-generated player and organization leaderboards |
| Job | Repeatable job missions for rewards |
| Zones | 6 world zones with clusters and nodes |
| Training | Daily captcha and pattern mini-games for rewards |

---

## Screenshots

| Main Page | Player Dashboard | Mission Terminal |
|-----------|-----------------|-----------------|
| ![](screens/1.jpg) | ![](screens/2.jpg) | ![](screens/3.jpg) |

| Organization | Skills | The Grid |
|-------------|--------|----------|
| ![](screens/4.jpg) | ![](screens/5.jpg) | ![](screens/6.jpg) |

| Mission Designer | | |
|-----------------|---|---|
| ![](screens/7.jpg) | ![](screens/8.jpg) | ![](screens/9.jpg) |

| Forum | |
|-------|---|
| ![](screens/10.jpg) | ![](screens/11.jpg) |

---

## Framework Details

The project is a custom PHP framework using Smarty for templating and a few Composer libraries. It is not based on Laravel, Symfony, or any other framework.

- **Entry point:** `public_html/index.php`
- **Modules:** `includes/modules/` (each file = one route)
- **Classes:** `includes/class/` (Alpha base class, inherited by all controllers)
- **Templates:** `templates/` (Smarty `.tpl` files)
- **Constants:** `includes/constants/` (skills, abilities, tutorial, game config)
- **Database schema:** `includes/install/DB.sql`
- **Vendor:** `includes/vendor/` (Composer, not committed)

---

## License

MIT License - Copyright (c) 2012 Adrian Mircea Nenu

See [LICENSE.md](LICENSE.md) for the full license text.

<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a>

Please link back to this repository if using the code or assets.
