<?php 
/*namespace cool_name\hw3\views\landing;*/
require_once("View.php");
require_once("/helpers/Helper.php");

class Landing extends View {

	public function __construct()
	    {
	        $this->genre_dropdown_helper = new Helper();   
	    }

	public function render() {
	$this->genre_dropdown_helper->populate_genre_dropdown();
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
		<?php $this->genre_dropdown_helper->generate_genre_dropdown(); ?>
		</select>

	</form>

	<h3>Highest Rated</h3>

	<h3>Most Viewed</h3>

	<h3>Newest</h3>

	</body>

	</html>
	<?php 
	}
}
$Landing = new Landing();
$Landing->render();
?>
