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
  $list_data['name'] = $current;
  $first = true;
  $checklist = preg_split(
    '/\r\n|\r|\n/',
    file_get_contents("lists/" . $checklists[$current] . ".csv")
  );
  foreach ($checklist as $line) {
    $line_data = explode(",", $line);
    if ($line_data[0] == "-GROUP-") {
      if ($first == true) {
        $first = false;
        $group = array();
        $group['group'] = $line_data[1];
      } else {
        array_push($list_data, $group);
        $group = [];
        $group['group'] = $line_data[1];
      }
    } elseif ($line_data[0] == "-INFO-") {
      array_push($group['content'], array(
        "type" => "info",
        "content" => $line_data[1]
      ));
    } else {
      array_push($group['content'], $line);
    }
  }
  array_push($list_data, $group);
}

echo "<pre>";
print_r($list_data);
echo "</pre>";
// echo json_encode($photos);
?>
