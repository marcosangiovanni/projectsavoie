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
        $formMapper	->add('user_id')
					->add('name')
					->add('facebook_uid')
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
					->add('user_id')
					->add('name')
					->add('facebook_uid')
		;
    }
}

?>