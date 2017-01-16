<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $name;

	/**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dob;

	/**
     * @ORM\OneToMany(targetEntity="FacebookFriend", mappedBy="user", cascade={"remove"})
     */	
    private $friends;


    public function __construct(){
        parent::__construct();
		$this->friends = new ArrayCollection();
    }
	
	/* Set methods */
    public function setName($name){
        $this->name = $name;
        return $this;
    }
	
    public function setSurname($surname){
        $this->surname = $surname;
        return $this;
    }
    
    public function setPhone($phone){
        $this->phone = $phone;
        return $this;
    }
	
    public function setPicture($picture){
        $this->picture = $picture;
        return $this;
    }
	
    public function setVideo($video){
        $this->video = $video;
        return $this;
    }
	
    public function setCity($city){
        $this->city = $city;
        return $this;
    }
	
    public function setDob($dob){
        $this->dob = $dob;
        return $this;
    }

	/* Get methods */
    public function getName(){
        return $this->name;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function getPicture(){
        return $this->picture;
    }

    public function getVideo(){
        return $this->video;
    }

    public function getCity(){
        return $this->city;
    }

    public function getDob(){
        return $this->dob;
    }

    /**
     * Add friends
     *
     * @param \AppBundle\Entity\FacebookFriend $friends
     * @return User
     */
    public function addFriend(\AppBundle\Entity\FacebookFriend $friends){
        $this->friends[] = $friends;
        return $this;
    }

    /**
     * Remove friends
     *
     * @param \AppBundle\Entity\FacebookFriend $friends
     */
    public function removeFriend(\AppBundle\Entity\FacebookFriend $friends){
        $this->friends->removeElement($friends);
    }

    /**
     * Get friends
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFriends(){
        return $this->friends;
    }
}
