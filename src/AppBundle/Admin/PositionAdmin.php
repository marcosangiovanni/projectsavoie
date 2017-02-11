<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Util\Utility as Utility;

class PositionAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper	->add('user', null, array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
					->add('datetime','sonata_type_datetime_picker', array('attr' => array('style' => Utility::FIELD_STYLE_SMALL),'format' => Utility::DATE_FORMAT_DATETIME))
					->add('latlng','oh_google_maps',array('label' => 'Insert address','map_width' => 500),array())
		;
    }
	
    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper	->add('user','doctrine_orm_callback', array(
	            												'callback' => array('AppBundle\Util\Utility', 'filterByName'),
	            												'field_type' => 'text',
             												  ), 
             												  'entity',array(
														                'class' => 'AppBundle\Entity\User\User',
														                'choice_label' => 'id'
															  )
						)
						->add('datetime', 'doctrine_orm_date_range', array('field_type'=>'sonata_type_date_range_picker'), null, array('format' => Utility::DATE_FORMAT_DATE))
		;
    }

    protected function configureListFields(ListMapper $listMapper){
        $listMapper	->addIdentifier('id')
					->addIdentifier('user', 'entity', array(
            				'class' 	=> 	'AppBundle\Entity\User\User',
            				'property' 	=> 	'name',
        				)
					)
					->addIdentifier('datetime')
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