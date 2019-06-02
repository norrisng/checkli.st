<form action="index.php" method="GET">
    <select onchange="this.form.submit()">
        <option>Select Checklist</option>
    <?php foreach(glob("lists/*.csv") as $filename) {
        $filename = substr($filename,strpos($filename,"/") + 1, -4); ?>
        <option value="<?php echo $filename; ?>"><?php echo $filename; ?></option>
    <?php } ?>
    </select>
</form>
<?php if($_GET['l'] == "") { ?>
    <h1>checkli.st</h1>
    <h2>Flight Simulation Checklist Viewer</h2>
<?php } ?>