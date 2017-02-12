<?php
namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;

/**
 * @ORM\Table(name="ass_stop_company")
 * @ORM\Entity
 */
class Visit
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
     * @ORM\Column(type="integer")
     */
    private $stop_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $company_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $distance;

	/**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Stop", inversedBy="visits")
     * @ORM\JoinColumn(name="stop_id", referencedColumnName="id")
     */
    private $stop;
	
	/**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company", inversedBy="visits")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;
	
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
     * @return integer
     */
    public function getUserId(){
        return $this->user_id;
    }

    /**
     * @return integer
     */
    public function getCompanyId(){
        return $this->company_id;
    }

	/**********************
	 * SET METHODS        *
	 **********************/

    public function setUserId($userId){
        $this->user_id = $userId;
        return $this;
    }

    public function setCompanyId($companyId){
        $this->company_id = $companyId;
        return $this;
    }

    public function setStop(\AppBundle\Entity\Stop $stop = null){
        $this->stop = $stop;
        return $this;
    }

    public function setDuration($duration){
        $this->duration = $duration;
        return $this;
    }

    public function setDistance($distance){
        $this->distance = $distance;
        return $this;
    }

    public function getDuration(){
        return $this->duration;
    }

    public function getDistance(){
        return $this->distance;
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
     * @param \DateTime $created
     * @return Training
     */
    public function setCreated($created){
        $this->created = $created;
        return $this;
    }

    /**
     * @param \DateTime $updated
     * @return Training
     */
    public function setUpdated($updated){
        $this->updated = $updated;
        return $this;
    }


	/***************************
	 * RELATIONSHIP MANAGEMENT *
	 ***************************/

    /**
     * @param \AppBundle\Entity\Company $company
     * @return Visit
     */
    public function setCompany(\AppBundle\Entity\Company $company = null){
        $this->company = $company;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\Company
     */
    public function getCompany(){
        return $this->company;
    }

    /**
     * @return \AppBundle\Entity\Company
     */
    public function getStop(){
        return $this->stop;
    }

    /**
     * @param \AppBundle\Entity\User\User $user
     * @return Training
     */
    public function setUser(\AppBundle\Entity\User\User $user = null){
        $this->user = $user;
        return $this;
    }

    /**
     * @return \AppBundle\Entity\User\User 
     */
    public function getUser(){
        return $this->user;
    }

	/* Lon lat management */
	
	public function setLatLng($latlng)
    {
        $this->setPosition(new Point($latlng['lat'], $latlng['lng']));
        return $this;
    }

    /**
     * @Assert\NotBlank()
     * @OhAssert\LatLng()
     */
    public function getLatLng(){
    	if($this->getPosition()){
        	return array('lat'=>$this->getPosition()->getX(),'lng'=>$this->getPosition()->getY());
		}
    }

}
