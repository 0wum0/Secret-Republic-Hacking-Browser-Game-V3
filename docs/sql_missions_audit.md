# SQL Missions Audit: ONLY_FULL_GROUP_BY Compliance

**Datum:** 2026-02-08

## Zusammenfassung

3 Queries mit `GROUP BY` im Missions-/Quest-Kontext gefunden.
Alle 3 waren nicht ONLY_FULL_GROUP_BY-konform. Alle 3 wurden gefixt.

---

## Query 1: Quest-Liste innerhalb einer Gruppe

**Datei:** `includes/modules/quests/quests_show.php` Zeile 72-74
**Funktion:** Listet alle verfuegbaren Quests einer Gruppe fuer den eingeloggten User

### Vorher (nicht konform)

```sql
SELECT q.id, q.title, q.summary, q.time, q.id, q.level,
       qu.last_done done,        -- PROBLEM: nicht aggregiert
       q.type,
       qur.quest as qdone,       -- PROBLEM: nicht aggregiert
       party, q.qgroup_id
FROM quests q
LEFT JOIN quests_user qu ON qu.user_id = :uid AND qu.quest = q.id
LEFT JOIN quests_user qur ON q.required_quest_id != 0
                          AND qur.user_id = :uid AND qur.quest = q.required_quest_id
WHERE qgroup_id = :gid AND isLive = 1
  AND (q.required_quest_id = 0 OR qur.id IS NOT NULL)
  AND q.level <= :level
GROUP BY q.id
ORDER BY qgroup_order DESC
```

### Problem

`qu.last_done` und `qur.quest` stammen aus LEFT JOINs auf `quests_user`, die pro Quest
mehrere Zeilen liefern koennen (ein User kann eine Quest mehrmals abschliessen).
`ONLY_FULL_GROUP_BY` verlangt, dass diese Spalten aggregiert werden.

### Fix

- `qu.last_done` -> `MAX(qu.last_done) as done` (letzter Abschluss-Zeitstempel)
- `qur.quest` -> `MAX(qur.quest) as qdone` (existiert-oder-nicht Pruefung, Wert egal)
- Alle nicht-aggregierten `q.*` Spalten in GROUP BY aufgenommen (MariaDB erkennt
  funktionale Abhaengigkeit bei Tabellenaliasen nicht automatisch)

### Nachher (konform)

```sql
SELECT q.id, q.title, q.summary, q.time, q.id, q.level,
       MAX(qu.last_done) as done,
       q.type,
       MAX(qur.quest) as qdone,
       party, q.qgroup_id
FROM quests q
LEFT JOIN quests_user qu ON ...
LEFT JOIN quests_user qur ON ...
WHERE ...
GROUP BY q.id, q.title, q.summary, q.time, q.level, q.type, party, q.qgroup_id, qgroup_order
ORDER BY qgroup_order DESC
```

---

## Query 2: Quest-Gruppen-Uebersicht

**Datei:** `includes/modules/quests/quests_show.php` Zeile 101-103
**Funktion:** Listet alle Quest-Gruppen die der User sehen darf

### Vorher (nicht konform)

```sql
SELECT story, premium, hqg.qgroup_id, hqg.name, live_quests nrQuests,
       live_party_quests, (subquery) questsDone
FROM quest_groups hqg
WHERE live_quests > 0 AND hqg.type = 1 AND :level >= hqg.level
  AND (hqg.qparent = 0 OR (subquery parent check) IS NOT NULL)
GROUP BY hqg.qgroup_id
ORDER BY gorder ASC
```

### Problem

Der `GROUP BY hqg.qgroup_id` ist hier ueberfluessig: Es gibt keine JOINs die Duplikate
erzeugen, und keine Aggregatfunktionen. `hqg.qgroup_id` ist zwar PK von `quest_groups`,
aber einige MySQL-Versionen bemängeln trotzdem `story`, `premium`, `name`, `gorder` etc.

### Fix

`GROUP BY` komplett entfernt. Die Query liefert ohnehin genau eine Zeile pro `qgroup_id`
da nur `quest_groups` abgefragt wird (kein Join, kein Duplikat-Risiko).

---

## Query 3: Admin User-Missions

**Datei:** `includes/modules/admin/manageUsers.php` Zeile 104-109
**Funktion:** Zeigt im Admin-Panel die Missions-Historie eines Users (gruppiert pro Quest)

### Vorher (nicht konform)

```sql
SELECT quests_user.created,       -- PROBLEM: nicht aggregiert
       quests.title, quests.type, quest, quest_groups.name groupName
FROM quests_user
LEFT JOIN quests ON quests.id = quests_user.quest
LEFT JOIN quest_groups ON quest_groups.qgroup_id = quests.qgroup_id
WHERE user_id = :id
GROUP BY quest
ORDER BY created DESC
```

### Problem

`quests_user.created` ist nicht aggregiert. Bei mehrfachem Abschluss derselben Quest
gibt es mehrere `quests_user`-Eintraege. Der Code nutzt `.created` fuer die Anzeige
"wann zuletzt abgeschlossen" und sortiert danach DESC.

### Fix

- `quests_user.created` -> `MAX(quests_user.created) as created` (letzter Abschluss)
- `ORDER BY created DESC` bleibt identisch (referenziert jetzt den Alias)
- `quests.title`, `quests.type`, `quest_groups.name` in GROUP BY aufgenommen
  (MariaDB erkennt funktionale Abhaengigkeit nicht automatisch)

### Nachher (konform)

```sql
SELECT MAX(quests_user.created) as created,
       quests.title, quests.type, quest, quest_groups.name groupName
FROM quests_user
LEFT JOIN quests ON quests.id = quests_user.quest
LEFT JOIN quest_groups ON quest_groups.qgroup_id = quests.qgroup_id
WHERE user_id = :id
GROUP BY quest, quests.title, quests.type, quest_groups.name
ORDER BY created DESC
```
