<?php
/**
 * @Entity
 * @Table(name="users")
 */
class User{
     /** @Id @Column(type="string", length=16) */
    private $naam;

     /** @Column(type="string", length=128, name="password") */
    private $hashedpass;

     /** @Column(type="string", length=8) */
    private $salt;

     /** @Column(type="string", length=255) */
    private $email;

    /** @Column(type="boolean") */
    private $verified;

    /** @Column(type="integer", name="gebruikersrol") */
    private $rol;

     /** @Column(type="string", length=16) */
    private $gamenaam;

    /** @Column(type="string") */
    private $geboortedatum;

     /** @Column(type="string", length=32) */
    private $land;

    /** @Column(type="boolean") */
    private $mail;

    /** @Column(type="string", length=1) */
    private $geslacht;

    private $subscribed;
    private $subsribers;
    private $albums;

    public function __construct(){

    }

    public function getNaam() {
        return $this->naam;
    }

    public function getEmail() {
        return $this->email;
    }

    public function isVerified() {
        return $this->verified;
    }

    public function getRol() {
        return $this->rol;
    }

    public function getGamenaam() {
        return $this->gamenaam;
    }

    public function getGeboortedatum() {
        return $this->geboortedatum;
    }

    public function getLand() {
        return $this->land;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getGeslacht(){
        return $this->geslacht;
    }
    
    public function newPass($pass){
        $this->salt = hash('crc32', date('U'));
        $this->hashedpass = hash('sha512',$this->salt.$pass);
    }

    public function setNaam($naam) {
        $this->naam = $naam;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setVerified($verified) {
        $this->verified = $verified;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function setGamenaam($gamenaam) {
        $this->gamenaam = $gamenaam;
    }

    public function setGeboortedatum($geboortedatum) {
        $this->geboortedatum = $geboortedatum;
    }

    public function setLand($land) {
        $this->land = $land;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setGeslacht($geslacht) {
        $this->geslacht = $geslacht;
    }

    public function checkPass($pass){
        return $this->hashedpass === hash('sha512',$this->salt.$pass);
    }

}