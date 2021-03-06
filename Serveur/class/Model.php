<?php

abstract class Model{

        protected $id;

    public function __construct($donnes =  array()){
        $this -> hydrate($donnes);
    }

    public function setId($id){
        $this -> id = $id;
    }

    public function getId(){
        return $this -> id;
    }

    public function hydrate($donnes){
        foreach($donnes as $key -> $value){
            $key  = preg_replace("#_#", "", $key);

            $method = "set".ucfirst($key);
            if(method_exists($this, $method)){
                $this -> method($value);
            }
        }
    } 

}