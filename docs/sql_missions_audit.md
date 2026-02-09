# SQL Missions Audit: ONLY_FULL_GROUP_BY Konformität

**Stand:** 2026-02-09
**Branch:** `cursor/missionsseite-only-full-group-by-d0dd`

---

## Zusammenfassung

Drei GROUP BY-Queries im Missions-Kontext sind **nicht** ONLY_FULL_GROUP_BY-konform.
Diese Queries verursachen Fehler auf MySQL 5.7+ / 8.x mit aktivem `ONLY_FULL_GROUP_BY` sql_mode.

**Ziel:** Alle Queries fixen, ohne `sql_mode` global oder per Session zu ändern.

---

## Betroffene Queries

### Query 1: Missionsliste innerhalb einer Gruppe

| | |
|---|---|
| **Datei** | `includes/modules/quests/quests_show.php` |
| **Zeile** | 72–74 |
| **Kontext** | Zeigt alle verfügbaren Missionen einer Missionsgruppe für den eingeloggten Spieler |
| **Erwartetes Ergebnis** | Liste aller Quests in der Gruppe mit Status (erledigt ja/nein) und Typ |

**Query (vorher):**
```php
$db->groupBy('q.id');
$db->orderBy('qgroup_order', 'desc');
$quests = $db->get('quests q', null,
    'q.id, q.title, q.summary, q.time, q.id, q.level, qu.last_done done, q.type, qur.quest as qdone, party, q.qgroup_id');
```

**Generiertes SQL (vereinfacht):**
```sql
SELECT q.id, q.title, q.summary, q.time, q.id, q.level,
       qu.last_done AS done,       -- ❌ nicht in GROUP BY, nicht aggregiert
       q.type,
       qur.quest AS qdone,         -- ❌ nicht in GROUP BY, nicht aggregiert
       party,                      -- implizit q.party (OK, da q.id = PK)
       q.qgroup_id
FROM quests q
LEFT OUTER JOIN quests_user qu ON qu.user_id = ? AND qu.quest = q.id
LEFT OUTER JOIN quests_user qur ON q.required_quest_id != 0 AND qur.user_id = ? AND qur.quest = q.required_quest_id
WHERE qgroup_id = ? AND isLive = 1
  AND (q.required_quest_id = 0 OR qur.id IS NOT NULL)
  AND q.level <= ?
GROUP BY q.id
ORDER BY qgroup_order DESC
```

**Problem:** `qu.last_done` und `qur.quest` stammen aus LEFT JOIN-Tabellen und sind weder in GROUP BY noch aggregiert.

**Fix:**
- `qu.last_done` → `MAX(qu.last_done)` (letztes Abschlussdatum; semantisch korrekt)
- `qur.quest` → `MAX(qur.quest)` (prüft nur ob vorhanden; Wert ist deterministisch da alle Zeilen denselben `required_quest_id` referenzieren)
- `party` → `q.party` (explizite Tabellenqualifikation für Klarheit)

---

### Query 2: Missionsgruppen-Übersicht (Hauptseite)

| | |
|---|---|
| **Datei** | `includes/modules/quests/quests_show.php` |
| **Zeile** | 101–103 |
| **Kontext** | Zeigt alle verfügbaren Missionsgruppen für den eingeloggten Spieler |
| **Erwartetes Ergebnis** | Liste aller Gruppen mit Anzahl erledigter/gesamter Missionen |

**Query (vorher):**
```php
$db->groupBy('hqg.qgroup_id')->orderBy('gorder', 'asc');
$groups = $db->get('quest_groups hqg', null,
    'story, premium, hqg.qgroup_id, hqg.name, live_quests nrQuests, live_party_quests, (select count(...)) questsDone');
```

**Problem:** GROUP BY auf `hqg.qgroup_id` (= Primary Key). Technisch ONLY_FULL_GROUP_BY-konform, da MySQL funktionale Abhängigkeiten vom PK erkennt. Jedoch ist das GROUP BY **überflüssig** (keine JOINs, keine Duplikate möglich) und irreführend.

**Fix:** GROUP BY entfernen, da es keine JOINs gibt und `quest_groups.qgroup_id` als PK ohnehin eindeutige Zeilen garantiert.

---

### Query 3: User-Missions-Liste (Admin-Panel)

| | |
|---|---|
| **Datei** | `includes/modules/admin/manageUsers.php` |
| **Zeile** | 104–109 |
| **Kontext** | Zeigt einem Admin die erledigten Missionen eines bestimmten Spielers |
| **Erwartetes Ergebnis** | Liste aller einzigartigen erledigten Quests mit letztem Abschlussdatum |

**Query (vorher):**
```php
$missions = $db->join('quests', 'quests.id = quests_user.quest', 'LEFT OUTER')
               ->join('quest_groups', 'quest_groups.qgroup_id = quests.qgroup_id', 'LEFT OUTER')
               ->where('user_id', $hacker['id'])
               ->groupBy('quest')
               ->orderBy('created', 'desc')
               ->paginate('quests_user', $pages->current_page,
                   'quests_user.created, quests.title, quests.type, quest, quest_groups.name groupName');
```

**Generiertes SQL (vereinfacht):**
```sql
SELECT quests_user.created,          -- ❌ nicht in GROUP BY, nicht aggregiert
       quests.title,                 -- ❌ nicht in GROUP BY, nicht aggregiert
       quests.type,                  -- ❌ nicht in GROUP BY, nicht aggregiert
       quest,                        -- ✅ in GROUP BY
       quest_groups.name AS groupName -- ❌ nicht in GROUP BY, nicht aggregiert
FROM quests_user
LEFT OUTER JOIN quests ON quests.id = quests_user.quest
LEFT OUTER JOIN quest_groups ON quest_groups.qgroup_id = quests.qgroup_id
WHERE user_id = ?
GROUP BY quest
ORDER BY created DESC
LIMIT ?, ?
```

**Problem:** `quests_user.created`, `quests.title`, `quests.type`, `quest_groups.name` sind nicht in GROUP BY und nicht aggregiert.

**Fix:**
- `quests_user.created` → `MAX(quests_user.created) as created` (letztes Abschlussdatum pro Quest)
- `quests.title` → `MAX(quests.title) as title` (deterministisch: ein Quest hat genau einen Titel)
- `quests.type` → `MAX(quests.type) as type` (deterministisch: ein Quest hat genau einen Typ)
- `quest_groups.name` → `MAX(quest_groups.name) as groupName` (deterministisch: eine Gruppe hat genau einen Namen)

---

## Nicht betroffene Queries

| Datei | Zeile | Grund |
|---|---|---|
| `quests_show.php:20` | getOne (kein GROUP BY) | Einzelabfrage einer Gruppe |
| `quests_show.php:31-43` | getOne (kein GROUP BY) | Einzelabfrage einer Quest |
| `quest_inprogress.php` | kein GROUP BY | Belohnungs- und Statusverarbeitung |
| `feedback.php` | kein GROUP BY | rawQuery ohne Aggregation |
| `qclass.php` | kein GROUP BY | Keine aggregierenden Queries |
| `questManagement.php` | kein GROUP BY | Bereits in vorheriger PR gefixt |

---

## Tabellenreferenz (relevante PKs)

| Tabelle | Primary Key |
|---|---|
| `quests` | `id` |
| `quests_user` | `id` (NICHT auf `user_id, quest` unique) |
| `quest_groups` | `qgroup_id` |
