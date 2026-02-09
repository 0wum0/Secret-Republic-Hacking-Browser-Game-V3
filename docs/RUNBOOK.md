# Runbook: Secret Republic Hacking Browser Game V3

## Systemanforderungen

| Komponente | Version | Pflicht |
|-----------|---------|---------|
| PHP | 8.3 oder 8.4 | Ja |
| MySQL/MariaDB | 8.0+ / 10.5+ | Ja |
| Apache | 2.4+ mit mod_rewrite | Ja (oder Nginx) |
| Composer | 2.x | Ja (für Installation) |
| PHP Extensions | mysqli, mbstring, json, curl, session, gd | Ja |

---

## Installation (Neuinstallation)

### 1. Repository klonen

```bash
git clone <repo-url> secretrepublic
cd secretrepublic
```

### 2. Composer Dependencies installieren

```bash
composer install --prefer-dist --no-progress
```

Die Vendor-Dateien werden nach `includes/vendor/` installiert.

### 3. Datenbank konfigurieren

```bash
# Konfigurationsdatei aus Template erstellen
cp includes/database_info.php.template includes/database_info.php
```

Datei `includes/database_info.php` bearbeiten:

```php
<?php
$db['server_name'] = 'localhost';
$db['username'] = 'DB_USER';
$db['password'] = 'DB_PASSWORD';
$db['name'] = 'DB_NAME';
$db['port'] = 3306;

return $db;
```

### 4. Datenbank-Schema importieren

```bash
mysql -u DB_USER -p DB_NAME < includes/install/DB.sql
```

### 5. Verzeichnis-Berechtigungen setzen

```bash
chmod -R 775 includes/templates_c/
chmod -R 775 includes/cache/
chmod -R 775 includes/configs/
```

### 6. Webserver konfigurieren

**Document Root** muss auf `public_html/` zeigen.

#### Apache (.htaccess ist bereits vorhanden)
```bash
# mod_rewrite aktivieren
sudo a2enmod rewrite
sudo systemctl restart apache2
```

#### Nginx (Referenz: public_html/nginx.conf)
```nginx
server {
    root /path/to/secretrepublic/public_html;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 7. Setup durchführen

Öffne `http://deine-domain/setup` im Browser. Das Setup-Formular erstellt den Admin-Account.

---

## Upgrade von PHP 8.1/8.2 auf 8.3/8.4

### 1. PHP aktualisieren

```bash
# Ubuntu/Debian mit ondrej PPA
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php8.3 php8.3-cli php8.3-fpm php8.3-mysqli php8.3-mbstring php8.3-xml php8.3-curl php8.3-gd
```

### 2. Code aktualisieren

```bash
cd /path/to/secretrepublic
git pull origin master
```

### 3. Composer Dependencies aktualisieren

```bash
composer install --prefer-dist --no-progress
```

### 4. Smarty Compile-Cache leeren

```bash
rm -rf includes/templates_c/*
rm -rf includes/cache/*
```

### 5. PHP-FPM neustarten (wenn verwendet)

```bash
sudo systemctl restart php8.3-fpm
```

### 6. Webserver neustarten

```bash
sudo systemctl restart apache2  # oder nginx
```

---

## Smoke-Test Checkliste

Nach jedem Deployment diese Punkte prüfen:

| # | Test | URL | Erwartung |
|---|------|-----|-----------|
| 1 | Startseite (Besucher) | `/` | Splash Screen ohne PHP Errors |
| 2 | Setup-Seite | `/setup` | Installations-Formular (nur ohne DB-Config) |
| 3 | Registrierung | `/register` | Formular lädt, Felder vorhanden |
| 4 | Login | `/` (Login-Form) | Login-Formular angezeigt |
| 5 | Dashboard | Nach Login → `/` | Index mit Tasks, News, Grid |
| 6 | Quests | `/quests` | Mission-Liste angezeigt |
| 7 | Forum | `/forum` | Forum-Kategorien laden |
| 8 | Shop | `/shop` | Shop-Seite rendert |
| 9 | Blog | `/blogs` | Blog-Liste |
| 10 | Profil | `/profile` | Eigenes Profil |
| 11 | Organisation | `/organization` | Org-Seite |
| 12 | Admin | `/admin` (als Admin) | Admin-Panel |
| 13 | DNA | `/dna` | Einstellungen |
| 14 | Grid | `/grid` (nach Login) | Grid-Ansicht |
| 15 | Ranking | `/rankings` | Ranking-Tabelle |

### Cronjob-Test

```bash
# Daily Cron (ersetze KEY mit dem konfigurierten Cron-Key)
curl http://domain/cron/key1/KEY/daily/1

# Hourly Cron
curl http://domain/cron/key1/KEY/hourly/1

# Rankings
curl http://domain/cron/key1/KEY/rankings/1
```

---

## Produktions-Konfiguration

### Error Reporting

In `public_html/index.php` ist bereits gesetzt:
```php
error_reporting(E_ALL ^E_NOTICE);
ini_set('display_errors', '0');
```

### PHP OPcache (empfohlen)

In `php.ini`:
```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
opcache.validate_timestamps=0  # Nur für Produktion!
```

### Smarty Compile Check

Für Performance in Produktion optional in `public_html/index.php` nach Smarty-Init hinzufügen:
```php
$smarty->setCompileCheck(\Smarty\Smarty::COMPILECHECK_OFF);
```

**Achtung:** Nach Template-Änderungen muss dann manuell `includes/templates_c/` geleert werden.

---

## Abhängigkeiten

### Composer (composer.json)

| Package | Version | Zweck |
|---------|---------|-------|
| `smarty/smarty` | ^5.7 | Template-Engine |
| `phpmailer/phpmailer` | ^6.9 | E-Mail-Versand |
| `google/recaptcha` | ^1.3 | reCAPTCHA v2 |
| `mobiledetect/mobiledetectlib` | ^4.8 | Mobile Device Detection |
| `joshcam/mysqli-database-class` | dev-master | DB-Abstraction Layer |
| `danielstjules/php-pretty-datetime` | dev-master | Relative Zeitanzeige |
| `jbbcode/jbbcode` | ^1.3 | BBCode Parser |

### Dev-Dependencies

| Package | Version | Zweck |
|---------|---------|-------|
| `overtrue/phplint` | ^9.0 | PHP Syntax Linter |
| `phpunit/phpunit` | ^10.5 | Unit Tests |

---

## Verzeichnisstruktur

```
secretrepublic/
├── public_html/          # Document Root
│   ├── index.php         # Haupteingang
│   ├── .htaccess         # Apache Rewrite
│   └── nginx.conf        # Nginx Referenz-Config
├── includes/
│   ├── class/            # PHP-Klassen
│   ├── constants/        # Konfigurationskonstanten
│   ├── modules/          # Controller-Module
│   │   ├── main/         # Startseite (visitor.php, player.php)
│   │   ├── admin/        # Admin-Panel
│   │   ├── cron/         # Cronjobs
│   │   └── ...           # Weitere Module
│   ├── install/          # DB.sql Schema
│   ├── vendor/           # Composer Packages
│   ├── templates_c/      # Smarty Compile Dir (beschreibbar!)
│   ├── cache/            # Smarty Cache Dir (beschreibbar!)
│   └── configs/          # Smarty Config Dir (beschreibbar!)
├── templates/            # Smarty Templates (.tpl)
├── docs/                 # Dokumentation
│   ├── STATUS.md         # Upgrade-Status
│   └── RUNBOOK.md        # Diese Datei
├── tests/                # PHPUnit Tests
└── composer.json
```

---

## Fehlerbehebung

### "Class Smarty not found"
→ Smarty 5 erfordert `new \Smarty\Smarty` statt `new Smarty`. Composer-Autoloader prüfen: `composer dump-autoload`

### "templates_c is not writable"
→ `chmod -R 775 includes/templates_c/`

### Session-Probleme nach Update
→ Smarty Compile-Cache leeren: `rm -rf includes/templates_c/*`

### Deprecation Warnings
→ In `php.ini`: `error_reporting = E_ALL & ~E_DEPRECATED & ~E_NOTICE`

### MySQL Strict Mode Probleme
→ Alle Queries sind ONLY_FULL_GROUP_BY-konform. Kein manuelles Ändern von `sql_mode` notwendig. Siehe `docs/sql_missions_audit.md` für Details.
