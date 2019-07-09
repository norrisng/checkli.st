# checkli.st

Flight Simulation Checklist/Flow Viewer. Available at https://checklist.eparker.me

Displays .csv files as checklists, with the functionality for:

- Simplified checklists and step-by-step flows
- Different checklist groups (Before Start, Landing, etc)
- Items that require waiting/monitoring/confirming a certain item has been met, or that should be emphasised in the checklist
- Normal checks (Possibility to add item-by-item checking off in the future)

## Checklist Formatting

Checklists should be in the `.csv` file format, with one line per item. The file name should be the ICAO code of the aircraft (eg. `PC9.csv`). If there are multiple aircraft applying to one checklist, list all with a `+` between ICAO codes (eg. `A320+A321.csv`).

### Groups

To identify the start of a new group, the first column of the line should be `-GROUP-`, and the second the title/name of the group (eg. `Before Start`, `Landing`, etc). These will begin a new block/group within the checklist, and the title will be coloured red and italicised.

### Information/Emphasised Items

To identify an item that should be emphasised, the first column of the line should be `-INFO-`, and the second the content (eg. `Wait until NG is 90%`, `Check 3 Greens`, etc). These will span across the width of the row, and will be italicised.

### Checklist Items

To identify a normal checklist item, the first column of the line should be the item (eg. `LDG Gear Lever`, `COMM1`, etc), and the second the state that is required (eg. `DOWN`, `Tuned`, etc).
_It is also preferred that items that have an explicit value required (eg. `ON`, `OFF`, etc) are in upper case, and other items in sentence case (eg. `As Required`, `Guarded`, etc)._

## Contributing Checklists

If you have any aircraft that aren't included here, you can simply make a checklist file for it, and attach the file to an issue. If you cannot create a checklist yourself, you are also able to request a checklist be made, by creating an issue.

If there is an error in a checklist, or you have a suggested alteration to a checklist, please either make a merge request with the fix, or create an issue.

## Using the API

To use the api, get from `https://checklist.eparker.me/api.php`, with the appropriate checklist as `?l=CHECKLIST` appended to the end of the URL.

If no variable is sent, or no checklist can be found: the API will output a list of available checklists. Use one of these variables in the URL, and you will receive the checklist in JSON format.

### API Output Format

```
{
    "name":"Name of Checklist",
    "groups":[
        {
            "name":"",
            "content":[
                {
                    "type":"",
                    "content":""
                }
            ]
        }
    ]
}
```

### API Output Variables

- `name`: Name of the checklist. (The ICAO code of the aircraft)
- `groups`: Array of sections of checklist. (eg. Before Start, Engine Start, etc.)
  - `group`: Name of Group.
  - `content`: Array of lines/separate checks in group.
    - `type`: Either `info` or `check`.
      - `info`: Whole-width info, same as -INFO- in checklist formatting. `value` is a string of the value.
      - `check`: Two-part checklist line (Item to check, and state of the item). `value` is an array, where `0` is the item, and `1` is the intended state.
    - `value`
