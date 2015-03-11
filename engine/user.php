<?php
class user{

	private $db;
	private $naam;
	private $hashedpass;
	private $salt;
	private $emailadres;
	private $verified;
	private $rol;
	private $gamenaam;
	private $geboortedatum;
	private $land;
	private $mail;
	private $subscribed;
	private $subsribers;
	private $albums;

	public function __construct($db){
		$this->db = $db;
	}
        
        public function findInDatabase($name){
            $query = "SELECT salt, password FROM Users WHERE naam = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('s',$name);
            $stmt->execute();
        }

	public function login($name, $pass){
		$query = "SELECT salt, password, verified FROM Users WHERE naam = ?";
		$stmt = $this->db->prepare($query);
		$stmt->bind_param('s',$name);
		$stmt->execute();
		$stmt->bind_result($salt, $this->hashedpass, $this->verified);
		$stmt->fetch();
		$return = array();
		if($salt != null && $this->hashedpass === hash('sha512',$salt.$pass)){
                        if($this->verified){
                            $_SESSION['user']['name'] = $name;
                            $return['type'] = 'success';
                            $return['mess'] = 'logged in';
                            return $return;
                        }
                        else{
                            $return['type'] = 'fail';
                            $return['mess'] = 'not verified';
                            return $return;
                        }
		}
		else{
			$return['type'] = 'fail';
			$return['mess'] = 'wrong name or pass';
			return $return;
		}
	}

}