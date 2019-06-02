<form action="/" method="GET">
    <select onchange="this.form.submit()" name="l">
        <option value="">Select Checklist</option>
    <?php foreach(glob("lists/*.csv") as $filename) {
        $checklist = substr($filename,strpos($filename,"/") + 1, -4); ?>
        <option value="<?php echo $checklist; ?>" <?php if($_GET['l'] == $checklist) {echo "selected";} ?>><?php echo $checklist; ?></option>
    <?php } ?>
    </select>
    
</form>
<?php if(file_exists("lists/" . $filename . ".csv")) { ?>
    <h1><?php echo $filename; ?> Checklist</h1>
<?php } else { ?>
    <h1>checkli.st</h1>
    <h2>Flight Simulation Checklist Viewer</h2>
<?php } ?>