<?php
/****************************************************************
 * Name: connections.php
 * Description: this PHP file will contain the PDO object that
 * connects to the MySQL database on the localhost.
 ***************************************************************/

// Within try-catch block, ONLY code that interacts with database
try{
    // new PHP Data Object, allowing PHP to interact with DB
    $dsn = "mysql:host=localhost;dbname=crud-database;port=8889;";
    $username = "root";
    $password = "root";

    // For local use, PHPMyAdmin doesn't use a password
    $db = new PDO($dsn, $username, $password);

    // Set error mode attribute of PDO to throw an exception
    // for ANY kind of error
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Unable to connect!";
    // Throw descriptive message regarding exception to the webpage
    echo $e->getMessage();
    exit;
}
