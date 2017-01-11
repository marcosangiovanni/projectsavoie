<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="facebook_friend")
 */
class FacebookFriend
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
     * @ORM\Column(type="integer", length=100)
     */
    private $user_id;

	/**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $facebook_uid;

	/**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="friends")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
	
	public function __construct()
	{
		//parent::__construct();
	}
	
	/* Recupero il nome dal modello */
	public function __toString()
    {
        return (string)$this->name;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return FacebookFriend
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return FacebookFriend
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set facebook_uid
     *
     * @param string $facebookUid
     * @return FacebookFriend
     */
    public function setFacebookUid($facebookUid)
    {
        $this->facebook_uid = $facebookUid;

        return $this;
    }

    /**
     * Get facebook_uid
     *
     * @return string 
     */
    public function getFacebookUid()
    {
        return $this->facebook_uid;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return FacebookFriend
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
