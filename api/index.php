<?php

include('../engine/config.php');
require_once("../engine/model/user.php");

var_dump($em->find("User","test"));