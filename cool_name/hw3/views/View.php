<?php
abstract class View {
/*namespace cool_name\hw3\views;*/
    
    abstract public function render();
    
    public function renderHeader($title) {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title><?php echo $title; ?></title>
                <meta charset="utf-8">
                <link rel="stylesheet" type="text/css" href="../styles/main.css" >
            </head>
            <body>
        <?php
    }
    
    public function renderFooter() {
        ?>
            </body>
        </html>
        <?php
    }

}
?>