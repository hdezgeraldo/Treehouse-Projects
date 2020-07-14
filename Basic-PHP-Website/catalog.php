<?php 
include("inc/data.php");
include("inc/functions.php");
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

<div class = "section catalog page">
	<div class="wrapper">
		<h1><?php echo $pageTitle; ?></h1>
		<ul class="items">
			<?php
				// loop through multi-dimensional catalog array
				$categories = array_category($catalog, $section);
				// Display each item in the catalog array
				foreach($categories as $id){
					echo get_item_html($id, $catalog[$id]);
				}
			?>
		</ul>
	</div>
</div>

<?php include("inc/footer.php"); ?>