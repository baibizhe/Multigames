<?php
if(!$dbconn){
    $errors[]="Can't connect to db";
}
$query = "SELECT * FROM appuser WHERE userid=$1 ;";
        $result = pg_prepare($dbconn, "", $query);
        $result = pg_execute($dbconn, "", array($_SESSION['user']));
        if($row = pg_fetch_row($result, NULL, PGSQL_ASSOC)){
                $_SESSION['userid']= $row['userid'];
    $_SESSION['password']= $row['password'];

    $_SESSION['gender']= $row['gender'];

    $_SESSION['color']= $row['color'];

    $_SESSION['for_fun']= $row['for_fun'];
       
    $_SESSION['for_c']= $row['for_chan'];
    $_SESSION['CSC409']= $row['csc409'];
        }
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css" />

<title>register</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{background:url(bg.jpg);font-family:  sans-serif;}
.login { 
    position: absolute;
    top: 30%;
    left: 50%;
    margin: -150px 0 0 -150px;
    width:300px;
    height:300px;
}
.login h1 { color:#555555; text-shadow: 0px 10px 8px #CDC673; letter-spacing:2px;text-align:center;margin-bottom:20px; }
input{
    padding:10px;
    width:100%;
    color:white;
    margin-bottom:10px;
    background-color:#555555;
    border: 1px solid black;
    border-radius:4px;
    letter-spacing:2px;
}
button.loginb{
    width:100%;
    padding:25px;
    background-color:#CDC673;
    border:1px solid black;
    border-radius:4px;
    margin:10px;
    cursor:pointer; 
} 
.checkboxs {
  display:flex;
  flex-direction:row;
  margin:5px;
  padding :20px;

}  
 .checkboxs.checkbox {
  margin:20px;
}             
.radios{
  display:flex;
  flex-direction:row;
  margin:5px;
    padding :20px;

}
.radios.radio{
  margin:20px;

}
a.error{
  font-size:25px;
    color:red;
  }
</style>
</head>

<body>
<div class="headtop"></div>
<div class="login">
  <h1>Your profile</h1>
  <form action="index.php" method="post">
    <input type="text" name="user" placeholder="Username" maxlength="20"  value=<?php echo($_SESSION['user']) ?> >
    <input type="text" name="password" maxlength="20"  placeholder="oringinal password" value=<?php echo($_SESSION['password']) ?> >


    <label>Your Gender:</label><br>
    <div class="radios">
    <input class="radio" type="radio" name="gender" value="male" 
    <?php if (($_SESSION['gender']) == 'male') {echo 'checked="checked"';} ?>>Male</input><br>
    <input  class="radio" type="radio" name="gender" value="female"
    <?php if (($_SESSION['gender']) == 'female') {echo 'checked="checked"';} ?>>Female</input><br>
    <input  class="radio" type="radio" name="gender" value="other"
    <?php if (($_SESSION['gender']) == 'other') {echo 'checked="checked"';} ?>>Other</input><p></p>
</div>

<label>Here is Why you choose CSC309:</label><br>

<div class="checkboxs">
            <input class="checkbox" type="checkbox" name="For fun" value="True" <?php if (($_SESSION['for_fun']) == 'True') {echo 'checked="checked"';} ?>>For func</input><br>
            <input class="checkbox" type="checkbox" name="For challenge" value="True" <?php if (($_SESSION['for_c']) == 'True') {echo 'checked="checked"';} ?>>challenge</input><br>
            <input class="checkbox" type="checkbox" name="For CSC409!" value="True" <?php if (($_SESSION['CSC409']) == 'True') {echo 'checked="checked"';} ?>>For CSC409!</input><p></p> 
</div>

   <label>Here is your Favorite Color:</label>
    <select name="Favorite_color">
        <option value="Blue" <?php if (($_SESSION['color']) == 'Blue') {echo 'selected="selected"';} ?>>Blue</option>       
        <option value="Green" <?php if (($_SESSION['color']) == 'Green') {echo 'selected="selected"';} ?>>Green</option>
    </select><p></p> 
    <button class="loginb" type='submit' name="login"  value="login"><a> Back to login!</a></button>
    <?php echo(view_errors($errors)); ?>
    <footer>
			I havent implement the update information.Sorry.
		</footer>
            
          
  </form>
</div>

</body>
<header>
	<?php
	include_once("nav.php");
	?>
	</header>
</html>