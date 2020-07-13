<?php 
$pageTitle = "Full Catalog";

$section = null;

// Will only execute the code if "cat" is set
if(isset($_GET["cat"])){
    if($_GET["cat"] == "books"){
        $pageTitle = "Books";
        $section = "books";
    }else if($_GET["cat"] == "movies"){
        $pageTitle = "Movies";
        $section = "movies";
    }else if($_GET["cat"] == "music"){
        $pageTitle = "Music";
        $section = "music";
    }
}

include("inc/header.php"); ?>

<div>
    <h1>Full Catalog</h1>
</div>

<?php include("inc/footer.php"); ?>