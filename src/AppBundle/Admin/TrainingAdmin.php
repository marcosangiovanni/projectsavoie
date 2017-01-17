<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TrainingAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper	->add('title', 'text', array('attr' => array('style' => 'width:700px')))
					->add('user', null, array('attr' => array('style' => 'width:500px')))
					->add('sport', null, array('attr' => array('style' => 'width:500px')))
					->add('picture', 'url', array('attr' => array('style' => 'width:500px')))
					->add('video', 'url', array('attr' => array('style' => 'width:500px')))
					->add('start','sonata_type_datetime_picker', array('attr' => array('style' => 'width:250px')))
					->add('end','sonata_type_datetime_picker', array('attr' => array('style' => 'width:250px')))
  					->add('cutoff','sonata_type_datetime_picker', array('attr' => array('style' => 'width:250px')))
 					->add('is_public')
 					->add('price')
 					->add('position','point')
		;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper	->add('title')
						->add('user')
						->add('sport')
						->add('start')
						->add('end')
	  					->add('cutoff')
	 					->add('is_public')
	 					->add('price')
		;
    }

    protected function configureListFields(ListMapper $listMapper){
        $listMapper	->addIdentifier('id')
					->addIdentifier('title')
					->addIdentifier('user', 'entity', array(
            				'class' 	=> 	'AppBundle\Entity\User',
            				'property' 	=> 	'name',
            				'attr' 		=> 	array('style' => 'width:200px')
        				)
					)
					->addIdentifier('sport', 'entity', array(
            				'class' 	=> 	'AppBundle\Entity\Sport',
            				'property' 	=> 	'name',
            				'attr' 		=> 	array('style' => 'width:200px')
        				)
					)
					->addIdentifier('start')
					->addIdentifier('end')
					->addIdentifier('cutoff')
					->addIdentifier('is_public')
					->addIdentifier('price')
					->addIdentifier('_action', 'actions', array(
			            'actions' => array(
			                'edit' => array(),
			                'delete' => array(),
			            )
		        	))
		;
    }
}

?>