<?php
session_start();


require_once("nordict.php");
require_once("post.php");

if(!empty($_SESSION['username']))
{
	$nt = new NordicT($_SESSION['username'], $_SESSION['token']);
	$nt->aquireToken();
	$user = $nt->getUser();
}
else
{
	$nt = new NordicT("Tquila");
	
	
	$nt->aquireToken();
	
	$user = $nt->getUser();
	
	$_SESSION['username'] = $user->getUserName();
	$_SESSION['token'] = $user->getToken();
	
	
}



$user->populateUserFieldsFromAPI();


$user->sendPM(1337, "test test test");
//var_dump($user);
?>