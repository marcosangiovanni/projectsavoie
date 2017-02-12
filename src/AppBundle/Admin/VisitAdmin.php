<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Util\Utility as Utility;

class VisitAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper	->add('company.name', null, array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
					->add('stop.user.username', null, array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
					->add('stop.start','sonata_type_datetime_picker', array('attr' => array('style' => Utility::FIELD_STYLE_SMALL),'format' => Utility::DATE_FORMAT_DATETIME))
					->add('stop.stop','sonata_type_datetime_picker', array('attr' => array('style' => Utility::FIELD_STYLE_SMALL),'format' => Utility::DATE_FORMAT_DATETIME))
					->add('stop.duration', null, array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
					->add('distance', null, array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
					->add('stop.latlng','oh_google_maps',array('label' => 'Stop Position','map_width' => 500),array())
					->add('company.latlng','oh_google_maps',array('label' => 'Company Position','map_width' => 500),array())
		;
    }
	
    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper	->add('stop.user')
						->add('distance','doctrine_orm_number', array('field_type'=>'sonata_type_filter_number'))
						->add('stop.duration','doctrine_orm_number')
						->add('stop.start', 'doctrine_orm_datetime_range', array('field_type'=>'sonata_type_datetime_range_picker'), null, array('format' => Utility::DATE_FORMAT_DATETIME))
						->add('stop.stop', 'doctrine_orm_datetime_range', array('field_type'=>'sonata_type_datetime_range_picker'), null, array('format' => Utility::DATE_FORMAT_DATETIME))
		;
    }
	
    protected function configureListFields(ListMapper $listMapper){
        $listMapper	->addIdentifier('company.name')
					->addIdentifier('stop.user.username',null,array('label' => 'Username'))
					->addIdentifier('stop.start',null,array('label' => 'Visit Start'))
					->addIdentifier('stop.stop',null,array('label' => 'Visit End'))
					->addIdentifier('stop.duration',null,array('label' => 'Duration'))
					->addIdentifier('distance','integer',array('label' => 'Distance'))
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