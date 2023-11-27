<?php
require '../@/config.php';
require '../@/init.php';


if ($user ->isloggedin())
{
echo ' You are already logged in! Redirecting...';
echo "<meta http-equiv=\"refresh\" content=\"3;url=/admin/index.php\">";
die();
}

$username = $_POST['username'];
$password = $_POST['password'];

$SQLCheckLogin = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username AND `password` = :password");
$SQLCheckLogin -> execute(array(':username' => $username, ':password' => md5($password)));
$countLogin = $SQLCheckLogin -> fetchColumn(0);
if (!($countLogin == 1))
{
die('Username or password are invalid.');
}

$SQL = $odb -> prepare("SELECT * FROM `users` WHERE `username` = :username");
$SQL -> execute(array(':username' => $username));
$userInfo = $SQL -> fetch();
$_SESSION['username'] = $userInfo['username'];
$_SESSION['ID'] = $userInfo['id'];
echo ' Login Successful. Redirecting...<meta http-equiv="refresh" content="3;URL=/admin/index.php">';

?>