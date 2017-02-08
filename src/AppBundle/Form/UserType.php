<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use AppBundle\Form\UserType;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder	->add('picture')
        			->add('video')
        			->add('city')
					->add('sports', CollectionType::class, array('entry_type' => SportType::class))
		;
    }
    
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User\User',
            'allow_extra_fields' => true,
            'csrf_protection'   => false,
        ));
    }

    public function getBlockPrefix(){
        return 'appbundle_user_user';
    }

}
