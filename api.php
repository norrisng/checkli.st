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
  $list_data['groups'] = array();

  foreach ($lines as $line) {
    $line_data = explode(",", $line);

    if ($line_data[0] == "-GROUP-") {
      if ($first == true) {
        $first = false;
        $group_data = [];
        $group_data['name'] = $line_data[1];
        $group_data['content'] = array();
      } else {
        array_push($list_data['groups'], $group_data);
        $group_data = [];
        $group_data['name'] = $line_data[1];
        $group_data['content'] = array();
      }
    } elseif ($line_data[0] == "-INFO-") {
      array_push($group_data['content'], array(
        "type" => "info",
        "content" => $line_data[1]
      ));
    } else {
      array_push($group_data['content'], array(
        "type" => "check",
        "content" => array($line_data[0], $line_data[1])
      ));
    }
  }
  array_push($list_data['groups'], $group_data);
}

echo "<pre>";
print_r($list_data);
echo "</pre>";
echo json_encode($list_data);
?>
