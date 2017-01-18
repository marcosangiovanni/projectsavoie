<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Util\Utility as Utility;

class TrainingAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper	->add('title', 'text', array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
					->add('user', null, array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
					->add('sport', null, array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
					->add('picture', 'url', array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
					->add('video', 'url', array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
					->add('start','sonata_type_datetime_picker', array('attr' => array('style' => Utility::FIELD_STYLE_SMALL),'format' => Utility::DATE_FORMAT_DATETIME))
					->add('end','sonata_type_datetime_picker', array('attr' => array('style' => 'width:250px'),'format' => Utility::DATE_FORMAT_DATETIME))
  					->add('cutoff','sonata_type_datetime_picker', array('attr' => array('style' => 'width:250px'),'format' => Utility::DATE_FORMAT_DATETIME))
 					->add('is_public')
 					->add('price')
 					->add('position','point')
		;
    }
	
    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper	->add('title')
						->add('user','doctrine_orm_callback', array(
	            												'callback' => array('AppBundle\Util\Utility', 'filterByName'),
	            												'field_type' => 'text',
             												  ), 
             												  'entity',array(
														                'class' => 'AppBundle\Entity\User',
														                'choice_label' => 'surname'
															  )
						)
						->add('sport')
						->add('start', 'doctrine_orm_date_range', array('field_type'=>'sonata_type_date_range_picker'), null, array('format' => Utility::DATE_FORMAT_DATE))
						->add('end', 'doctrine_orm_date_range', array('field_type'=>'sonata_type_date_range_picker'), null, array('format' => Utility::DATE_FORMAT_DATE))
	  					->add('cutoff', 'doctrine_orm_date_range', array('field_type'=>'sonata_type_date_range_picker'), null, array('format' => Utility::DATE_FORMAT_DATE))
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
            				'attr' 		=> 	array('style' => Utility::FIELD_STYLE_SMALL)
        				)
					)
					->addIdentifier('sport', 'entity', array(
            				'class' 	=> 	'AppBundle\Entity\Sport',
            				'property' 	=> 	'name',
            				'attr' 		=> 	array('style' => Utility::FIELD_STYLE_SMALL)
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