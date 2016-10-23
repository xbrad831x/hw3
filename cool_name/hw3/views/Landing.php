<?php 
/*namespace cool_name\hw3\views\landing;*/
require_once("View.php");
require_once("/helpers/Helper.php");

class Landing extends View {

	public function __construct()
	    {
	        $this->helper = new Helper();   
	    }

	public function render() {
	$this->helper->populate_genre_dropdown();
	?>
		<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Five Thousand Characters</title>
			<link rel="stylesheet" type="text/css" href="../styles/landing_style.css">
		</head>

	<body>
	<h1>Five Thousand Characters</h1>
	<a href="write_something.php">Write Something!</a>
	<h2>Check out what people are writing...<h2>

	<form>
		<input type="text" id="title_filter" name="filter_text" placeholder="Phrase Filter">
		<select id="select_filter" name="genre_filter">
		<option selected="selected" value="All Genres">All Genres</option>
		<?php $this->helper->generate_genre_dropdown(); ?>
		</select>
	</form>

	<h3>Highest Rated</h3>

	<ol type="1">
	<?php $this->helper->generate_top_rated(); ?>
	</ol>

	<h3>Most Viewed</h3>

	<ol type="1">
	<?php $this->helper->generate_top_views(); ?>
	</ol>

	<h3>Newest</h3>

	<ol type="1">
	<?php $this->helper->generate_newest(); ?>
	</ol>
	</body>

	</html>
	<?php 
	}
}
$Landing = new Landing();
$Landing->render();
?>
