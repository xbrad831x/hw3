<?php
class Controller {
/*namespace cool_name\hw3\controllers;*/
	private $title;
	private $author;
	private $identifier;
	private $genre;
	private $text;

	public function __construct()
	    {
	         $this->title = $_POST['title'];
			 $this->author = $_POST['author'];
			 $this->identifier = $_POST['identifier'];
			 $this->genre;
			 $this->text = $_POST['writing'];  
	    }	

}

?>