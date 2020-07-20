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

function random_catalog_array(){
	include("connection.php");
	// Within try-catch block, ONLY code that interacts with database
	try {
		// use the random() function
		$results = $db->query(
			"SELECT media_id, title, category, img 
			FROM Media
			ORDER BY RAND()
			LIMIT 4"
			);
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
		// this uses the number from the $id argument
		// the last line uses a " ? " which 
		$results = $db->prepare(
			"SELECT Media.media_id, title, category, img, format, year, genre, publisher, isbn
			FROM Media
			INNER JOIN Genres ON Media.genre_id = Genres.genre_id
			LEFT JOIN Books ON Media.media_id = Books.media_id
			WHERE Media.media_id = ?"
		);
		// We want to bind only the variable "$id" to the " ? " from $db->prepare()
		// Protection from SQL injection
		$results->bindParam(1, $id, PDO::PARAM_INT);
		// Executes the SQL query and load result set into $results object
		$results->execute();  // will contain boolean false if nothing is found
	} catch(Exception $e){
		echo "Unable to retrieve results";
		exit;
	}
	// We only want to use fetch, instead of fetchAll() to retrieve item information to $variable
	$item = $results->fetch();

	// early return if no item matches the ID
	if(empty($item)) return $item;

	// Add a secondary query for values contained in a multi-dimensional associative array
	try {
		// retrieve the info for all the people linked to this particular media item
		$results = $db->prepare(
			"SELECT People.fullname, Media_People.role
			FROM Media_People
			INNER JOIN People ON Media_People.people_id = People.people_id
			WHERE Media_People.media_id = ?"
		);
		// We want to bind only the variable "$id" to the " ? " from $db->prepare()
		// Protection from SQL injection
		$results->bindParam(1, $id, PDO::PARAM_INT);
		// Executes the SQL query and load result set into $results object
		$results->execute();  // will contain boolean false if nothing is found
	} catch(Exception $e){
		echo "Unable to retrieve results";
		exit;
	}

	// fetch every row, one at a time, using a while-loop
	while($row = $results->fetch(PDO::FETCH_ASSOC)){
		// organize the people as they go, into the existing multi-dimensional array
		$item[$row['role']][] = $row["fullname"];
	}

	return $item;
}

function get_item_html($item) {
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