<?php

function get_genre_category(){
    include("connection.php");
    try{
        $sql = "SELECT G.genre, GC.category
            FROM Genres G
            INNER JOIN Genre_Categories GC ON G.genre_id = GC.genre_id
            ORDER BY GC.category, G.genre";
        $results = $db->query($sql);
    }catch(Exception $e){
        echo "bad query";
    }
    $genres = $results->fetchAll();
    return $genres;
}

function get_genre_html($item) {
//    <optgroup label="Books">
//        <option value="Action"<?php
//        if (isset($genre) && $genre=="Action") {
//            echo " selected";
//        } >>Action</option>

    $output = "<li><a href='details.php?id="
        . $item["media_id"] . "'><img src='"
        . $item["img"] . "' alt='"
        . $item["title"] . "' />"
        . "<p>View Details</p>"
        . "</a></li>";
    return $output;
}

/**************************************************************
 * NAME: Get Catalog Count
 * DESCRIPTION: This function will run a SQL query to obtain the
 * count of the media items based on the specific category
 * PARAM: (1) String for category, default to NUULL
 * RETURN: returns a multi-array
 *************************************************************/
function get_catalog_count($category = null){
	include("connection.php");
    $category = strtolower($category);
	try{
		// count all the items in the database
		$sql = "SELECT COUNT(media_id) FROM Media";
		if(!empty($category)){
			$result = $db->prepare(
				$sql 
				. " WHERE LOWER(category) = ?"
			);
			$result->bindParam(1, $category, PDO::PARAM_STR);
		} else{
            $result = $db->prepare($sql);
        }
		$result->execute();

	}catch(Exception $e){
        echo "bad query";
	}
	$count = $result->fetchColumn(0);
	return $count;
}

/**************************************************************
 * NAME: Full Catalog Array
 * DESCRIPTION: This function will run a SQL query to obtain the
 * entire catalog multi-array
 * PARAM: None
 * RETURN: returns a multi-array
 **************************************************************/
function full_catalog_array($limit = null, $offset = 0){
	include("connection.php");
	// Within try-catch block, ONLY code that interacts with database
	try {
		// pass the query method as a string, returns "PDO statement" object 
		$sql = "SELECT media_id, title, category, img 
			FROM Media
			ORDER BY 
			REPLACE(
				REPLACE(
					REPLACE(title, 'The ', ''), 
					'An ', ''), 
					'A ', ''
			)";
		if(is_integer($limit)){
			$results = $db->prepare($sql . " LIMIT ? OFFSET ?");
			$results->bindParam(1, $limit, PDO::PARAM_INT);
			$results->bindParam(2, $offset, PDO::PARAM_INT);
		} else{
			$results = $db->prepare($sql);
		}
		$results->execute();
	} catch(Exception $e){
		echo "Unable to retrieve results";
		exit;
	}

	$catalog = $results->fetchAll();
	return $catalog;
}

/**************************************************************
 * NAME: Category Catalog Array
 * DESCRIPTION: This function will 
 * PARAM: None
 * RETURN: returns a multi-array
 **************************************************************/
function category_catalog_array($category, $limit = null, $offset = 0){
	include("connection.php");
	// Within try-catch block, ONLY code that interacts with database
	try {
		// pass the query method as a string, returns "PDO statement" object 
		$sql = "SELECT media_id, title, category,img 
			FROM Media
			WHERE LOWER(category) = ?
			ORDER BY 
			REPLACE(
				REPLACE(
					REPLACE(title, 'The ', ''), 
					'An ', ''), 
					'A ', ''
			)";
		if(is_integer($limit)){
			$results = $db->prepare($sql . " LIMIT ? OFFSET ?");
			$results->bindParam(1, $category, PDO::PARAM_STR);
			$results->bindParam(2, $limit, PDO::PARAM_INT);
			$results->bindParam(3, $offset, PDO::PARAM_INT);
		} else{
			$results = $db->prepare($sql);
			$results->bindParam(1, $category, PDO::PARAM_STR);
		}
		$results->execute();
	} catch(Exception $e){
		echo "Unable to retrieve results";
		exit;
	}

	$catalog = $results->fetchAll();
	return $catalog;
}

/**************************************************************
 * NAME: Random Catalog Array
 * DESCRIPTION: This function will run a SQL query to obtain a
 * random array with 4 items
 * PARAM: None
 * RETURN: returns a multi-array
 **************************************************************/
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

/**************************************************************
 * NAME: Single Item Array
 * DESCRIPTION: This function will run a SQL query to select
 * a single catalog item that matches a given media ID
 * PARAM: (1) integer
 * RETURN: returns a multi-array
 **************************************************************/
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

/**************************************************************
 * NAME: Get Item HTML
 * DESCRIPTION: This function will create a string that contains
 * the HTML elements and catalog item with specific parameters
 * to display to the page
 * PARAM: Pass an item from the Catalog array
 * RETURN: return a string
 **************************************************************/
function get_item_html($item) {
	$output = "<li><a href='details.php?id="
		. $item["media_id"] . "'><img src='" 
		. $item["img"] . "' alt='" 
		. $item["title"] . "' />" 
		. "<p>View Details</p>"
		. "</a></li>";
	return $output;
}

/**************************************************************
 * NAME: Array Category
 * DESCRIPTION: This function will iterate through the entire
 * catalog array and and obtain the Media item's ID and title
 * to sort, then store into an array with ONLY the keys
 * PARAM: (1) catalog array, (2) string with target category
 * RETURN: an array of integers
 **************************************************************/
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