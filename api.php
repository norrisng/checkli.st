<?php
error_reporting(E_ALL);

$current = $_GET['l'];

$checklists = array();
foreach (glob("lists/*.csv") as $filename) {
  $file = substr($filename, strpos($filename, "/") + 1, -4);
  if (strpos($file, "+") !== false) {
    foreach (explode("+", $file) as $item) {
      $checklists[$item] = $file;
    }
  } else {
    $checklists[$file] = $file;
  }
}
$list_data = array();

if (file_exists("lists/" . $checklists[$current] . ".csv")) {
  $lines = preg_split(
    '/\r\n|\r|\n/',
    file_get_contents("lists/" . $checklists[$current] . ".csv")
  );
  $first = true;
  $list_data['name'] = $current;

  foreach ($lines as $line) {
    $line_data = explode(",", $line);

    if ($line_data[0] == "-GROUP-") {
      if ($first == true) {
        $first = false;
        $group = [];
        $group['group'] = $line_data[1];
      }
    }
  }
  array_push($list_data['groups'], $group);
}

echo "<pre>";
print_r($list_data);
echo "</pre>";
echo json_encode($list_data);
?>
