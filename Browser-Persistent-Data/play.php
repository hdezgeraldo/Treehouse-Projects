<?php

session_start();

$total = 5;
$page = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_NUMBER_INT);

if(empty($page)){
    // clear individual session variable
    $_SESSION['word'][1] = '';
    // or calling unset function on that variable
    unset($_SESSION['word'][2]);
    // unset ALL session variables at ONCE
    session_destroy();
    $page = 1;
}

if(isset($_POST['word'])){
    // Make the session variable an array
    // Since we "POST" to the page number AFTER the word, subtract 1
    $_SESSION['word'][$page - 1] = filter_input(INPUT_POST, 'word', FILTER_SANITIZE_STRING);
//    var_dump($_SESSION);
}

if ($page > $total) {
    header('location: story.php');
    exit;
}

include 'inc/header.php';

echo "<h1>Step $page of $total</h1>";

echo '<form method="post" action="play.php?p=' . ($page+1) . '">';
echo '<input type="hidden" name="p" value="'. ($page+1) . '" />';
echo '<div class="form-group form-group-lg">';

switch ($page) {
    case 2:
        echo '
            <label class="control-label h2" for="word">Enter a name</label>
            <input class="form-control" type="text" name="word" id="word" placeholder="Name">
            ';
        break;
    case 3:
        echo '
            <label class="control-label h2" for="word">Enter a verb ending in -ing</label>
            <input class="form-control" type="text" name="word" id="word" placeholder="verb-ing">
            <p class="help-block">An verb is a word used to describe an action, state, or occurrence.</p>
            ';
        break;
    case 4:
        echo '
            <label class="control-label h2" for="word">Enter a verb</label>
            <input class="form-control" type="text" name="word" id="word" placeholder="verb">
            <p class="help-block">An verb is a word used to describe an action, state, or occurrence.</p>
            ';
        break;
    case 5:
        echo '
            <label class="control-label h2" for="word">Enter a noun</label>
            <input class="form-control" type="text" name="word" id="word" placeholder="noun">
            <p class="help-block">An noun is a word (other than a pronoun) used to identify any of a class of people, places, or things.</p>
            ';
        break;
    default:
        echo '
            <label class="control-label h2" for="word">Enter an adjective</label>
            <input class="form-control" type="text" name="word" id="word" placeholder="adjective">
            <p class="help-block">An adjective is a word or phrase naming an attribute, added to a noun to modify or describe it.</p>
            ';
        break;
}
echo '</div>
  <button type="submit" class="btn btn-default btn-lg">Submit</button>
</form>
';
include 'inc/footer.php';