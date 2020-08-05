<?php
include 'inc/header.php';

echo '<h1>Welcome to our<br />Treehouse Story Game</h1>';
echo '<p>Enter the requested words and create your story.</p>';
echo '<p><a class="btn btn-default btn-lg" href="play.php" role="button">Play</a></p>';

echo '<h2>Reread Your Saved Stories</h2>';

// Read Cookie variable
if(isset($_COOKIE)){
    // Loop through Cookie variable
    foreach($_COOKIE as $key => $value){
        // "PHPSESSID" is the cookie tied to a browser
        echo $key . '<br />';
        if($key != 'PHPSESSID'){
            echo '<div class="form-group">';
            // Send link to the cookie.php file
            echo '<a class="btn btn-info" href="inc/cookie.php?read='
            . urlencode($key) . '">';
            // get ONLY the cookie's name (timestamps are only 10 characters)
            echo substr($key, 0, -10);
            echo '';
            // date requires a timestamp, so cast the string to an int
            echo date('d M Y H:i:s'), (int) substr($key , -10);
            echo '</a>';
            echo '<a class="btn btn-danger" href="inc/cookie.php?delete='
                . urlencode($key) . '">';
            echo 'X</a>';
            echo '</div>';
        }
    }
}

include 'inc/footer.php';