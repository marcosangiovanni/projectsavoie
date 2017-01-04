<?php

// src/AppBundle/Admin/CategoryAdmin.php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper	->add('username')
					->add('email')
					->add('enabled')
		;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper	->add('username')
						->add('email')
						->add('enabled')
		;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper	->addIdentifier('id')
					->addIdentifier('username')
					->addIdentifier('email')
					->addIdentifier('enabled')
		;
    }
}

?>