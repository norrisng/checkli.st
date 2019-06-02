<?php
    echo "<select>";
    foreach(glob("lists/*.csv") as $filename) {
        echo "<option value=\"" . $filename . "\">" . $filename . "</option>";
    }
    echo "</select>";
    if($_GET['l'] == "") {
        echo "<h1>checkli.st</h1>";
        echo "<h2>Flight Simulation Checklist Viewer</h2>";
    }
?>