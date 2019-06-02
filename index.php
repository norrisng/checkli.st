<?php error_reporting(0); ?>
<?php $current = $_GET['l']; ?>
<html>
<head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119179825-5"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-119179825-5');
    </script>

    <title><?php if($current == "") {echo "checkli.st | Flight Simulation Checklist Viewer";} else {echo $current . " | checkli.st";} ?></title>
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
<form method="GET">
    <select class="menu" onchange="if(this.value == '') {window.location.href = 'http://' + window.location.hostname + window.location.pathname;} else {this.form.submit();}" name="l">
        <option value="">Select Checklist</option>
    <?php foreach(glob("lists/*.csv") as $filename) {
        $item = substr($filename,strpos($filename,"/") + 1, -4); ?>
        <option value="<?php echo $item; ?>" <?php if($current == $item) {echo "selected";} ?>><?php echo $item; ?></option>
    <?php } ?>
    </select>
</form>
<?php if(file_exists("lists/" . $current . ".csv")) { ?>
    <?php $first = true; $checklist = preg_split('/\r\n|\r|\n/', file_get_contents("lists/" . $current . ".csv")); ?>
        <?php foreach($checklist as $check) { ?>
            <?php $line = explode(",",$check);
            if($line[0] == "-GROUP-") {?>
                <?php if($first == true) { $first = false; ?>
                    <div class="block">
                        <table>
                <?php } else { ?>
                        </table>
                    </div>
                    <div class="block">
                        <table>
                <?php }?>
                <span><i><?php echo $line[1]; ?></i></span>
            <?php } else if($line[0] == "-CHECK-") { ?>
                <tr><td COLSPAN="3" style="text-align:center;"><br><i><?php echo $line[1]; ?></i><br><br></td></tr>
            <?php } else { ?>
                <tr><td COLSPAN="2"><?php echo $line[0]; ?></td><td style="border-left:1px solid black;"><?php echo $line[1]; ?></td></tr>
            <?php } ?>
        <?php } ?>
        </table>
    </div>
<?php } else { ?>
    <h1>checkli.st</h1><br>
    <h2>Open-Source Flight Simulation Checklist Viewer</h2>
    <p>Available on <a href="https://github.com/flightcode/checkli.st">github</a></p>
    <p>If you have any aircraft that aren't included here, you can simply make a checklist file for it, and attach the file to an issue on github. If you cannot create a checklist yourself, you are also able to request a checklist be made, by creating an issue.</p><br>
    <br>
    <p>If there is an error in a checklist, or you have a suggested alteration to a checklist, please either make a merge request with the fix, or create an issue.</p>
<?php } ?>
</body>
</html>