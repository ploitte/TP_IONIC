<?php

class Note extends Model{

    private $id_user;
    private $titre;
    private $content;
    private $date;


	public function getId_user(){
		return $this->id_user;
	}

	public function setId_user($id_user){
		$this->id_user = $id_user;
	}

	public function getTitre(){
		return $this->titre;
	}

	public function setTitre($titre){
		$this->titre = $titre;
	}

	public function getContent(){
		return $this->content;
	}

	public function setContent($content){
		$this->content = $content;
	}

	public function getDate(){
		return $this->date;
	}

	public function setDate($date){
		$this->date = $date;
	}


        function jsonSerialize(){
        return [
            "id_user" => $this->id_user,
            "titre" => $this->titre ,
            "content" => $this->content,
            "date" => $this->date
        ];
    }
}