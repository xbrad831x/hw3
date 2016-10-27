<?php
session_start();
require_once("./View.php");
require_once("./helpers/Helper.php");
require_once("../controllers/ReadController.php");

class ReadAStory extends View {
    
    private $cont;

	public function __construct() {
        if (empty($_GET['identifier'])) {
            header("Location:./Landing.php");
        }
        $this->cont = new ReadController();
        
        $this->cont->getStory($_GET['identifier']);
        $this->cont->increment_view($_GET['identifier']);
    }
    
    public function render_rating_sys() {
        if( !empty($_GET['link']) && empty($_SESSION[$_GET['identifier']]) ) {
            $rate = $_GET['link'];
            $this->cont->set_rating($_GET['identifier'], $rate);
            $_SESSION[$_GET['identifier']] = $rate;
        }
        else if( !empty($_SESSION[$_GET['identifier']])) {
            for($i = 1; $i < 6; $i++) {
                if($_SESSION[$_GET['identifier']] == $i) {
                    echo '<b> '.$i.' </b>';
                }
                else {
                    echo ' '.$i.' ';
                }
            }
        } else {
            $url= $_SERVER['REQUEST_URI'];
            for ($x = 1; $x < 6; $x++) {
                $link = $url."&link=".$x;
                echo "<a href='$link'>$x</a>";
            }
        }
    }
    
    public function render() {
        $this->renderHeader("Five Thousand Characters - Read A Story");
        ?>
            <h1>
                <a href="./Landing.php">Five Thousand Characters</a> - 
                <?php echo $this->cont->get_title() ?>
            </h1>
			<div id="story">
                <p>
                    Author:
                    <?php echo $this->cont->get_author() ?>
                </p>
                <p>
                    Date First Saved:
                    <?php echo $this->cont->get_date() ?>
                </p>
                <p>
                    Your Rating:
                    <?php $this->render_rating_sys(); ?>
                </p>
                <!--1, 2, 3, 4 ,5-->
                <p>
                    Average Rating:
                    <?php echo $this->cont->get_rating() ?>
                </p>
                <p id="title" style="margin-top: 15px;">Story:</p>
                <p id="story_text"><?php echo $this->cont->get_text() ?></p>
            </div>
        <?php
        $this->renderFooter();
    }

}

$read_a_story = new ReadAStory();
$read_a_story->render();

?>