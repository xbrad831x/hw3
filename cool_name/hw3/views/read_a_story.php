<?php
require_once("./View.php");
require_once("./helpers/Helper.php");

class ReadAStory extends View {
    
    public function render() {
        $this->renderHeader("Five Thousand Characters - Read A Story")
        ?>
            <h1>Five Thousand Characters - Read A Story</h1>
        <?php
        $this->renderFooter();
    }

}

$read_a_story = new ReadAStory();
$read_a_story->render();

?>