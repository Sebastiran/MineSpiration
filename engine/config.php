<?php
switch ($_SERVER['HTTP_HOST']){
    case 'localhost': {
	define('DEBUGMODE',true);
        $db = new mysqli('localhost','root','','MineSpiration');
        break;
    }
    case 'mine.sygnal.nl': {
	define('DEBUGMODE',true);
        $db = new mysqli('localhost','sygnaln_mine','cbWcJrRK6','sygnaln_mine');
        break;
    }
    default :
        //var_dump($_SERVER);
}