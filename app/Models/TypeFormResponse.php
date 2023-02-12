<?php

namespace App\Models;

use GuzzleHttp\Client;

class TypeFormResponse {

    const NOTA_FIELD_ID = "H8xS7XTCCsTN";
    const MOTIVO_FIELD_ID = "Iv5KTX8fNjZJ";
    const SATISFACAO_FIELD_ID = "zp5wkLv42Kbi";
    const TEM_COMENTARIO_FIELD_ID = "QIMLyrWpoeSB";
    const COMENTARIO_FIELD_ID = "LzNf0i0ZiBFO";


    private $formResponse;
    private $hidden;
    private $answers;
    private $definitions;

    private $fields;

    public function __construct($payload) {

        $this->formResponse = $payload["form_response"];
        $this->hidden = $this->formResponse["hidden"];
        $this->answers = $this->formResponse["answers"];
        $this->definitions = $this->formResponse["definition"]["fields"];
        $this->fields = [];

        foreach($this->answers as $answer){         

            $this->fields[$answer["field"]["id"]] = [
                "answer" => $answer,
            ];
        }

    }

    public function getNumber($id){
        return $this->fields[$id]["answer"]["number"];
    }

    public function getChoices($id){
        $awnser = $this->fields[$id]["answer"]; 
        return $awnser["choice"]["label"];
    }
    
    public function getText($id){
        return $this->fields[$id]["answer"]["text"];
    }
 
    public function getBoolean($id){
        return $this->fields[$id]["answer"]["boolean"];
    }

    public function getHidden($name){
        return $this->hidden[$name];
    }

    public function getRoot($key){
        return $this->formResponse[$key];
    }

    public function getToken(){
        return $this->getRoot("token");
    }

    public function getSubmitedAt(){
        return $this->getRoot("submitted_at");  
    }

    public function getNota(){
        return $this->getNumber(self::NOTA_FIELD_ID);
    }
    public function getMotivo(){
        return $this->getChoices(self::MOTIVO_FIELD_ID);
    }
    public function getSatisfacao(){
        return $this->getNumber(self::SATISFACAO_FIELD_ID);
    }
    public function getTemComentario(){
        return $this->getBoolean(self::TEM_COMENTARIO_FIELD_ID);
    }
    public function getComentario(){
        if($this->getTemComentario())
            return $this->getText(self::COMENTARIO_FIELD_ID);
        return "";
    }

    // hiddens fields
    public function getOrder(){
        return $this->getHidden("order");
    }

    public function getCompany(){
        return $this->getHidden("company");
    }

    public function getDriver(){
        return $this->getHidden("driver");
    }

    public function getFrom(){
        return $this->getHidden("from");
    }

    public function getIATA(){
        return $this->getHidden("ia");
    }

    public function getRoute(){
        return $this->getHidden("route");
    }

    public function getOP(){
        return $this->getHidden("op");
    }
        

}