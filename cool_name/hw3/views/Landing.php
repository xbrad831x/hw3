<?php 
/*namespace cool_name\hw3\views\landing;*/
require_once("./View.php");
require_once("./helpers/Helper.php");

class Landing extends View {

	public function __construct()
	    {
	        $this->helper = new Helper();   
	    }

	public function render() {
        
        $this->renderHeader("Five Thousand Characters");
		$this->helper->populate_genre_dropdown();
        ?>

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

		</ol>
        
        <?php 
        $this->renderFooter();
    }
}

$Landing = new Landing();
$Landing->render();

?>