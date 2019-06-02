<?php $current = $_GET['l']; ?>
<html>
<head>
    <title><?php if($current == "") {echo "checkli.st | Flight Simulation Checklist Viewer";} else {echo $current . " | checkli.st";} ?></title>
</head>
<body>
<form action="/" method="GET">
    <select onchange="this.form.submit()" name="l">
        <option value="">Select Checklist</option>
    <?php foreach(glob("lists/*.csv") as $filename) {
        $item = substr($filename,strpos($filename,"/") + 1, -4); ?>
        <option value="<?php echo $item; ?>" <?php if($current == $item) {echo "selected";} ?>><?php echo $item; ?></option>
    <?php } ?>
    </select>
</form>
<?php if(file_exists("lists/" . $current . ".csv")) { ?>
    <?php $checklist = preg_split('/\r\n|\r|\n/', file_get_contents("lists/" . $current . ".csv")); ?>
    <h1><?php echo $current; ?> Checklist</h1>
    <table>
        <?php foreach($checklist as $check) { ?>
            <?php $line = explode(",",$check);
            if($line[0] == "-GROUP-") {?>
                <tr><td COLSPAN="3" style="color:red;"><i><?php echo $line[1]; ?></i></td></tr>
            <?php } else if($line[0] == "-CHECK-") { ?>
                <tr><td COLSPAN="3" style="text-align:center;"><i><?php echo $line[1]; ?></i></td></tr>
            <?php } else { ?>
                <tr><td COLSPAN="2"><?php echo $line[0]; ?></td><td style="border-left:1px solid black;"><?php echo $line[1]; ?></td></tr>
            <?php } ?>
        <?php } ?>
    </table>
<?php } else { ?>
    <h1>checkli.st</h1>
    <h2>Flight Simulation Checklist Viewer</h2>
<?php } ?>
</body>
</html>