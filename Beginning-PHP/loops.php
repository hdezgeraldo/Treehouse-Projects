<?php

include 'list.php';

$status = true;
$filter = array();

foreach($list as $key => $item){
  if($status === "all" || $item['complete'] === $status){
    // save the array index value of list's outer layer
    $filter[] = $key;
  }
}

echo "<table>";
echo "<tr>";
echo "<th>Title</th>";
echo "<th>Priority</th>";
echo "<th>Due</th>";
echo "<th>Complete</th>";
echo "</tr>";

// Loop through array and display values in an HTML table
foreach($filter as $id){
  echo "<tr>";
  echo "<td>" . $list[$id]['title'] . "</td>";
  echo "<td>" . $list[$id]['priority'] . "</td>";
  echo "<td>" . $list[$id]['due'] . "</td>";
  echo "<td>";
  
  // Display Yes/No value for boolean value within the list array
  if($list[$id]['complete']){
    echo "Yes"; 
  }else{
    echo "No";
  }
  echo "</td>";
}

echo "</tr>";
echo "</table>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>