<?php
namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="training")
 * @ORM\Table(indexes={@ORM\Index(name="idx_training_position", columns={"position"})})
 * @ORM\Entity
 */
class Training
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $cutoff;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default" : true})
     */
    private $is_public;

    /**
     * @ORM\Column(type="float", nullable=false, options={"default" : 0})
     */
    private $price;
	
    /**
	 * @ORM\Column(type="point")
     */
    private $position;

	/**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

}
