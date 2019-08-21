<?php

class PersonModel
{
    private $id;
    private $name;

    public function __construct() {
        $this->id = Strings::PERSON_ID;
        $this->name = Strings::PERSON_NAME;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
}
?>
