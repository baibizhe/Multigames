<?php
require_once "lib/lib.php";
function getProfile($user) {
	$dbconn = db_connect();
	if(!$dbconn){
        $errors[]="Can't connect to db";
    }

	$query = "SELECT * FROM appuser WHERE userid=$1;";
	$result = pg_prepare($dbconn, "", $query);
	$result = pg_execute($dbconn, "", array(
		$user
	));
	return pg_fetch_row($result);
}
function getinfo($user){
    $info = getProfile($user);
    return info;
}
?>