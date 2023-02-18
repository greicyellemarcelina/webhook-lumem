<?php

namespace App\Services;

class TypeFormService
{
    const NOTA_FIELD_ID = "your_note_id";
    const DELIVERY_FIELD_ID = "your_delivery_id";
    const IS_COMMENT_FIELD_ID = "your_comment_field";
    const COMMENT_FIELD_ID = "your_comment_field_id";
    const CAUSE_FIELD_ID = "your_cause_id";

    private $formResponse;
    private $hidden;
    private $answers;

    private $fields;

    public function __construct($payload)
    {

        $this->formResponse = $payload["form_response"];
        $this->hidden = $this->formResponse["hidden"];
        $this->answers = $this->formResponse["answers"];
        $this->fields = [];

        foreach ($this->answers as $answer) {

            $this->fields[$answer["field"]["id"]] = [
                "answer" => $answer,
            ];
        }
    }

    public function getNumber($id)
    {
        return $this->fields[$id]["answer"]["number"];
    }

    public function getChoices($id)
    {
        $awnser = $this->fields[$id]["answer"];
        if (isset($awnser["choices"]))
            return $awnser["choices"]["labels"];
        return [$awnser["choice"]["label"]];
    }

    public function getText($id)
    {
        return $this->fields[$id]["answer"]["text"];
    }

    public function getBoolean($id)
    {
        return $this->fields[$id]["answer"]["boolean"];
    }

    public function getHidden($name)
    {
        return $this->hidden[$name];
    }

    public function getRoot($key)
    {
        return $this->formResponse[$key];
    }

    public function getToken()
    {
        return $this->getRoot("token");
    }

    public function getSubmitedAt()
    {
        return $this->getRoot("submitted_at");
    }

    public function getRecommendationNote()
    {
        return $this->getNumber(self::NOTA_FIELD_ID);
    }

    public function getCause()
    {
        return $this->getChoices(self::CAUSE_FIELD_ID);
    }

    public function hasCause($cause) {
        $causes = $this->getCause();
        return in_array($cause, $causes);
    }

    public function getDeliveryNote()
    {
        return $this->getNumber(self::DELIVERY_FIELD_ID);
    }

    public function getIsComment()
    {
        return $this->getBoolean(self::IS_COMMENT_FIELD_ID);
    }

    public function getComment()
    {
        if ($this->getIsComment())
            return $this->getText(self::COMMENT_FIELD_ID);
        return "";
    }

    // hiddens fields
    public function getOrder()
    {
        return $this->getHidden("order");
    }

    public function getCompany()
    {
        return $this->getHidden("company");
    }

    public function getDriver()
    {
        return $this->getHidden("driver");
    }

    public function getRoute()
    {
        return   $this->getHidden("route");
    }

}
