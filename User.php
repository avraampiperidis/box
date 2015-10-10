<?php

 class user {

    public $id;
    public $username;
    public $email;
    public $userfolder;

     public function __construct() {
     }

    public function getId() {
        return $this->id;
    }

    public function setId($value) {
        $this->id = $value;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($value) {
        $this->username = $value;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function getUserfolder() {
        return $this->userfolder;
    }

    public function setUserfolder($value) {
        $this->userfolder = $value;
    }


}

?>