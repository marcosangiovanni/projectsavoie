<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Util\Utility as Utility;

class SportAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper){
		//Setting 
		$options = array('required' => false, 'attr' => array('style' => Utility::FIELD_STYLE_MEDIUM));
	    if (($subject = $this->getSubject()) && $subject->getPicture()) {
			$container = $this->getConfigurationPool()->getContainer();
			$helper = $container->get('vich_uploader.templating.helper.uploader_helper');
			$path = $helper->asset($subject, 'imageFile');
	        $options['help'] = '<img width="100px" src="' . $path . '" />';
	    }					

        $formMapper	->add('title', 'text', array('attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
					->add('picture', null, $options)
					->add('imageFile', 'file', array('label' => 'Image file', 'required' => false, 'attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
		;
    }
	
    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper){
    	
        $listMapper	->add('id')
					->add('title')
					
					->add('picture', 'string', array('template' => 'admin/image_format_list.html.twig'))
					
					->add('_action', 'actions', array(
			            'actions' => array(
			                'edit' => array(),
			                'delete' => array(),
			            )
		        	))
		;
    }
}

?>