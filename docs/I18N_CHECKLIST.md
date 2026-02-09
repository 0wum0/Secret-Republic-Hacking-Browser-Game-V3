# I18N Quality Checklist: Secret Republic V3

**Stand:** 2026-02-09

---

## Umschaltung & Persistenz

- [x] Language Switch "DE | EN" im Header sichtbar (alle Seiten)
- [x] ?lang=de / ?lang=en wechselt die Sprache
- [x] Cookie `sr_lang` wird gesetzt (1 Jahr Gültigkeit)
- [x] Session `$_SESSION['sr_lang']` wird gesetzt
- [x] DB-Feld `users.language` wird gespeichert (eingeloggte User)
- [x] Priorität: DB > Cookie > Session > Default 'de'
- [x] Deutsch ist Default-Sprache

## Übersetzte Bereiche

### Kern-UI (Jede Seite)

| Bereich | Template | Status |
|---|---|---|
| Desktop-Navigation | `header_home.tpl` | ✅ Übersetzt |
| Mobile-Navigation | `header_home.tpl` | ✅ Übersetzt |
| Footer-Links | `footer_home.tpl` | ✅ Übersetzt |
| Admin-Navigation | `admin/adminNavigation.tpl` | ✅ Übersetzt |
| Language Switch | `header_home.tpl` | ✅ Implementiert |
| Tooltips/Titles | `header_home.tpl` | ✅ Übersetzt |

### Seiten

| Seite | Template/PHP | Status |
|---|---|---|
| Login/Splash | `home/splash_screen.tpl` | ✅ Übersetzt |
| Registrierung | `home/reg_form.tpl` | ✅ Übersetzt |
| Registrierung (PHP) | `register.php` | ✅ Übersetzt |
| Installer | `setup.tpl` | ✅ Übersetzt |
| Dashboard | `index/index.tpl` | ✅ Teilweise |
| Missionsübersicht | `index/missionsSummary.tpl` | ✅ Übersetzt |
| Missions-Interface | `quests_show.php` | ✅ Übersetzt |
| Missions-Übersicht | `questsCached.tpl` | ✅ Übersetzt |
| Quest-Feedback | `feedback.php` | ✅ Übersetzt |
| Quest-Engine | `qclass.php` | ✅ Übersetzt |
| Training | `train/train.tpl` + `train.php` | ✅ Übersetzt |
| Profil | `profile/profile.tpl` + `profile.php` | ✅ Übersetzt |
| Passwort vergessen | `forgot_password/*.tpl` | ✅ Übersetzt |
| Visitor Splash | `main_stats.tpl` + `visitor.php` | ✅ Übersetzt |

### PHP-Meldungen

| Modul | Datei | Status |
|---|---|---|
| Header/Tutorial | `header.php` | ✅ Übersetzt |
| Login-System | `loginSystem.php` | ✅ Übersetzt |
| Registrierung | `register.php` + `registrationSystem.php` | ✅ Übersetzt |
| Quests | `quests.php`, `quests_show.php` | ✅ Übersetzt |
| Quest In-Progress | `quest_inprogress.php` | ✅ Übersetzt |
| Feedback | `feedback.php` | ✅ Übersetzt |
| Training | `train.php` | ✅ Übersetzt |
| Profil | `profile.php` | ✅ Übersetzt |
| Admin Users | `manageUsers.php` | ✅ Teilweise |
| Funktionen | `functions.php` | ✅ Übersetzt |
| Visitor | `visitor.php` | ✅ Übersetzt |

## Dictionary-Abdeckung

| Kategorie | Prefix | Anzahl Keys |
|---|---|---|
| Navigation | NAV_ | 19 |
| Footer | FOOTER_ | 13 |
| Login/Auth | LOGIN_ | 18 |
| Registrierung | REG_ | 9 |
| Installer | INSTALL_ | 9 |
| Dashboard | DASH_ | 14 |
| Tasks | TASK_ | 9 |
| Quests/Missionen | QUEST_ | 30 |
| Admin | ADMIN_ | 10 |
| Fehler | ERR_ | 28 |
| Erfolg/Info | MSG_ | 16 |
| Header/Tutorial | HDR_ | 10 |
| Passwort vergessen | FORGOT_ | 14 |
| Training | TRAIN_ | 20 |
| Profil | PROFILE_ | 28 |
| Visitor | VISITOR_ | 7 |
| Spiel allgemein | GAME_ | 15 |
| UI | UI_ | 6 |
| Seitentitel | div. | ~30 |
| **Gesamt** | | **~280** |

## Noch nicht übersetzt (Content-Templates)

Die folgenden Templates enthalten vorwiegend spielinhaltliche Texte und dynamischen DB-Content, die in einer nächsten Phase übersetzt werden können:

- Forum-Templates (`forum/*.tpl`)
- Blog-Templates (`blog/*.tpl`)
- Grid-Templates (`grid/*.tpl`)
- Server-Templates (`servers/*.tpl`)
- Organisation-Templates (`organization/*.tpl`)
- Shop-Templates (`shop/*.tpl`, `alpha_coins/*.tpl`)
- Statische Seiten (`pages/*.tpl`)

Die i18n-Infrastruktur (`{$L.KEY}`) steht bereit und kann jederzeit auf weitere Templates angewendet werden.
