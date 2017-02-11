<?php

// src/AppBundle/Admin/CategoryAdmin.php
namespace AppBundle\Admin;

#use Sonata\AdminBundle\Admin\Admin;
use Sonata\UserBundle\Admin\Model\UserAdmin as BaseUserAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Util\Utility as Utility;

class UserAdmin extends BaseUserAdmin
{

	protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('username')
            ->add('email')
            ->add('groups')
            ->add('enabled', null, array('editable' => true))
            ->add('createdAt')
        ;
    }
	
	protected function configureDatagridFilters(DatagridMapper $filterMapper){
        $filterMapper
            ->add('id')
            ->add('username')
            ->add('enabled', null, 	array('label' => 'Enabled'),'sonata_type_translatable_choice', array(
											                													'translation_domain' => "SonataAdminBundle",
																								                'choices' => array(
																								                    1 => 'label_type_yes',
																								                    2 => 'label_type_no'
																								                ))
			            )
            ->add('email')
            ->add('groups')
        ;
    }
	
	protected function configureFormFields(FormMapper $formMapper){
		$options = array('required' => false, 'attr' => array('style' => Utility::FIELD_STYLE_MEDIUM));
		
        $formMapper
            ->with('General')
                ->add('username')
                ->add('email')
                ->add('plainPassword', 'text', array(
                    'required' => (!$this->getSubject() || is_null($this->getSubject()->getId()))
                ))
            ->end()
            ->with('Groups')
                ->add('groups', 'sonata_type_model', array(
                    'required' => false,
                    'expanded' => true,
                    'multiple' => true
                ))
            ->end()
        ;

        if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Management')
                    ->add('enabled', null, array('required' => false))
                ->end()
            ;
        }

    }
		
}

?>