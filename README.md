# checkli.st
Flight Simulation Checklist Viewer. Available at https://checklist.eparker.me

Displays .csv files as checklists, with the functionality for:
- Different checklist groups (Before Start, Landing, etc)
- Items that require waiting/monitoring/confirming a certain item has been met, or that should be emphasised in the checklist
- Normal checks (Possibility to add item-by-item checking off in the future)

## Checklist Formatting
Checklists should be in the `.csv` file format, with one line per item. The file name should be the ICAO code of the aircraft (eg. `PC9.csv`). If there are multiple aircraft applying to one checklist, list all with a `+` between ICAO codes (eg. `A320+A321.csv`).

### Groups
To identify the start of a new group, the first column of the line should be `-GROUP-`, and the second the title/name of the group (eg. `Before Start`, `Landing`, etc)

**Example:** `-GROUP-,Before Start`
| Result |
| --- |
| Before Start |

### Emphasised Items
To identify an item that should be emphasised, the first column of the line should be `-INFO-`, and the second the content (eg. `Wait until NG is 90%`, `Check 3 Greens`, etc)

**Example:** `-INFO-,Wait Until NG is 90%`
| Result |
| --- |
| *Wait Until NG is 90%* |

### Checklist Items
To identify a normal checklist item, the first column of the line should be the item (eg. `LDG Gear Lever`, `COMM1`, etc), and the second the state that is required (eg. `DOWN`, `Tuned`, etc).
*It is also preferred that items that have an explicit value required (eg. `ON`, `OFF`, etc) are in upper case, and other items in sentence case (eg. `As Required`, `Guarded`, etc)

**Example:** `Lights,ON`
| Result | |
| --- | --- |
| Lights | ON |

**Example:** `Pressurisation,As Req.`
| Result | |
| --- | --- |
| Pressurisation | As Req. |

## Contributing Checklists
If you have any aircraft that aren't included here, you can simply make a checklist file for it, and attach the file to an issue. If you cannot create a checklist yourself, you are also able to request a checklist be made, by creating an issue.

If there is an error in a checklist, or you have a suggested alteration to a checklist, please either make a merge request with the fix, or create an issue.