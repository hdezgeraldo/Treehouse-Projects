<?php

/****************************************************************
 * Name: get_item_html
 * Description: this function will build an HTML string of a
 * given item in the array.
 * Paramters: (1) item id, (2) interior array for single item
 * Return: string that returns HTML 
 ***************************************************************/
function get_item_html($id,$item) {
    $output = "<li><a href='details.php?id="
        . $id . "'><img src='" 
        . $item["img"] . "' alt='" 
        . $item["title"] . "' />" 
        . "<p>View Details</p>"
        . "</a></li>";
    return $output;
}

/****************************************************************
 * Name: array_category
 * Description: this function will obtain the array id's of all
 * the items that match a given category within the array.
 * Paramters: (1) mulit-array, (2) string
 * Return: array containing target array indices
 ***************************************************************/
function array_category($catalog, $category){
	$output = array();

	// loop through each of the array, and see if the target value
	// matches the category from the parameter
	foreach($catalog as $id => $item){
		if($category == null OR strtolower($category) == strtolower($item['category'])){
			// add only the keys
			$sort = $item['title'];
			$sort = ltrim($sort, "The ");
			$sort = ltrim($sort, "A ");
			$sort = ltrim($sort, "An ");
			$output[$id] = $sort;
		}
	}

	asort($output);

	return array_keys($output);
}

?>