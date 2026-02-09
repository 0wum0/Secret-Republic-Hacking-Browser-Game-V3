# Upgrade Status: PHP 8.3/8.4 + Smarty 5.7.0 + i18n

**Stand:** 2026-02-09
**Branch:** `cursor/fehlerbehebung-und-i18n-1d90`

---

## Zusammenfassung

Das Projekt "Secret Republic Hacking Browser Game V3" wurde vollständig auf PHP 8.3/8.4 Kompatibilität aktualisiert, alle SQL-Queries sind ONLY_FULL_GROUP_BY-konform, und eine vollständige Zweisprachigkeit (DE/EN) mit Deutsch als Standard wurde implementiert. Alle bekannten Fehler wurden systematisch analysiert und behoben.

## Status: ABGESCHLOSSEN

| Bereich | Status | Details |
|---------|--------|---------|
| PHP 8.3/8.4 Syntax-Kompatibilität | ✅ Fertig | Alle PHP-Dateien fehlerfrei (phplint) |
| Smarty Upgrade 4.5.6 -> 5.7.0 | ✅ Fertig | Namespace, Modifier-Registrierung, Template-Fixes |
| Smarty Template Rendering | ✅ Fertig | 11 Core-Templates erfolgreich gerendert |
| Composer Dependencies | ✅ Fertig | Alle auf kompatible Versionen aktualisiert |
| Null-Safety Fixes | ✅ Fertig | `$_SESSION`, `array_merge`, undefined array keys |
| Dynamic Properties | ✅ Fertig | `#[AllowDynamicProperties]` auf alle relevanten Klassen |
| DB/SQL Kompatibilität | ✅ Fertig | utf8mb4, ONLY_FULL_GROUP_BY-konforme Queries (keine sql_mode-Änderungen nötig) |
| **i18n (DE/EN)** | **✅ Fertig** | **Deutsch als Default, Englisch wählbar. ~490+ Keys pro Sprache. Vollständig für alle Seiten.** |
| PHPUnit Tests | ✅ 4/4 bestanden | Alle Unit-Tests grün |
| Phplint | ✅ 0 Fehler | Alle Projektdateien syntaktisch korrekt |

---

## Fehleranalyse und Fix-Status

| # | Fehler | Root Cause | Fix | Status | Commit |
|---|--------|-----------|-----|--------|--------|
| 1 | Querystring erzeugt 404 (z.B. `/?a=b`) | Router nutzt `REQUEST_URI` inkl. Query als Route | `parse_url(..., PHP_URL_PATH)` vor Routing | ✅ DONE | `8c62e66` fix: router ignores query string |
| 2 | Smarty `number_format` strict typing | PHP 8.x enforced float, DB liefert strings | `safe_number_format` wrapper + `|floatval` in allen Templates | ✅ DONE | Smarty number_format PRs |
| 3 | Rewards `rand()` unknown modifier | Smarty 4 kennt kein `rand()` als Modifier | `random_int(1,3)` im Controller, `$randVar` im Template | ✅ DONE | Rewards fix PRs |
| 4 | Rewards `is_Array` unknown modifier | Smarty Modifier case-sensitive, `is_Array` != `is_array` | `is_array` (lowercase) + Controller-Normalisierung | ✅ DONE | `f857df1` fix: rewards is_Array |
| 5 | Rankings SQL "-20, 20" negative LIMIT | `page <= 0` -> negativer Offset | Paginator clamp `$page >= 1` | ✅ DONE | `aa514af` fix: rankings pagination |
| 6 | Storage TypeError offset on string | `replaceComponentWithComponent` erhält String statt Array | JSON-decode Guards, Type-Checks, Fallbacks | ✅ DONE | `7528aab` fix: storage type guards |
| 7 | Hardcodierte englische Strings in PHP | Meldungen nicht über i18n-System | ~60 neue Keys, alle Module auf `t()` umgestellt | ✅ DONE | `cd38f10` i18n: PHP modules |
| 8 | Hardcodierte englische Strings in Templates | Template-Texte nicht über `{$L.KEY}` | ~12 Templates auf `{$L.KEY}` Lookups umgestellt | ✅ DONE | `31bc422` i18n: templates |
| 9 | Unicode-Escapes `\u00fc` in Übersetzungen | PHP single-quoted Strings ignorieren `\u` | `_sr_decode_unicode()` beim Laden der Sprachdateien | ✅ DONE | i18n system in `includes/i18n.php` |
| 10 | templates_c im Git | Kompilierte Templates sollten nicht versioniert sein | `.gitignore` Eintrag + Dokumentation | ✅ DONE | Bereits in `.gitignore` |

---

## i18n Vollständigkeits-Check

### Schlüssel-Vergleich DE vs EN
- DE: ~490+ Schlüssel
- EN: ~490+ Schlüssel
- Fehlende Schlüssel in DE: 0
- Fehlende Schlüssel in EN: 0

### Übersetzte Bereiche
- ✅ Navigation (Header, Footer, Mobile)
- ✅ Login / Registrierung / Passwort vergessen
- ✅ Dashboard (Begrüßung, Stats, Tasks)
- ✅ Tutorial (18 Schritte komplett auf Deutsch)
- ✅ Missionen / Quests (Aufgaben, Feedback, Konsole)
- ✅ Rankings (Hacker, Organisationen, Details)
- ✅ Belohnungen (Liste, Detail, alle Reward-Typen)
- ✅ Server (Liste, Detail, Apps, Transfer, Hostname)
- ✅ Lager / Storage (Verkauf, Reparatur, Montage)
- ✅ Skills & Fähigkeiten
- ✅ Grid (Knoten, Cluster, Spionage, Angriff)
- ✅ Organisationen (Forum, Kriege, Hacking-Punkte, Ränge)
- ✅ Forum (Threads, Antworten, Vorschau)
- ✅ Unterhaltungen / Nachrichten
- ✅ Job & Training
- ✅ Hackdown (Countdown, Arena, Mission)
- ✅ Datenpunkte
- ✅ Bank
- ✅ Shop
- ✅ Support
- ✅ Profil
- ✅ Freunde
- ✅ Notizen
- ✅ Suche
- ✅ Empfehlungen (Referrals)
- ✅ DNA / Einstellungen
- ✅ 404-Seite
- ✅ Admin-Navigation
- ✅ Fehlermeldungen & Erfolgsmeldungen

---

## Smoke-Test Ergebnisse

| Route | Status | Anmerkung |
|-------|--------|-----------|
| `/` | ✅ PASS | Startseite/Dashboard lädt |
| `/?a=b` | ✅ PASS | Query-String erzeugt kein 404 |
| `/?lang=de` | ✅ PASS | Sprachwechsel auf Deutsch |
| `/?lang=en` | ✅ PASS | Sprachwechsel auf Englisch |
| `/rewards/` | ✅ PASS | Belohnungsliste lädt |
| `/rewards/?x=y` | ✅ PASS | Kein 404 mit Query-String |
| `/rewards/myReward/2/` | ✅ PASS | Belohnungsdetail lädt |
| `/rewards/myReward/2/?x=y` | ✅ PASS | Kein 404 |
| `/rankings/` | ✅ PASS | Rangliste lädt |
| `/rankings/?page=0` | ✅ PASS | Page wird auf 1 geclampt |
| `/rankings/?page=-1` | ✅ PASS | Page wird auf 1 geclampt |
| `/rankings/?page=abc` | ✅ PASS | Page wird auf 1 geclampt |
| `/storage/` | ✅ PASS | Lager lädt |
| `/storage/?x=y` | ✅ PASS | Kein 404 |
| `/job/` | ✅ PASS | Job-Seite lädt |
| `/register/` | ✅ PASS | Registrierung lädt |

---

## PHP Lint

```
Alle PHP-Dateien: 0 Syntaxfehler (PHP 8.3)
```

---

## Nächste Schritte (Deploy)

```bash
composer install --prefer-dist --no-dev
rm -rf includes/templates_c/* includes/cache/*
chmod -R 775 includes/templates_c/ includes/cache/ includes/configs/
# PHP 8.3+ als Runtime, Apache mit mod_rewrite
```

### Smarty Cache leeren (PFLICHT nach Deployment)

```bash
rm -rf includes/templates_c/*
rm -rf includes/cache/*
```

Danach sollte die Anwendung fehlerfrei laufen. Im DE-Modus sind keine englischen UI-Strings mehr sichtbar.
