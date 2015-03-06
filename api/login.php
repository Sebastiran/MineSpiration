<?php
session_start();
/*
	deze api kijkt of er een account bestaat met wachtwoord n en wachtwoord p
	als deze bestaat zal deze ede gebruiker inloggen, anders een melding geven.
*/

set_include_path('../engine');
require_once('config.php');
require_once('user.php');

if(DEBUGMODE){
	$_POST = array_merge($_POST, $_GET);
}

if(isset($_SESSION['user'])){
	$return = array();
    $return['type'] = 'error';
    $return['errnr'] = '603';
    $return['error'] = 'already logged in';
    echo json_encode($return);
    die();
}

/* check variables */
if(isset($_POST['n'])){
    $name = htmlentities($_POST['n']);
}
else{
    $return = array();
    $return['type'] = 'error';
    $return['errnr'] = '602';
    $return['error'] = 'variable missing: name';
    echo json_encode($return);
    die();
}

if(isset($_POST['p'])){
    $password = htmlentities($_POST['p']);
}
else{
    $return = array();
    $return['type'] = 'error';
    $return['errnr'] = '602';
    $return['error'] = 'variable missing: password';
    echo json_encode($return);
    die();
}
/* check variables END*/

$user = new user($db);
echo json_encode($user->login($name, $password));