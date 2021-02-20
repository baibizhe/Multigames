<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Guess Game</title>
		<link rel="stylesheet" type="text/css" href="style.css" />

	</head>
	<body>
	<header>
			<nav>
				<ul>
				<li> <a href="">All ssssStats</a> </li>
				<li> <a href="">Guess Game</a> </li>
				<li> <a href="">Rock Paper Scissors</a> </li>
				<li> <a href="">Frogs</a> </li>
				<li> <a href="">Profile</a> </li>
				<li> <a href="">Logout</a> </li> 
                        	</ul>
			</nav>
		</header>
		<main>
			<section>
		<h1>Welcome to GuessGame</h1>
		<?php echo(view_errors($errors)); ?>
		<?php 
			foreach($_SESSION['GuessGame']->history as $key=>$value){
				echo("<br/> $value");
			}
		?>
		<form method="post">
			<input type="submit" name="submit" value="start again" />
		</form>
		</section>
		<section class='stats'>
				<h1>Stats</h1>
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
				stats go here
			</section>
			</main>
		<footer>
			A project by ME
		</footer>
	</body>
</html>

