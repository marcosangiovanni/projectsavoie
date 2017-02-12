<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Util\Utility as Utility;

use Sonata\AdminBundle\Show\ShowMapper;

class CompanyAdmin extends Admin
{
	
	protected function configureShowFields(ShowMapper $showMapper)
    {
        // Here we set the fields of the ShowMapper variable, $showMapper (but this can be called anything)
        $showMapper

            /*
             * The default option is to just display the value as text (for boolean this will be 1 or 0)
             */
            ->add('name')
        ;

    }
	
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper	->add('name', null, array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
 					->add('latlng','oh_google_maps',array('label' => 'Insert address','map_width' => 500),array())
		;
    }
	
    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper	->add('name');
    }

    protected function configureListFields(ListMapper $listMapper){
        $listMapper	->addIdentifier('id')
					->addIdentifier('name')
					->addIdentifier('_action', 'actions', array(
			            'actions' => array(
			                'edit' => array(),
			                'show' => array(),
			                'delete' => array(),
			            )
		        	))
		;
    }
}

?>