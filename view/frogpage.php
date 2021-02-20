<!-- <?php
	// So I don't have to deal with uninitialized $_REQUEST['guess']
	$_REQUEST['guess']=!empty($_REQUEST['guess']) ? $_REQUEST['guess'] : '';

?> -->
<!DOCTYPE html>

<html lang="en">
        <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
		<style>
            nav li.frogbtn{      
				border: 1px solid gray; 
				background-color: white;
			} 
			a.frogbtn{
				color: black;
			}

			nav button.frogbtn{      
				background-color: white;
			} 
            </style>
		<title>Guess Game</title>
        </head>
	<body>
    <header>
	<?php
	include_once("nav.php");
	?>
	</header>
    <main>
			<section>
		<table>
			<tr>
			<form action="index.php" method="post">
				<td><img id="square0" width="50" height="50" src="img/yellowFrog.gif" /></td>
				<td><img id="square1" width="50" height="50" src="img/yellowFrog.gif"  /></td>
				<td><img id="square2" width="50" height="50" src="img/yellowFrog.gif"  /></td>
				<td><img id="square3" width="50" height="50" src="img/empty.gif"  /></td>
				<td><img id="square4" width="50" height="50" src="img/greenFrog.gif"  /></td>
				<td><img id="square5" width="50" height="50" src="img/greenFrog.gif"  /></td>
				<td><img id="square6" width="50" height="50" src="img/greenFrog.gif"  /></td>
				</form>

			</tr>
		</table>	
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
		The frog game havent been finished <p>
			A project by ME
		</footer>
	</body>
</html>