<?php 
require('../configs/configs.php');
require("./View.php");
require("./helpers/Helper.php");
require_once("../controllers/PostController.php");
class WriteSomething extends View {
    
    protected $cont;
    
    protected $title;
    protected $author;
    protected $id;
    protected $genre;
    protected $content;
    
    public function __construct()  {
        
        $this->cont = new PostController();
        $this->genre_dropdown_helper = new Helper();
        
        if (isset($_POST['reset'])) {
            $this->title = "";
            $this->author = "";
            $this->identifier = "";
            $this->genre = [0,0,0,0,0,0];
            $this->content = "";
        } elseif (
            isset($_POST['title'])      && $_POST['title']!=""      &&
            isset($_POST['author'])     && $_POST['author']!=""     &&
            isset($_POST['identifier']) && $_POST['identifier']!="" &&
            isset($_POST['genre'])    && $_POST['genre'] != ""    &&
            isset($_POST['writing'])    && $_POST['writing'] != "")
        {
            $doesExists = $this->cont->checkID($_POST['identifier']);
            $valid = false;
            if ($doesExists) {
                $valid = $this->cont->updateStory(
                    $_POST['title'],
                    $_POST['author'],
                    $_POST['identifier'],
                    $_POST['genre'],
                    $_POST['writing']);
            } else {
                $valid = $this->cont->saveStory(
                    $_POST['title'],
                    $_POST['author'],
                    $_POST['identifier'],
                    $_POST['genre'],
                    $_POST['writing']);
            }
            if (!$valid) {
                $this->title = $_POST['title'];
                $this->author = $_POST['author'];
                $this->identifier = $_POST['identifier'];
                $this->genre = $_POST['genre'];
                $this->content = $_POST['writing'];
            } else {
                header("Location:../views/read_a_story.php?title=".$_POST['title']."&identifier=".$_POST['identifier']);
            }
            
        } elseif (isset($_POST['identifier']) ) {
            $story = $this->cont->getStory($_POST['identifier']);
            
            $this->title = $story->title;
            $this->author = $story->author;
            $this->id = $story->identifier;
            $this->genre = $story->genre;
            $this->content = $story->text;
            
        } else {
            $this->title = "";
            $this->author = "";
            $this->identifier = "";
            $this->genre = [0,0,0,0,0,0];
            $this->content = "";
        }
    }

    public function render() { 
        $configs = new Configs();
        $this->renderHeader("Five Thousand Characters - Write Something");
        ?>
        
        <h1><a href="./Landing.php">Five Thousand Characters</a> - Write Something</h1>
        <form method="post" action="./write_something.php" >
            <div class="label">
                <label for="title">Title</label>
                <input 
                    type="text" 
                    id="title" 
                    maxlength="<?php echo $configs->input_maxlength; ?>" 
                    name="title" 
                    value="<?php echo $this->title; ?>">
            </div>
            <div class="label">
                <label for="author">Author</label>
                <input 
                    type="text" 
                    id="author" 
                    maxlength="<?php echo $configs->input_maxlength; ?>" 
                    name="author" 
                    value="<?php echo $this->author; ?>">
            </div>
            <div class="label">
                <label for="identifier">Identifier</label>
                <input 
                    type="text" 
                    id="identifier" 
                    maxlength="<?php echo $configs->input_maxlength; ?>" 
                    name="identifier" 
                    value="<?php echo $this->id; ?>">
            </div>
            <div id="genre">
                <label for="select_tag">Genre</label>
                <select id="select_tag" name="genre[]" multiple>
                    <?php $this->genre_dropdown_helper->generate_genre_dropdown($this->genre); ?>
                </select>
            </div>
            <div id="text">
                <label for="your_writing">Your Writing</label>
                <textarea 
                    id="your_writing" 
                    maxlength="<?php echo $configs->story_maxlength; ?>" 
                    name="writing"><?php echo $this->content; ?></textarea>
                <div id="button">
                    <input type="submit" name="reset" value="Reset">
                    <input type="submit" name="save" value="Save">
                </div>
            </div>

        </form>
        <?php
        $this->renderFooter();
    }

}

$WriteSomething = new WriteSomething();
$WriteSomething->render();

?>