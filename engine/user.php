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

    public function login($name, $pass){
        //De reden dat de query als volgt is: youtu.be/_jKylhJtPmI
        $query = "SELECT salt, password, verified FROM Users WHERE naam = ?";
        $stmt = $this->db->prepare($query);//zet de query in de wachtrij
        $stmt->bind_param('s',$name);//zet de string naam op positie van het eerste vraagteken
        $stmt->execute();//voer de query uit;
        $stmt->bind_result($this->salt, $this->hashedpass, $this->verified);//zet de antwoorden in de bijbehorende variablen
        $stmt->fetch();//voer de resultacties uit
        $return = array();//maak de array result
        if($this->salt != null && $this->hashedpass === hash('sha512',$this->salt.$pass)){
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