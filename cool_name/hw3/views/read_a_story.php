<?php
require_once("./View.php");
require_once("./helpers/Helper.php");

class ReadAStory extends View {

	public function __construct()
	    {
	        $this->model = new Model();   
	    }
    
    public function render() {
        $this->renderHeader("Five Thousand Characters - Read A Story")
		$this->model->db_connect();
		$this->model->inc_view($_GET['identifier']);
        ?>
            <h1>Five Thousand Characters - Read A Story</h1>
			<h1><a href="./Landing.php">Five Thousand Characters</a> - <?php echo $_GET['title']; ?></h1>
			<div>Author: <?php echo $this->model->get_author($_GET['identifier']); ?></div>
			<div>Date First Saved: <?php echo $this->model->get_date($_GET['identifier']); ?></div>
			<div>Your Rating: 
			<a href="?link=1&title=<?php echo $_GET['title']; ?>&identifier=<?php echo $_GET['identifier']; ?>" name="1">1</a>
			<a href="?link=2&title=<?php echo $_GET['title']; ?>&identifier=<?php echo $_GET['identifier']; ?>" name="2">2</a>
			<a href="?link=3&title=<?php echo $_GET['title']; ?>&identifier=<?php echo $_GET['identifier']; ?>" name="3">3</a>
			<a href="?link=4&title=<?php echo $_GET['title']; ?>&identifier=<?php echo $_GET['identifier']; ?>" name="4">4</a> 
			<a href="?link=5&title=<?php echo $_GET['title']; ?>&identifier=<?php echo $_GET['identifier']; ?>" name="5">5</a> 
			</div>
			<div> Average Rating: <?php echo $this->model->get_average_ratings($_GET['identifier']); ?></div>  
			<p> Story: <?php echo '<br />'.$this->model->get_text($_GET['identifier']); ?></p> 

				<?php
			if(!empty($_GET['link']))
			{
				$link=$_GET['link'];
				if ($link == '1'){
					$this->model->set_ratings($_GET['identifier'], 1);
				}
				if ($link == '2'){
					$this->model->set_ratings($_GET['identifier'], 2);
				}
				if ($link == '3'){
					$this->model->set_ratings($_GET['identifier'], 3);
				}
				if ($link == '4'){
					$this->model->set_ratings($_GET['identifier'], 4);
				}
				if ($link == '5'){
					$this->model->set_ratings($_GET['identifier'], 5);
				}
			}
            ?>  
        <?php
        $this->renderFooter();
    }

}

$read_a_story = new ReadAStory();
$read_a_story->render();

?>