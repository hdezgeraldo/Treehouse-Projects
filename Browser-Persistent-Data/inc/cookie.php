<?php

session_start();

/**
 * Set a cookie named PHPSESSID using 2nd user's answer and timestamp
 */
if(isset($_GET['save'])){
    $name = urlencode($_SESSION['word'][2]) . time();
    setcookie($name, implode(':', $_SESSION['word']), strtotime('+30 days'), '/');
}
// start new URL read
elseif(isset($_GET['read'])){
    // to read the cookie, split the cookie string into individual values
    $_SESSION['word'] = array_combine(range(1,5), explode(':', $_COOKIE[$_GET['read']]));
    // redirect to the story page
    header('location: /story.php');
}
// check for deletion
elseif(isset($_GET['delete'])){
    // set cookie to an empty string that expires in the past
    setcookie($_GET['delete'], '', time() - 3600, '/');
}

header('location: /index.php');