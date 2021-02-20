<?php
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" type="text/css" href="style.css" />
        <style>
            nav li.Statsbtn{      
				border: 1px solid gray; 
				background-color: white;
			} 
			a.Statsbtn{
				color: black;
			}

			nav button.Statsbtn{      
				background-color: white;
			} 
            </style>
		<title>Games</title>
	</head>
	<body>
		<header>
			<nav>
			<?php
	include_once("nav.php");
	        ?>
		</header>
		<main>
			<section>
				<h1>Stats By Game</h1>
				Stats by games goes here
			</section>
			<section class='stats'>
				<h1>Summary Stats</h1>
				Summary Stats  go here
				
			</section>
		</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

