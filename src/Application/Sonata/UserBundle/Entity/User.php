<?php

namespace Application\Sonata\UserBundle\Entity;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\SerializedName;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
	 * @Groups({"detail"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
	 * @Groups({"detail"})
	 */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
	 * @Groups({"detail"})
	 */
    private $video;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
	 * @Groups({"detail"})
	 */
    private $city;

	/**
     * @ORM\OneToMany(targetEntity="FacebookFriend", mappedBy="user", cascade={"remove"})
	 * @SerializedName("facebook_friends")
	 * @Groups({"detail"})
	 */
    private $friends;

	/**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Sport", mappedBy="users")
     */
    private $sports;
	
	/**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="myFriends")
	 */
    private $friendsWithMe;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="friendsWithMe")
     * @ORM\JoinTable(name="ass_user_friend",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="friend_user_id", referencedColumnName="id")}
     *      )
	 * @Groups({"detail"})
     * @MaxDepth(2)
	 * @SerializedName("friends")
     */
    private $myFriends;

	/**
     * @ORM\OneToMany(targetEntity="Invite", mappedBy="user", cascade={"remove"})
	 */
    private $invited;

	/**
     * Variable to store trainings to whom the user is subscribed
     * @ORM\OneToMany(targetEntity="Subscribed", mappedBy="user", cascade={"remove"})
	 * @SerializedName("associated_trainings")
	 * @Groups({"detail"})
	 */
    private $subscribed;

	/**
     * Variable to store trainings
	 * @ORM\OneToMany(targetEntity="Training", mappedBy="user", cascade={"remove"})
	 * @SerializedName("created_trainings")
	 * @Groups({"detail"})
	 * @ORM\OrderBy({"start" = "DESC"})
	 */
    private $trainings;
	
	/**
     * @ORM\Column(type="string", length=100, nullable=true)
	 * @Groups({"detail"})
	 */
    protected $firstname;
    
	/**
     * @ORM\Column(type="string", length=100, nullable=true)
	 * @Groups({"detail"})
	 */
    protected $lastname;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
	 * @Groups({"detail"})
	 */
    protected $phone;
	
 

    
	
	
	
	
	
	
	
	
	
	
		
	
	
	
	
	
	    
    public function __construct(){
        parent::__construct();
		$this->friends = new ArrayCollection();
		$this->sports = new ArrayCollection();
        $this->friendsWithMe = new ArrayCollection();
        $this->myFriends = new ArrayCollection();
        $this->invited = new ArrayCollection();
        $this->subcribed = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }


	/**********************
	 * SET METHODS        *
	 **********************/

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

    
	/**********************
	 * GET METHODS        *
	 **********************/
	 
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


/*************************
	 * FB FRIENDS MANAGEMENT *
	 *************************/

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


	/********************
	 * SPORT MANAGEMENT *
	 ********************/

    /**
     * Add sports
     *
     * @param \AppBundle\Entity\Sport $sports
     * @return User
     */
    public function addSport(\AppBundle\Entity\Sport $sports){
		$this->sports[] = $sports;
        return $this;
    }

    /**
     * Remove sports
     *
     * @param \AppBundle\Entity\Sport $sports
     */
    public function removeSport(\AppBundle\Entity\Sport $sports){
        $this->sports->removeElement($sports);
    }

    /**
     * Get sports
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSports(){
        return $this->sports;
    }


	/**************************
	 * APP FRIENDS MANAGEMENT *
	 **************************/

    /**
     * Add friendsWithMe
     *
     * @param \Application\Sonata\UserBundle\Entity\User $friendsWithMe
     * @return User
     */
    public function addFriendsWithMe(\Application\Sonata\UserBundle\Entity\User $friendsWithMe){
        $this->friendsWithMe[] = $friendsWithMe;
        return $this;
    }

    /**
     * Remove friendsWithMe
     *
     * @param \Application\Sonata\UserBundle\Entity\User $friendsWithMe
     */
    public function removeFriendsWithMe(\Application\Sonata\UserBundle\Entity\User $friendsWithMe){
        $this->friendsWithMe->removeElement($friendsWithMe);
    }

    /**
     * Get friendsWithMe
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFriendsWithMe(){
        return $this->friendsWithMe;
    }

    /**
     * Add myFriends
     *
     * @param \Application\Sonata\UserBundle\Entity\User $myFriends
     * @return User
     */
    public function addMyFriend(\Application\Sonata\UserBundle\Entity\User $myFriends){
        $this->myFriends[] = $myFriends;
        return $this;
    }

    /**
     * Remove myFriends
     *
     * @param \Application\Sonata\UserBundle\Entity\User $myFriends
     */
    public function removeMyFriend(\Application\Sonata\UserBundle\Entity\User $myFriends){
        $this->myFriends->removeElement($myFriends);
    }

    /**
     * Get myFriends
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyFriends(){
        return $this->myFriends;
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


	/***************************
	 * RELATIONSHIP MANAGEMENT *
	 ***************************/
	 
    /**
     * @param \AppBundle\Entity\Invite $invited
     * @return User
     */
    public function addInvited(\AppBundle\Entity\Invite $invited){
        $this->invited[] = $invited;
        return $this;
    }

    /**
     * @param \AppBundle\Entity\Invite $invited
     */
    public function removeInvited(\AppBundle\Entity\Invite $invited){
        $this->invited->removeElement($invited);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvited(){
        return $this->invited;
    }

    /**
     * @param \AppBundle\Entity\Subscribed $subscribed
     * @return User
     */
    public function addSubscribed(\AppBundle\Entity\Subscribed $subscribed){
        $this->subscribed[] = $subscribed;
        return $this;
    }

    /**
     * @param \AppBundle\Entity\Subscribed $subscribed
     */
    public function removeSubscribed(\AppBundle\Entity\Subscribed $subscribed){
        $this->subscribed->removeElement($subscribed);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubscribed(){
        return $this->subscribed;
    }
	
    /**
     * @param \AppBundle\Entity\Training $training
     * @return User
     */
    public function addTraining(\AppBundle\Entity\Training $training){
        $this->trainings[] = $training;
        return $this;
    }

    /**
     * @param \AppBundle\Entity\Training $training
     */
    public function removeTraining(\AppBundle\Entity\Training $training){
        $this->trainings->removeElement($training);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrainings(){
        return $this->trainings;
    }

}
