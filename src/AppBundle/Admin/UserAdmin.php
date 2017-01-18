<?php

// src/AppBundle/Admin/CategoryAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper	->add('name')
					->add('surname')
					->add('username')
					->add('email')
					->add('enabled')
					->add('password','password')
		;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper	->add('name')
						->add('surname')
						->add('username')
						->add('email')
						->add('enabled', null, 	array('label' => 'Enabled'),'sonata_type_translatable_choice', array(
											                													'translation_domain' => "SonataAdminBundle",
																								                'choices' => array(
																								                    1 => 'label_type_yes',
																								                    2 => 'label_type_no'
																								                ))
			            )
		;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper	->addIdentifier('id')
					->addIdentifier('name')
					->addIdentifier('surname')
					->addIdentifier('username')
					->addIdentifier('email')
					->add('enabled')
					->add('_action', 'actions', array(
			            'actions' => array(
			                'edit' => array(),
			                'delete' => array(),
			            )
		        	))
					/*
					->add('friends', 'entity', array(
							'multiple' 	=> 	true,
            				'class' 	=> 	'AppBundle\Entity\FacebookFriend',
            				'property' 	=> 	'name',
            				'attr' 		=> 	array('style' => 'width:200px')
        				)
					)
					*/
		;
    }
}

?>