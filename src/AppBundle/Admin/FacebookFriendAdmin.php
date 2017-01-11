<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FacebookFriendAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper	//->add('user_id')
					->add('name')
					->add('facebook_uid')
					->add('user', 'entity', array(
							//'multiple' 	=> 	true,
            				'class' 	=> 	'AppBundle\Entity\User',
            				'property' 	=> 	'email',
            				'attr' 		=> 	array('style' => 'width:200px')
        				)
					)
		;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper	->add('user_id')
						->add('name')
						->add('facebook_uid')
		;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper	->addIdentifier('id')
					->add('user', 'entity', array(
							'label' => 'User',
            				'route' => array(
                    			'name' => 'edit'
                			)
        				)
					)
					->add('name')
					->add('facebook_uid')
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