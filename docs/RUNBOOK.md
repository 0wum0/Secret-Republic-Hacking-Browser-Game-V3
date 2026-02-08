# Runbook: Secret Republic Hacking Browser Game V3

## Systemanforderungen

| Komponente | Version | Pflicht |
|-----------|---------|---------|
| PHP | 8.3 oder 8.4 | Ja |
| MySQL / MariaDB | 8.0+ / 10.5+ | Ja |
| Apache | 2.4+ mit mod_rewrite | Ja (oder Nginx) |
| Composer | 2.x | Ja (fuer Installation) |

### Benoetigte PHP Extensions

```
mysqli mbstring json curl session gd xml zip
```

Pruefen mit:

```bash
php -m | grep -E 'mysqli|mbstring|json|curl|session|gd'
```

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

Vendor-Verzeichnis: `includes/vendor/`

### 3. Environment-Variablen setzen

Alle Secrets werden ueber Umgebungsvariablen konfiguriert. Erstelle eine `.env`-Datei oder setze sie im Webserver / Systemd / Docker.

#### Datenbank (Pflicht)

```bash
export DB_HOST=localhost
export DB_USER=secretrepublic
export DB_PASS=geheim
export DB_NAME=secretrepublic
export DB_PORT=3306
```

#### SMTP Mail (optional, laesst Mailversand leer = deaktiviert)

```bash
export SMTP_HOST=smtp.example.com
export SMTP_PORT=587
export SMTP_USER=user@example.com
export SMTP_PASS=smtp-password
export SMTP_SECURE=tls
export SMTP_FROM=noreply@example.com
export SMTP_FROM_NAME="Secret Republic"
```

#### reCAPTCHA v2 (optional, leer = deaktiviert)

```bash
export RECAPTCHA_SITE_KEY=6Le...
export RECAPTCHA_SECRET_KEY=6Le...
```

Erstelle Keys unter: https://www.google.com/recaptcha/admin/create

#### Sonstige (optional)

```bash
export CONTACT_EMAIL=admin@example.com
```

### 4. Datenbank-Konfiguration

```bash
cp includes/database_info.php.template includes/database_info.php
```

Die Datei liest automatisch die ENV-Variablen `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`, `DB_PORT`. Bei direktem Hosting ohne ENV die Werte in der Datei anpassen.

### 5. Datenbank-Schema importieren

```bash
mysql -u $DB_USER -p $DB_NAME < includes/install/DB.sql
```

### 6. Verzeichnis-Berechtigungen

```bash
chmod -R 775 includes/templates_c/
chmod -R 775 includes/cache/
chmod -R 775 includes/configs/
```

### 7. Webserver konfigurieren

**Document Root** muss auf `public_html/` zeigen.

#### Apache

`.htaccess` ist bereits vorhanden. Mod_rewrite aktivieren:

```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

#### Nginx

Referenz-Konfiguration unter `public_html/nginx.conf`:

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

### 8. Setup

Oeffne `http://deine-domain/setup` im Browser.

---

## Upgrade von PHP 8.1/8.2 auf 8.3/8.4

```bash
# 1. PHP aktualisieren
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php8.3 php8.3-cli php8.3-fpm php8.3-mysqli php8.3-mbstring php8.3-xml php8.3-curl php8.3-gd

# 2. Code aktualisieren
git pull

# 3. Composer Dependencies
composer install --prefer-dist --no-progress

# 4. Smarty Cache leeren (PFLICHT nach Smarty 4 -> 5 Upgrade!)
rm -rf includes/templates_c/* includes/cache/*

# 5. DB-Patch (einmalig, falls bestehende Installation)
mysql -e "ALTER TABLE user_bank MODIFY amount int(11) NOT NULL DEFAULT 0;" $DB_NAME

# 6. Services neustarten
sudo systemctl restart php8.3-fpm
sudo systemctl restart apache2  # oder nginx
```

---

## Cron-Jobs

Das Projekt nutzt HTTP-basierte Cron-Ausfuehrung. Der Cron-Key ist in der Datenbank konfiguriert.

```bash
# Taeglich
curl -s http://domain/cron/key1/CRON_KEY/daily/1

# Stuendlich
curl -s http://domain/cron/key1/CRON_KEY/hourly/1

# Rankings
curl -s http://domain/cron/key1/CRON_KEY/rankings/1

# Ressourcen
curl -s http://domain/cron/key1/CRON_KEY/resources/1

# Tasks & Attacks
curl -s http://domain/cron/key1/CRON_KEY/tasks_and_attacks/1
```

Empfohlene Crontab:

```crontab
*/5 * * * * curl -s http://domain/cron/key1/CRON_KEY/tasks_and_attacks/1
0 * * * *   curl -s http://domain/cron/key1/CRON_KEY/hourly/1
0 0 * * *   curl -s http://domain/cron/key1/CRON_KEY/daily/1
0 * * * *   curl -s http://domain/cron/key1/CRON_KEY/resources/1
0 */6 * * * curl -s http://domain/cron/key1/CRON_KEY/rankings/1
```

---

## Produktion

### Error Reporting

In `public_html/index.php` ist bereits gesetzt:

```php
error_reporting(E_ALL ^E_NOTICE);
ini_set('display_errors', '0');
```

### OPcache (empfohlen)

```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
opcache.validate_timestamps=0
```

### Smarty Compile Check (optional)

Fuer bessere Performance nach `$smarty`-Init in `index.php`:

```php
$smarty->setCompileCheck(\Smarty\Smarty::COMPILECHECK_OFF);
```

Nach Template-Aenderungen muss dann `includes/templates_c/` manuell geleert werden.

---

## Smoke-Test Checkliste

| # | Test | URL | Erwartet |
|---|------|-----|----------|
| 1 | Startseite | `/` | Splash Screen, HTTP 200 |
| 2 | Registrierung | `/register` | Formular |
| 3 | Login | `/` POST | Dashboard nach Login |
| 4 | Forum | `/forum` | Kategorien |
| 5 | Shop | `/shop` | Shop-Seite |
| 6 | Rankings | `/rankings` | Tabelle |
| 7 | Quests | `/quests` | Mission-Liste |
| 8 | Skills | `/skills` | Skill-Uebersicht |
| 9 | Grid | `/grid` | Grid-Ansicht |
| 10 | Profil | `/profile` | Eigenes Profil |
| 11 | Bank | `/bank` | Bank-Seite |
| 12 | DNA | `/dna` | Einstellungen |
| 13 | Admin | `/admin` | Admin-Panel |
| 14 | Training | `/train` | Training-Seite |
| 15 | Rewards | `/rewards` | Belohnungen |

---

## Fehlerbehebung

| Problem | Loesung |
|---------|---------|
| Class "Smarty" not found | Smarty 5: `new \Smarty\Smarty` wird verwendet. `composer dump-autoload` ausfuehren. |
| templates_c not writable | `chmod -R 775 includes/templates_c/` |
| unknown modifier 'xyz' | PHP-Funktion muss in `index.php` als Modifier registriert sein. |
| Session-Probleme | Smarty Cache leeren: `rm -rf includes/templates_c/*` |
| SMTP Fehler | ENV-Variablen SMTP_HOST, SMTP_USER, SMTP_PASS pruefen. |
| reCAPTCHA fehlt | ENV-Variablen RECAPTCHA_SITE_KEY, RECAPTCHA_SECRET_KEY setzen. |
| DB connection refused | ENV DB_HOST, DB_USER, DB_PASS pruefen oder `database_info.php` anpassen. |

---

## Abhaengigkeiten

| Package | Version | Zweck |
|---------|---------|-------|
| `smarty/smarty` | ^5.7 | Template-Engine |
| `phpmailer/phpmailer` | ^6.9 | E-Mail-Versand |
| `google/recaptcha` | ^1.3 | reCAPTCHA v2 |
| `mobiledetect/mobiledetectlib` | ^4.8 | Mobile Device Detection |
| `joshcam/mysqli-database-class` | ^2.9.4 | DB-Abstraction Layer |
| `danielstjules/php-pretty-datetime` | dev-master#c489c905 | Relative Zeitanzeige |
| `jbbcode/jbbcode` | ^1.3 | BBCode Parser |
| `overtrue/phplint` | ^9.0 | PHP Syntax Linter (dev) |
| `phpunit/phpunit` | ^10.5 | Unit Tests (dev) |
