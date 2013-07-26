<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="test")
*/
class Test {

    /**
* @ORM\Id
* @ORM\GeneratedValue
* @ORM\Column(type="integer")
*/
    protected $id;

    /**
    * @ORM\Column(type="string")
    */
    protected $text;

    /**
    * @ORM\Column(type="datetime")
    */
    protected $created;
    
    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
    }
    
    public function getCreated()
    {
        return $this->created;
    }

}