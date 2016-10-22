<?php 
	  require('../configs/configs.php');
	  require("View.php");
	  require("/helpers/Helper.php");
	  class WriteSomething extends View {
	    
	    public function __construct()
	    {
	        $this->genre_dropdown_helper = new Helper();   
	    }

		public function render() { 
			$configs = new Configs();
			$this->genre_dropdown_helper->populate_genre_dropdown();?>
			 <!DOCTYPE html>
				<html>
					<head>
						<meta charset="utf-8">
						<title>Five Thousand Characters - Write Something</title>
						<link rel="stylesheet" type="text/css" href="../styles/write_something_style.css">
					</head>

				<body>
				<h1><a href="Landing.php">Five Thousand Characters</a> - Write Something</h1>
				<form method="post" action="../controllers/Controller.php">
					<table>
						<tr>
							<td><label for="title">Title</label></td>
							<td><input type="text" id="title" maxlength="<?php echo $configs->input_maxlength; ?>" name="title"></td>
						</tr>
						</tr>
							<td><label for="author">Author</label></td>
							<td><input type="text" id="author" maxlength="<?php echo $configs->input_maxlength; ?>" name="author"></td>
						</tr>
						<tr>
							<td><label for="identifier">Identifier</label></td>
							<td><input type="text" id="identifier" maxlength="<?php echo $configs->input_maxlength; ?>" name="identifier"></td>
						</tr>
						<tr>
							<td><label for="select_tag">Genre</label></td></td>
							<td id="select"><select id="select_tag" name="genre[]" multiple><?php $this->genre_dropdown_helper->generate_genre_dropdown(); ?></select></td>
						</tr>
						<tr>
							<td><label for="your_writing">Your Writing</label></td>
							<td><textarea id="your_writing" maxlength="<?php echo $configs->story_maxlength; ?>" name="writing"></textarea></td>
						</tr>
						<tr>
							<td></td>
							<td id="buttons"><input type="reset" value="reset"><input type="submit" value="Save"></td>
						</tr>
					</table>
				</form>


				</body>


				</html>
		<?php
		}
		
	  }
$WriteSomething = new WriteSomething();
$WriteSomething->render();
 ?>