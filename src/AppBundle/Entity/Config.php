<?php
namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="config")
 * @ORM\Entity
 */
class Config
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
     * @ORM\Column(type="string")
     */
    private $code;

    /**
     * @ORM\Column(type="string")
     */
    private $value;

    /**
     * @ORM\Column(type="text")
     */
    private $description;


	/**********************
	 * GET METHODS        *
	 **********************/

    /**
     * @return integer 
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(){
        return $this->code;
    }

    /**
     * @return string
     */
    public function getValue(){
        return $this->value;
    }

    /**
     * @return string
     */
    public function getDescription(){
        return $this->description;
    }

	/**********************
	 * SET METHODS        *
	 **********************/

    /**
     * @return string
     */
    public function setCode($code){
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function setValue($value){
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function setDescription($description){
        $this->description = $description;
        return $this;
    }


}
