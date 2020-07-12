<?php

include 'list.php';

// this will display todo items, based on being completed or not
$status = "all";

// this will hold the outer array indices that match the $status
$filter = array();

foreach($list as $mainKey => $item){
	// if the given multi-array's "Complete" value matches $status,
	// then place the array index number to the $filter array
	if($status === "all" || $item['complete'] === $status){
		$filter[$mainKey] = $item['priority'];
	}
}

echo '<pre>';
var_dump($filter);
echo '</pre>';
echo '<pre>';
var_dump($list);
echo '</pre>';

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
	} else{
		echo "No";
	}
	echo "</td>";
}

echo "</tr>";
echo "</table>";

?>