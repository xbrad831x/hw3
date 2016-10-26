<?php

require_once("../configs/configs.php");
require_once("../controllers/Controller.php");
require_once("../models/Story.php");

class PostController extends Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function checkID ($id) {
        $results = mysqli_query($this->con,
            "SELECT * FROM story WHERE identifier='$id';"
        );
        $num_rows = mysqli_num_rows($results);
        if ($num_rows == 1) {
            return true;
        }
        return false;
    }
}