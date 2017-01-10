<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=100)
     */
    private $name;

	/**
     * @ORM\Column(type="string", length=100)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $video;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $city;

    /**
     * @ORM\Column(type="date")
     */
    private $dob;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $city;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}