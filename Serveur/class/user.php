<?php


class User extends Model{

    private $username;
    private $email;
	private $password;
	private $verifPassword;

	public function getUsername(){
		return $this->username;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getVerifPassword(){
		return $this->verifPassword;
	}

	public function setVerifPassword($verifPassword){
		$this->verifPassword = $verifPassword;
	}



    function jsonSerialize(){
        return [
            "id" => $this->id,
            "username" => $this->username ,
            "email" => $this->email,
            "password" => $this ->password,
			"verifPassword" => $this ->verifPassword
        ];
    }

	public function checkUserPass(bddManager $bdd){
		return $bdd -> checkUserPass($this);
	}

	public function checkUserExist(bddManager $bdd){
		return $bdd -> checkUserExist($this);
	}

	public function checkEmailExist(bddManager $bdd){
		return $bdd -> checkEmailExist($this);
	}

	public function addUser(bddManager $bdd){
		return $bdd -> addUser($this);
	}

	public function getUserByName(bddManager $bdd){
		return $bdd -> getUserByName($this);
	}
}
