<?php

class bddManager{

    private $connexion;

    public function __construct(){
        $this -> getConnexion();
    }

    public function getConnexion(){
        if(empty($this -> connexion)){
                $this -> connexion = new PDO("mysql:host=localhost;dbname=tpionic;charset=UTF8", "root", "");
                $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);     
        }
    }

    //SERVICE CONNEXION

    public function checkUserExist(User $user){
        $pdo = $this -> connexion -> prepare("SELECT username FROM user WHERE username = ?");
        $pdo -> execute(array($user -> getUsername()));
        return $pdo -> rowCount();
    }

    public function checkEmailExist(User $user){
        $pdo = $this -> connexion -> prepare("SELECT email FROM user WHERE email = ?");
        $pdo -> execute(array($user -> getEmail()));
        return $pdo -> rowCount();
    }

    //SERVICE INSCRIPTION

    public function checkUserPass(User $user){
        $pdo = $this -> connexion -> prepare("SELECT username FROM user WHERE username=:username AND password=:password");
        $pdo -> execute(array(
            "username" => $user -> getUsername(),
            "password" => $user -> getPassword()
        ));
        return $pdo -> rowCount();    
    }

    public function addUser(User $user){
        $pdo = $this -> connexion -> prepare("INSERT INTO user SET username=:username, email=:email, password=:password");
        $pdo -> execute(array(
            "username" => $user -> getUsername(),
            "email" => $user -> getEmail(),
            "password" => $user -> getPassword()
        ));
        return $pdo -> rowCount();
    }

    public function getUserByName(User $user){
        $pdo = $this -> connexion -> prepare("SELECT * FROM user WHERE username = ?");
        $pdo -> execute(array($user -> getusername()));
        return $pdo -> fetchAll(PDO::FETCH_ASSOC);
    }


}