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
        
        if (
            isset($_POST['title'])      && $_POST['title']!=""      &&
            isset($_POST['author'])     && $_POST['author']!=""     &&
            isset($_POST['identifier']) && $_POST['identifier']!="" &&
            isset($_POST['genre[]'])    && $_POST['genre'] != ""    &&
            isset($_POST['writing'])    && $_POST['writing'] != "")
        {    
            $this->title = $_POST['title'];
            $this->author = $_POST['author'];
            $this->identifier = $_POST['identifier'];
            $this->genre[] = $_POST['genre[]'];
            $this->content = $_POST['writing'];
            
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
            $this->genre = [];
            $this->content = "";
        }
        
        $this->genre_dropdown_helper = new Helper();
    }

    public function render() { 
        $configs = new Configs();
        $this->genre_dropdown_helper->populate_genre_dropdown();
        $this->renderHeader("Five Thousand Characters - Write Something");
        ?>
        
        <h1><a href="./Landing.php">Five Thousand Characters</a> - Write Something</h1>
        <form method="post" action="./write_something.php" >
            <table>
                <tr>
                    <td><label for="title">Title</label></td>
                    <td><input type="text" id="title" maxlength="<?php echo $configs->input_maxlength; ?>" name="title" value="<?php echo $this->title; ?>"></td>
                </tr>
                <tr>
                    <td><label for="author">Author</label></td>
                    <td><input type="text" id="author" maxlength="<?php echo $configs->input_maxlength; ?>" name="author" value="<?php echo $this->author; ?>"></td>
                </tr>
                <tr>
                    <td><label for="identifier">Identifier</label></td>
                    <td><input type="text" id="identifier" maxlength="<?php echo $configs->input_maxlength; ?>" name="identifier" value="<?php echo $this->id; ?>"></td>
                </tr>
                <tr>
                    <td><label for="select_tag">Genre</label></td>
                    <td id="select">
                        <select id="select_tag" name="genre[]" multiple>
                            <?php $this->genre_dropdown_helper->generate_genre_dropdown(null); ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="your_writing">Your Writing</label></td>
                    <td><textarea id="your_writing" maxlength="<?php echo $configs->story_maxlength; ?>" name="writing"><?php echo $this->content; ?></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td id="buttons"><input type="reset" value="reset"><input type="submit" value="Save"></td>
                </tr>
            </table>
        </form>
        <?php
        $this->renderFooter();
    }

}

$WriteSomething = new WriteSomething();
$WriteSomething->render();

?>