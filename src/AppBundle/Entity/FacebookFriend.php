<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

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
	 * @Groups({"detail"})
	 */
    private $id;

	/**
     * @ORM\Column(type="integer", length=100)
     */
    private $user_id;

	/**
     * @ORM\Column(type="string", length=100)
	 * @Groups({"detail"})
	 */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
	 * @Groups({"detail"})
	 */
    private $facebook_uid;

	/**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="friends")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
	
	/* Recupero il nome dal modello */
	public function __toString()
    {
        return (string)$this->name;
    }

    public function getId(){
        return $this->id;
    }

    public function setUserId($userId){
        $this->user_id = $userId;
        return $this;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function setName($name){
        $this->name = $name;
        return $this;
    }

    public function getName(){
        return $this->name;
    }

    public function setFacebookUid($facebookUid){
        $this->facebook_uid = $facebookUid;
        return $this;
    }

    public function getFacebookUid(){
        return $this->facebook_uid;
    }

    /**
     * Set user
     *
     * @param Application\Sonata\UserBundle\Entity\User $user
     * @return FacebookFriend
     */
    public function setUser(\Application\Sonata\UserBundle\Entity\User $user = null){
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getUser(){
        return $this->user;
    }
}
