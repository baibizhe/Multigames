<?php
// So I don't have to deal with unset $_REQUEST['user'] when refilling the form
// You can also take a look at the new ?? operator in PHP7

$_REQUEST['user']=!empty($_REQUEST['user']) ? $_REQUEST['user'] : '';
$_REQUEST['password']=!empty($_REQUEST['password']) ? $_REQUEST['password'] : '';
$_REQUEST['gender']=!empty($_REQUEST['gender']) ? $_REQUEST['gender'] : '';
$_REQUEST['for_fun']=!empty($_REQUEST['for_fun']) ? $_REQUEST['for_fun'] : '';
$_REQUEST['for_c']=!empty($_REQUEST['for_c']) ? $_REQUEST['for_c'] : '';
$_REQUEST['csc409']=!empty($_REQUEST['csc409']) ? $_REQUEST['csc409'] : '';
$_REQUEST['Favorite_color']=!empty($_REQUEST['Favorite_color']) ? $_REQUEST['Favorite_color'] : '';

?>
<!DOCTYPE html>
<html>
<head>
<title>register</title>
<style>
 
*{margin:0;padding:0;box-sizing:border-box;}
body{background:url(bg.jpg);font-family:  sans-serif;}
a.error{
  font-size:25px;
    color:red;
  }
.headtop{background:url(bg.jpg);height:28px;}
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
form button{
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

</style>
</head>
<body>
<div class="headtop"></div>
<div class="login">
  <h1>Login</h1>
  <form action="index.php" method="post">
    <input type="text" name="user" placeholder="Username" maxlength="20"  value=<?php echo($_REQUEST['user']) ?> >
    <input type="password" name="password" maxlength="20"  placeholder="oringinal password"  >
    <input type="password" name="passwordcon" maxlength="20"  placeholder="passwordconfir"  >


    <label>Gender:</label><br>
    <div class="radios">
    <input class="radio" type="radio" name="gender" value="male" 
    <?php if (($_REQUEST['gender']) == 'male') {echo 'checked="checked"';} ?>>Male</input><br>
    <input  class="radio" type="radio" name="gender" value="female"
    <?php if (($_REQUEST['gender']) == 'female') {echo 'checked="checked"';} ?>>Female</input><br>
    <input  class="radio" type="radio" name="gender" value="other"
    <?php if (($_REQUEST['gender']) == 'other') {echo 'checked="checked"';} ?>>Other</input><p></p>
</div>

<label>Why you choose CSC309:</label><br>

<div class="checkboxs">
<input class="checkbox" type="checkbox" name="for_fun" value="True" <?php if (($_REQUEST['for_fun']) == 'True') {echo 'checked="checked"';} ?>>For fun</input><br>
            <input class="checkbox" type="checkbox" name="for_c" value="True" <?php if (($_REQUEST['for_c']) == 'True') {echo 'checked="checked"';} ?>>For challenge</input><br>
            <input class="checkbox" type="checkbox" name="csc409" value="True" <?php if (($_REQUEST['csc409']) == 'True') {echo 'checked="checked"';} ?>>For CSC409!</input><p></p> 
</div>

   <label>Favorite Color:</label>
    <select name="Favorite_color">
        <option value="Blue" <?php if (($_REQUEST['Favorite_color']) == 'Blue') {echo 'selected="selected"';} ?>>Blue</option>       
        <option value="Green" <?php if (($_REQUEST['Favorite_color']) == 'Green') {echo 'selected="selected"';} ?>>Green</option>
    </select><p></p> 
    <button  type='submit' name="register" value="register"><a> Register !</a></button>
    <button  type='submit' name="login"  value="login"><a> Back to login!</a></button>
    <?php echo(view_errors($errors)); ?>

            
          
  </form>
</div>
</body>
</html>