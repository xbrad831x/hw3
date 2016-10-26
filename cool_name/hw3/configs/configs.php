<?php
class Configs {

	public $input_maxlength = 30;
	public $story_maxlength = 5000;
    
	public $host = "localhost";
	public $username = "root";
	public $password = "";
    public $db_name = "story";
    
    public $table_names = ["story","genre","ratings"];
    public $story_table_columns = ["Identifier", "Title", "Author", "Text", "Date", "Views"];
    public $genre_table_columns = ["Identifier", "Animal", "Funny", "Cute", "Crime", "Fiction", "Conspiracy"];
    public $ratings_table_columns = ["Identifier", "Title", "Num_Of_Ratings", "Sum_Of_Ratings"];
    
}

?>