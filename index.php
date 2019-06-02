<form action="index.php" method="GET">
    <select onchange="this.form.submit()">
        <option>Select Checklist</option>
    <?php foreach(glob("lists/*.csv") as $filename) {
        $filename = substr($filename,strpos($filename,"/") + 1, -4); ?>
        <option value="<?php echo $filename; ?>"><?php echo $filename; ?></option>
    <?php } ?>
    </select>
</form>