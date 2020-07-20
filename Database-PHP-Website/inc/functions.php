<?php

// avoid code duplications by placing query functions inside its own PHP file
function full_catalog_array(){
	include("connection.php");
	// Within try-catch block, ONLY code that interacts with database
	try {
		// pass the query method as a string, returns "PDO statement" object 
		$results = $db->query("SELECT media_id, title, category,img FROM Media");
	} catch(Exception $e){
		echo "Unable to retrieve results";
		exit;
	}

	$catalog = $results->fetchAll();
	return $catalog;
}

// we pass an $id of target item since we only want information on a single item
function single_item_array($id){
	include("connection.php");
	// Within try-catch block, ONLY code that interacts with database
	try {
		// pass the query method as a string, returns "PDO statement" object 
		$results = $db->query(
			"SELECT Media.media_id, title, category, img, format, year, genre, publisher, isbn
			FROM Media
			INNER JOIN Genres ON Media.genre_id = Genres.genre_id
			LEFT JOIN Books ON Media.media_id = Books.media_id
			WHERE Media.media_id = $id"
		);
	} catch(Exception $e){
		echo "Unable to retrieve results";
		exit;
	}
	// We only want to use fetch, instead of fetchAll()
	$catalog = $results->fetch();
	return $catalog;
}

function get_item_html($id,$item) {
	$output = "<li><a href='details.php?id="
		. $item["media_id"] . "'><img src='" 
		. $item["img"] . "' alt='" 
		. $item["title"] . "' />" 
		. "<p>View Details</p>"
		. "</a></li>";
	return $output;
}

function array_category($catalog,$category) {
	$output = array();
	
	foreach ($catalog as $id => $item) {
		if ($category == null OR strtolower($category) == strtolower($item["category"])) {
			$sort = $item["title"];
			$sort = ltrim($sort,"The ");
			$sort = ltrim($sort,"A ");
			$sort = ltrim($sort,"An ");
			$output[$id] = $sort;            
		}
	}
	
	asort($output);
	return array_keys($output);
}