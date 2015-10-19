<?php

/**
 * Class userinfo
 * periexei stixeia gia ton sindedemeno xristh
 */
 class userinfo {

     private $id;
     private $username;
     private $email;
     private $userfolder;

     public function __construct($id,$username,$email,$userfolder) {
         $this->id = $id;
         $this->username = $username;
         $this->email = $email;
         $this->userfolder = $userfolder;
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