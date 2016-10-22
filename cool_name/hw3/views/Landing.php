<?php 
/*namespace cool_name\hw3\views\landing;*/
require ("View.php");

class Landing extends View {
	public function render() {
	
	?>
		<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Five Thousand Characters</title>
			<link rel="stylesheet" type="text/css" href="../styles/landing_style.css">
		</head>

	<body>
	<h1>Five Thousand Characters</h1>
	<a href="write_something.php">Write Something!</a>

	</body>

	</html>
	<?php 
	}
}
$Landing = new Landing();
$Landing->render();
?>
