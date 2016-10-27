<?php 
use cool_name\hw3\views\View;
session_start();
require_once("View.php");
require_once("./helpers/Helper.php");
require_once("../controllers/FilterController.php");

class Landing extends View {
    
    private $rated;
    private $views;
    private $newest;
    
    private $text_filter;
    private $genre_filter;

	public function __construct()  {
        $this->helper = new Helper();
        $this->cont = new FilterController();
        $this->text_filter="";
        $this->genre_filter="All Genres";
        $this->checkFilters();
    }
    
    public function checkFilters() {
        $filtered = false;
        
        if (isset($_REQUEST['text_filter']) && $_REQUEST['text_filter'] == "") {
            $this->text_filter = "";
            $_SESSION['text_filter'] = $this->text_filter;
        }
        else if ( !empty($_REQUEST['text_filter']) ) {
            $this->text_filter = $_REQUEST['text_filter'];
            $_SESSION['text_filter'] = $_REQUEST['text_filter'];
            $filtered = true;
        }
        else if(!empty($_SESSION['text_filter']))
        {
            $this->text_filter = $_SESSION['text_filter'];
        }
        else 
        {
            $this->text_filter = "";
            $_SESSION['text_filter'] = $this->text_filter;
        }
            
        if ( !empty($_REQUEST['genre_filter'])) {
            $this->genre_filter = $_REQUEST['genre_filter'];
            $_SESSION['genre_filter'] = $_REQUEST['genre_filter'];
            $filtered = true;
        } else if(!empty($_SESSION['genre_filter'])) {
            $this->genre_filter = $_SESSION['genre_filter'];
        } else {
            $this->genre_filter = "All Genres";
            $_SESSION['genre_filter'] = $this->genre_filter;
        }
           
        if ($filtered) {
            $this->rated = $this->cont->get_filtered_rated($this->text_filter, $this->genre_filter);
            $this->views = $this->cont->get_filtered_views($this->text_filter, $this->genre_filter);
            $this->newest = $this->cont->get_filtered_newest($this->text_filter, $this->genre_filter);
        } else {
            $this->rated = $this->cont->get_rated();
            $this->views = $this->cont->get_views();
            $this->newest = $this->cont->get_newest();
        }
    }

	public function render() {
        $this->renderHeader("Five Thousand Characters");
        ?>
            <h1>Five Thousand Characters</h1>
            <a href="write_something.php">Write Something!</a>
            <h2>Check out what people are writing...<h2>

            <form>
                <?php 
                    if($this->text_filter == "" || empty($_SESSION['text_filter']) ) {
                        echo "<input type='text' id='title_filter' name='text_filter' placeholder='Phrase Filter'>";
                    } else {
                        echo "<input type='text' id='title_filter' name='text_filter' placeholder='Phrase Filter' value='$this->text_filter'>";
                    }
                ?>
                <select id="select_filter" name="genre_filter">
                    <?php $this->helper->generate_landing_genre($this->genre_filter);?>
                </select>
                <input type="submit" value="Go">
            </form>
            <div class="top10">
                <h3>Highest Rated</h3>
                <?php $this->helper->render_list($this->rated); ?>
            </div>
            <div class="top10">
                <h3>Most Viewed</h3>
                <?php $this->helper->render_list($this->views); ?>
            </div>
            <div class="top10">
                <h3>Newest</h3>
                <?php $this->helper->render_list($this->newest); ?>
            </div>
        <?php
        
    }
}
        
$Landing = new Landing();
$Landing->render();

/*
<?php 
	if(!empty($_REQUEST['filter_text']) && $_REQUEST['genre_filter'] === "All Genres")
	{
		$this->helper->generate_top_viewed_filtered_Text($_REQUEST['filter_text']);
	}
	else if(!empty($_REQUEST['genre_filter']) && $_REQUEST['genre_filter'] !== "All Genres" && empty($_REQUEST['filter_text']))
	{
		$this->helper->generate_top_viewed_filtered_genre($_REQUEST['genre_filter']);
	}
	else
	{
		$this->helper->generate_top_views(); 
	} ?>
*/