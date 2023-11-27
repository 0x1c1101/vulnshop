<?php

function safestr($string)
{
	$parameters = array("<script", "alert(", "<iframe", ".css", ".js", "<meta", ">", "*", ";", "<", "<frame", "<img", "<embed", "<xml", "<IMG", "<SCRIPT", "<IFRAME", "<META", "<FRAME", "<EMBED", "<XML");
	foreach ($parameters as $parameter)
	{
		if (strpos($string,$parameter) !== false) return true;
	}
}

// function checkSession($odb)
// {
//     if ($_SERVER['REMOTE_ADDR'] != $odb->query("SELECT `ip` FROM `loginlogs` WHERE `username` = '{$_SESSION['username']}'")->fetchColumn(0))
//     {
//         unset($_SESSION['username']);
//         unset($_SESSION['ID']);
//         session_destroy();
//         header('location: /panel/login.php');
//     }
// }

class user
{
	function isloggedin()
	{
		@session_start();
		if (isset($_SESSION['username'], $_SESSION['ID'])) return true;
		return false;
	}
	
	function isadmin($odb)
	{
		$q_admin = $odb->prepare("SELECT `admin` FROM `users` WHERE `id` = :id");
		$q_admin->execute(array(':id' => $_SESSION['ID']));
		$rank = $q_admin->fetchColumn();
		if($rank == 1) return true;
		return false;
	}
}

?>
