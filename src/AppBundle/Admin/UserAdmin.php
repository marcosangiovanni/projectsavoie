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
		
	    if (($subject = $this->getSubject()) && $subject->getPicture()) {
			$container = $this->getConfigurationPool()->getContainer();
			$helper = $container->get('vich_uploader.templating.helper.uploader_helper');
			$path = $helper->asset($subject, 'imageFile');
	        $options['help'] = '<img width="500px" src="' . $path . '" />';
	    }

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
            ->with('Profile')
                ->add('firstname', null, array('required' => false, 'attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
                ->add('lastname', null, array('required' => false, 'attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
                ->add('gender', 'sonata_user_gender', array(
                    'required' => true,
                    'translation_domain' => $this->getTranslationDomain(),
                    'attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)
                ))
				->add('dateOfBirth','sonata_type_date_picker', array('attr' => array('style' => Utility::FIELD_STYLE_SMALL),'format' => Utility::DATE_FORMAT_DATE))
                ->add('phone', null, array('required' => false, 'attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
                
				->add('imageFile', 'file', array_merge($options,array('label' => 'Image file', 'required' => false, 'attr' => array('style' => Utility::FIELD_STYLE_MEDIUM))))
                
                ->add('video', null, array('required' => false, 'attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
            ->end()
            ->with('Social')
                ->add('facebookUid', null, array('required' => false, 'attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
                ->add('facebookName', null, array('required' => false, 'attr' => array('style' => Utility::FIELD_STYLE_MEDIUM)))
            ->end()
        ;

        if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Management')
                    ->add('enabled', null, array('required' => false))
                ->end()
            ;
        }

        $formMapper
            ->with('Security')
                ->add('token', null, array('required' => false))
            ->end()
        ;
    }
	
	/*
	//Methods to manage password update
	public function updateUser(\AppBundle\Entity\User $u) {
	    $um = $this->getConfigurationPool()->getContainer()->get('fos_user.user_manager');
	    $um->updateUser($u, false);
	}

	public function prePersist($object){
        parent::prePersist($object);
		$this->updateUser($object);

    }
	
    public function preUpdate($object){
        parent::preUpdate($object);
		$this->updateUser($object);

    }
	
	//Form fields
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper	->add('name')
					->add('surname')
					->add('username')
					->add('email')
					->add('enabled')
					->add('plainPassword', 'repeated', array(
		                'type' => 'password',
		                'options' => array('translation_domain' => 'FOSUserBundle'),
		                'first_options' => array('label' => 'form.password'),
		                'second_options' => array('label' => 'form.password_confirmation'),
		                'invalid_message' => 'fos_user.password.mismatch',
		                'required' => false,
        ));
    }

	//Form filters
    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
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

	//Grid fields
    protected function configureListFields(ListMapper $listMapper){
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
		;
    }
    
	*/
	
	
	
}

?>