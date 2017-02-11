<?php

namespace AppBundle\Entity\User;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\SerializedName;

use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user_user")
 * @Vich\Uploadable
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
	 * @Groups({"detail"})
	 * @Type("integer")
     */
    protected $id;


	/**********************************
	 * FIELDS TO DEFINE RELATIONSHIPS *
	 **********************************/

	/**
     * Variable to store positions
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Position", mappedBy="user", cascade={"remove"})
	 * @SerializedName("positions")
	 * @Groups({"detail"})
	 * @ORM\OrderBy({"created_at" = "DESC"})
	 * @Type("ArrayCollection")
     */
    private $positions;
	
	/**
     * Variable to store lastpositions
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Lastposition", mappedBy="user", cascade={"remove"})
	 * @SerializedName("lastpositions")
	 * @Groups({"detail"})
	 * @ORM\OrderBy({"created_at" = "DESC"})
	 * @Type("ArrayCollection")
     */
    private $lastpositions;
	
	/**
     * Variable to store stops
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Stop", mappedBy="user", cascade={"remove"})
	 * @SerializedName("stops")
	 * @Groups({"detail"})
	 * @ORM\OrderBy({"created_at" = "DESC"})
	 * @Type("ArrayCollection")
     */
    private $stops;
	
    public function __construct(){
        parent::__construct();
		$this->positions = new ArrayCollection();
		$this->lastpositions = new ArrayCollection();
        $this->stops = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int $id
     */
    public function getId(){
        return $this->id;
    }

	/*************************
	 * POSITIONS  MANAGEMENT *
	 *************************/

    /**
     * Add positions
     *
     * @param \AppBundle\Entity\Position $position
     * @return User
     */
    public function addPosition(\AppBundle\Entity\Position $position){
        $this->position[] = $position;
        return $this;
    }

    /**
     * Remove friends
     *
     * @param \AppBundle\Entity\Position $position
     */
    public function removePosition(\AppBundle\Entity\Position $position){
        $this->position->removeElement($position);
    }

    /**
     * Get friends
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPositions(){
        return $this->position;
    }


	/*****************************
	 * LASTPOSITIONS  MANAGEMENT *
	 *****************************/

    /**
     * Add lastposition
     *
     * @param \AppBundle\Entity\Lastposition $lastposition
     * @return User
     */
    public function addLastposition(\AppBundle\Entity\Lastposition $lastposition){
        $this->lastposition[] = $lastposition;
        return $this;
    }

    /**
     * Remove friends
     *
     * @param \AppBundle\Entity\Lastposition $lastposition
     */
    public function removeLastposition(\AppBundle\Entity\Lastposition $lastposition){
        $this->lastposition->removeElement($lastposition);
    }

    /**
     * Get friends
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLastpositions(){
        return $this->lastposition;
    }


	/*********************
	 * STOPS  MANAGEMENT *
	 *********************/

    /**
     * Add stop
     *
     * @param \AppBundle\Entity\Stop $stop
     * @return User
     */
    public function addStop(\AppBundle\Entity\Stop $stop){
        $this->stop[] = $stop;
        return $this;
    }

    /**
     * Remove friends
     *
     * @param \AppBundle\Entity\Stop $stop
     */
    public function removeStop(\AppBundle\Entity\Stop $stop){
        $this->stop->removeElement($stop);
    }

    /**
     * Get friends
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStops(){
        return $this->stop;
    }







	/****************************
	 * TIMESTAMPABLE MANAGEMENT *
	 ****************************/
	 
    /**
     * @return \DateTime 
     */
    public function getCreated(){
        return $this->created;
    }

    /**
     * @return \DateTime 
     */
    public function getUpdated(){
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     * @return User
     */
    public function setUpdated($updated){
        $this->updated = $updated;
        return $this;
    }

    /**
     * @param \DateTime $created
     * @return User
     */
    public function setCreated($created){
        $this->created = $created;
        return $this;
    }


}
