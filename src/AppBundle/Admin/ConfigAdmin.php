<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Util\Utility as Utility;

class ConfigAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper	->add('code', null, array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
					->add('value', null, array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
					->add('description', null, array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
		;
    }
	
    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper	->add('code')
						->add('value')
		;
    }
	
    protected function configureListFields(ListMapper $listMapper){
        $listMapper	->addIdentifier('code')
					->addIdentifier('value')
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