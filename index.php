
<?php
	ini_set('display_errors', 'On');
	require_once "lib/lib.php";

	require_once "model/something.php";
	require_once "model/GuessGame.php";
	require_once "model/frog.php";

	session_save_path("sess");
	session_start(); 

	$dbconn = db_connect();

	$errors=array();
	$view="";


	
	/* controller code */

	/* local actions, these are state transforms */
	if(!isset($_SESSION['state'])){
		$_SESSION['state']='login';
	}


	function logout()
	{
		session_destroy();
		$_SESSION['state']='login';
		return ;
	
	}

	switch($_SESSION['state']){
		case "login":
			// the view we display by default
			$view="login.php";
			if(isset($_POST["registerbtn"])){
				$view = "register.php";
				$_SESSION['state'] = 'register';
				break;
			}
			// check if submit or not
			if(empty($_REQUEST['submit']) || $_REQUEST['submit']!="login"){
				break;
			}

			
			
			
			// validate and set errors
			if(empty($_REQUEST['user']))$errors[]='user is required';
			if(empty($_REQUEST['password']))$errors[]='password is required';
			if(!empty($errors))break;

			// perform operation, switching state and view if necessary
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			$query = "SELECT * FROM appuser WHERE userid=$1 and password=$2 ;";
                	$result = pg_prepare($dbconn, "", $query);

                	$result = pg_execute($dbconn, "", array($_REQUEST['user'], $_REQUEST['password']));
                	if($row = pg_fetch_array($result, NULL, PGSQL_ASSOC)){
				$_SESSION['user']=$_REQUEST['user'];
				$_SESSION['password']=$_REQUEST['password'];

				$_SESSION['GuessGame']=new GuessGame();
				$_SESSION['state']='stat';
				$view = "stat.php";
			} else {
				$errors[]="invalid login";
			}
			break;
		case "register":
			$view = "register.php";

			if(isset($_POST["login"])){
				$view = "login.php";
				$_SESSION['state'] = 'login';
				break;
			}

			if(!empty($_REQUEST['password'])){
				if ($_REQUEST['password']!= $_REQUEST['passwordcon']){
					$errors[]='two password does not match';
					break;
				}
			}
			if(empty($_REQUEST['gender'])){
				$errors[]='gender is required!';
				break;

			}
			
			
			if(empty($_REQUEST['user']))$errors[]='user is required';
			if(empty($_REQUEST['password']))$errors[]='password is required';
			if(!empty($errors))break;

			if (!isset($_REQUEST['for_fun'])){
				$_REQUEST['for_fun']="False";
			}
			if (!isset($_REQUEST['for_c'])){
				$_REQUEST['for_c']="False";
			}

			if (!isset($_REQUEST['CSC409'])){
				$_REQUEST['CSC409']="False";
			}

			
			if(!$dbconn){
				$errors[]="Can't connect to db";
				break;
			}
			if(!empty($_REQUEST['user']) && !empty($_REQUEST['password'])){
			
				$query = "SELECT *  FROM appuser WHERE userid=$1";	
				$result = pg_prepare($dbconn,"",$query);
			
				$result = pg_execute($dbconn,"",array($_REQUEST['user']));
				if($row = pg_fetch_row($result, NULL, PGSQL_ASSOC)){
					if(!empty($row)){
						$errors[]="same user name already existed !";
					break;
					}
				}
				
				
					$query  = "INSERT INTO appuser(userid, password,gender,color,for_fun,for_chan,CSC409) 
				VALUES ($1 ,$2,$3,$4,$5,$6,$7)";
				$result = pg_prepare($dbconn,"",$query);


				$result = pg_execute($dbconn, "", array($_REQUEST['user'], $_REQUEST['password'],$_REQUEST['gender'],$_REQUEST['Favorite_color'],
				$_REQUEST['for_fun'],$_REQUEST['for_c'],$_REQUEST['CSC409']));
				$_SESSION['state']='login';
				$view="login.php";
				break;
			}
			break;
		case "profbtn":
			$view = "prof.php";
			if ($_SERVER['REQUEST_METHOD'] === 'POST'){

				if(isset($_POST['RPSbtn'])){
					$view = "unavailable.php";
					$_SESSION['state']='una';
					break;
				}

				if(isset($_POST["login"])){
					$view = "login.php";
					$_SESSION['state'] = 'login';
					break;
				}

				if(isset($_POST['frogbtn'])){
					$view = "frogpage.php";
					$_SESSION['state']='frog';
					break;
				}
				if (isset($_POST['logoutbtn'])) {
					logout();
					$view  = "login.php";
					break;
				}
				if(isset($_POST['guessbtn'])){
					$view = "play.php";
					$_SESSION['state']='play';
					break;
				}
				if(isset($_POST['Statsbtn'])){
					$view = "stat.php";
					$_SESSION['state']='stat';
					break;
				}
				}



			break;
			case "play":
				
				// the view we display by default
				$view="play.php";
				if (!empty($_REQUEST['postback']) and $_REQUEST['postback'] != $_SESSION['postback']) {
					break;
				}
				if ($_SERVER['REQUEST_METHOD'] === 'POST'){

				if(isset($_POST['RPSbtn'])){
					$view = "unavailable.php";
					$_SESSION['state']='una';
					break;
				}

				if(isset($_POST['profbtn'])){
					$view = "prof.php";
					$_SESSION['state']='profbtn';
					break;
				}

				if(isset($_POST['frogbtn'])){
					$view = "frogpage.php";
					$_SESSION['state']='frog';
					break;
				}
				if (isset($_POST['logoutbtn'])) {
					logout();
					$view  = "login.php";
					break;
				}
				if(isset($_POST['guessbtn'])){
					$view = "play.php";
					$_SESSION['state']='play';
					break;
				}
				if(isset($_POST['Statsbtn'])){
					$view = "stat.php";
					$_SESSION['state']='stat';
					break;
				}
				}
				// check if submit or not
				if(empty($_REQUEST['submit'])||$_REQUEST['submit']!="guess"){
					break;
				}
				
					
				if(!is_numeric($_REQUEST["guess"]))$errors[]="Guess must be numeric.";
				if(!empty($errors))break;

				// perform operation, switching state and view if necessary
				$_SESSION["GuessGame"]->makeGuess($_REQUEST['guess']);
				if($_SESSION["GuessGame"]->getState()=="correct"){
					$_SESSION['state']="won";
					$view="won.php";
				}
				$_REQUEST['guess']="";
	
				break;
				case 'frog':
					$view = "frogpage.php";
					if ($_SERVER['REQUEST_METHOD'] === 'POST'){
						if(isset($_POST['frogbtn'])){
							$view = "frogpage.php";
							$_SESSION['state']='frog';
							break;
						}

						if(isset($_POST['profbtn'])){
							$view = "prof.php";
							$_SESSION['state']='profbtn';
							break;
						}
		
					if(isset($_POST['Statsbtn'])){
						$view = "stat.php";
						$_SESSION['state']='stat';
						break;
					}
					if(isset($_POST['guessbtn'])){
						$view = "play.php";
						$_SESSION['state']='play';
						break;
					}
					if (isset($_POST['logoutbtn'])) {
						logout();
						$view  = "login.php";
						break;
					}
				}
					break;
			case "won":
				// the view we display by default
				$view="play.php";
				if (!empty($_REQUEST['postback']) and $_REQUEST['postback'] != $_SESSION['postback']) {
					break;
				}
				if ($_SERVER['REQUEST_METHOD'] === 'POST'){

				if(isset($_POST['RPSbtn'])){
					$view = "unavailable.php";
					$_SESSION['state']='una';
					break;
				}

				if(isset($_POST['profbtn'])){
					$view = "prof.php";
					$_SESSION['state']='profbtn';
					break;
				}

				if(isset($_POST['frogbtn'])){
					$view = "frogpage.php";
					$_SESSION['state']='frog';
					break;
				}
				if (isset($_POST['logoutbtn'])) {
					logout();
					$view  = "login.php";
					break;
				}
				// check if submit or not
				if(empty($_REQUEST['submit'])||$_REQUEST['submit']!="start again"){
					$errors[]="Invalid request";
					$view="won.php";
				}
				if(isset($_POST['Statsbtn'])){
					$view = "stat.php";
					$_SESSION['state']='stat';
					break;
				}
			}
				// validate and set errors
				if(!empty($errors))break;
	
	
				// perform operation, switching state and view if necessary
				$_SESSION["GuessGame"]=new GuessGame();
				$_SESSION['state']="play";
				$view="play.php";
	
				break;
			case "una":
				// if(empty($_REQUEST['submit'])||$_REQUEST['submit']!="guess"){
				// 	break;
				// }
				$view = "unavailable.php";
				if (!empty($_REQUEST['postback']) and $_REQUEST['postback'] != $_SESSION['postback']) {
					break;
				}
				if ($_SERVER['REQUEST_METHOD'] === 'POST'){

				if(isset($_POST['Statsbtn'])){
					$view = "stat.php";
					$_SESSION['state']='stat';
					break;
				}
				if(isset($_POST['profbtn'])){
					$view = "prof.php";
					$_SESSION['state']='profbtn';
					break;
				}

				if(isset($_POST['frogbtn'])){
					$view = "frogpage.php";
					$_SESSION['state']='frog';
					break;
				}
				if(isset($_POST['guessbtn'])){
					$view = "play.php";
					$_SESSION['state']='play';
					break;
				}
				if (isset($_POST['logoutbtn'])) {
					logout();
					$view  = "login.php";
					break;
				}
				break;
			}
			case 'stat':
				$view = "stat.php";
				if (!empty($_REQUEST['postback']) and $_REQUEST['postback'] != $_SESSION['postback']) {
					break;
				}
				if ($_SERVER['REQUEST_METHOD'] === 'POST'){
					if(isset($_POST['frogbtn'])){
						$view = "frogpage.php";
						$_SESSION['state']='frog';
						break;
					}
					if(isset($_POST['profbtn'])){
						$view = "prof.php";
						$_SESSION['state']='profbtn';
						break;
					}
	
					if(isset($_POST['guessbtn'])){
						$view = "play.php";
						$_SESSION['state']='play';
						break;
					}
					if (isset($_POST['logoutbtn'])) {
						logout();
						$view  = "login.php";
						break;
					}
					if(isset($_POST['RPSbtn'])){
						$view = "unavailable.php";
						$_SESSION['state']='una';
						break;
					}
				}
				break;

	}

	require_once "view/$view";
?>
