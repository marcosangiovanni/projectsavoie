<?php
namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;

/**
 * @ORM\Table(name="sport")
 * @ORM\Entity
 */
class Sport implements Translatable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Gedmo\Translatable
     * @ORM\Column(length=256)
     */
    private $title;

    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     * and it is not necessary because globally locale can be set in listener
     */
    private $locale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    public function getId(){
        return $this->id;
    }

    public function setPicture($picture){
        $this->picture = $picture;
    }

    public function getPicture(){
        return $this->picture;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTranslatableLocale($locale){
        $this->locale = $locale;
    }
}
