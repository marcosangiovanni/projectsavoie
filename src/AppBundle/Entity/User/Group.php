<?php

namespace AppBundle\Entity\User;

use Sonata\UserBundle\Entity\BaseGroup as BaseGroup;

class Group extends BaseGroup{

    protected $id;
	
    public function getId(){
        return $this->id;
    }

}
