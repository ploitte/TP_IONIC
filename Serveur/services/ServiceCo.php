<?php

class ServiceCo extends Service{

    
    public function controls(){
        $bdd = new bddManager();
        $user = new User();
        $test = $user -> setUsername($this -> params["username"]);
        $user -> setPassword($this -> params["password"]);


        if(empty($this -> params["username"])){
            $this -> saveError("emptyUsername", "Username manquant");
        }
        if(empty($this -> params["password"])){
            $this -> saveError("emptyPass", "Password manquant");
        }

        if(empty($this->error)){
            if($user -> checkUserPass($bdd) == 0){
                $this -> saveError("userPass", "Username ou password incorrect");
            }
        }

        if(!empty($this -> error)){
            return $this -> error;
        }else{
            return true;
        }       
    }


}