<form action="/" method="GET">
    <select onchange="this.form.submit()" name="l">
        <option value ="">Select Checklist</option>
    <?php foreach(glob("lists/*.csv") as $filename) {
        $filename = substr($filename,strpos($filename,"/") + 1, -4); ?>
        <option value="<?php echo $filename; ?>" <?php if($_GET['l'] == $filename) {echo "selected";} ?>><?php echo $filename; ?></option>
    <?php } ?>
    </select>
</form>
<?php if($_GET['l'] == "") { ?>
    <h1>checkli.st</h1>
    <h2>Flight Simulation Checklist Viewer</h2>
<?php } ?>