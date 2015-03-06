<?php
switch ($_SERVER['HTTP_HOST']){
    case 'localhost': {
		define('DEBUGMODE',true);
        $db = new mysqli('localhost','root','','MineSpiration');
        break;
    }
}