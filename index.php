<?php $current = $_GET['l']; ?>
<html>
<head>
    <title><?php if($current == "") {echo "checkli.st | Flight Simulation Checklist Viewer";} else {echo $filename . " | checkli.st";} ?></title>
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
    <h1><?php echo $current; ?> Checklist</h1>

<?php } else { ?>
    <h1>checkli.st</h1>
    <h2>Flight Simulation Checklist Viewer</h2>
<?php } ?>
</body>
</html>