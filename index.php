<?php error_reporting(0); ?>
<?php $current = $_GET['l']; ?>
<?php
$checklists = array();
foreach (glob("flows/*.csv") as $filename) {
    $file = substr($filename, strpos($filename, "/") + 1, -4);
    if (strpos($file, "+") !== false) {
        foreach (explode("+", $file) as $item) {
            $checklists[$item] = $file;
        }
    } else {
        $checklists[$file] = $file;
    }
}
?>
<html>
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119179825-5"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-119179825-5');
    </script>

    <title><?php if ($current == "") {
        echo "checkli.st | Flight Simulation Checklist Viewer";
    } else {
        echo $current . " | checkli.st";
    } ?></title>
    <meta name="description" content="checkli.st - Flight Simulation Checklist Viewer">
		
    <meta property="og:site_name" content="checkli.st">
    <meta property="og:title" content="checkli.st">
    <meta property="og:type" content="article">
    <meta property="og:description" content="Flight Simulation Checklist Viewer">
    <meta property="og:url" content="https://checklist.eparker.me">

    <link rel="icon" href="https://eparker.me/assets/img/logo/logo.png">
    <link rel="shortcut icon" href="https://eparker.me/assets/img/logo/logo.png">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">

    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>
<body>
<form method="GET" autocomplete="off">
    <select class="menu" onchange="if(this.value == '') {window.location.href = 'http://' + window.location.hostname + window.location.pathname;} else {this.form.submit();}" name="l">
        <option value="" <?php if ($current == "") {
            echo "selected";
        } ?>>Select Aircraft</option>
    <?php foreach ($checklists as $key => $item) { ?>
        <option value="<?php echo $key; ?>" <?php if ($current == $key) {
    echo "selected";
} ?>><?php echo $key; ?></option>
    <?php } ?>
    </select>
<?php if (file_exists("flows/" . $checklists[$current] . ".csv")) { ?>
  <?php if (file_exists("checklists/" . $checklists[$current] . ".csv")) { ?>
    <div class="mode-select">
      <input type="radio" name="mode" value="flow" id="flow"/><label for="flow">Flow</label>
      <input type="radio" name="mode" value="checklist" id="checklist" /><label for="checklist">Checklist</label>
    </div>
  <?php } ?>
</form>
<div class="body">
    <?php
    $first = true;
    $checklist = preg_split(
        '/\r\n|\r|\n/',
        file_get_contents("flows/" . $checklists[$current] . ".csv")
    );
    ?>
        <?php foreach ($checklist as $line) { ?>
            <?php
            $line_data = explode(",", $line);
            if ($line_data[0] == "-GROUP-") { ?>
                <?php if ($first == true) {
                    $first = false; ?>
                    <div class="block">
                        <table>
                <?php
                } else {
                     ?>
                        </table>
                    </div>
                    <div class="block">
                        <table>
                <?php
                } ?>
                <span><?php echo $line_data[1]; ?></span>
            <?php } elseif ($line_data[0] == "-INFO-") { ?>
                <tr><td COLSPAN="3" style="text-align:center;"><br><i><?php echo $line_data[1]; ?></i><br><br></td></tr>
            <?php } else { ?>
                <tr><td COLSPAN="2"><?php echo $line_data[0]; ?></td><td class="left"><?php echo $line_data[1]; ?></td></tr>
            <?php }
            ?>
        <?php } ?>
        </table>
    </div>
<?php } else { ?>
</form>
<div class="body">
    <h1>checkli.st</h1><br>
    <h2>Open-Source Flight Simulation Checklist/Flow Viewer</h2><br>
    <br>
    <p>Available on <a href="https://github.com/flightcode/checkli.st">github</a></p><br>
    <br>
    <p>If you have any aircraft that aren't included here, you can simply make a checklist file for it, and attach the file to an issue on github. If you cannot create a checklist/flow yourself, you are also able to request one be made, by creating an issue.</p><br>
    <br>
    <p>If there is an error in a checklist/flow, or you have a suggested alteration, please either make a merge request with the fix, or create an issue.</p><br>
    <br>
    <h3>Current Aircraft Supported:</h3><br>
    <ul>
    <?php foreach ($checklists as $key => $item) { ?>
        <li><a href="https://checklist.eparker.me/?l=<?php echo $key; ?>"><?php echo $key; ?></a></li>
    <?php } ?>
    </ul>
<?php } ?>
</div>
</body>
</html>