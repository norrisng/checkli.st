<form action="/" method="GET">
    <select onchange="this.form.submit()" name="l">
        <option value="home">Select Checklist</option>
    <?php foreach(glob("lists/*.csv") as $filename) {
        $checklist = substr($filename,strpos($filename,"/") + 1, -4); ?>
        <option value="<?php echo $checklist; ?>" ><?php echo $checklist; ?></option>
    <?php } ?>
    </select>
    <?php if($_GET['l'] == $checklist) {echo "selected";} ?>
</form>
<?php if($_GET['l'] == "") { ?>
    <h1>checkli.st</h1>
    <h2>Flight Simulation Checklist Viewer</h2>
<?php } ?>