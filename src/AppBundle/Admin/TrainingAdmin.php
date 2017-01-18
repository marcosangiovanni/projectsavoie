<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TrainingAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper){
        $formMapper	->add('title', 'text', array('attr' => array('style' => 'width:700px')))
					->add('user', null, array('attr' => array('style' => 'width:500px')))
					->add('sport', null, array('attr' => array('style' => 'width:500px')))
					->add('picture', 'url', array('attr' => array('style' => 'width:500px')))
					->add('video', 'url', array('attr' => array('style' => 'width:500px')))
					->add('start','sonata_type_datetime_picker', array('attr' => array('style' => 'width:250px'),'format' => 'yyyy-MM-dd HH:mm:ss'))
					->add('end','sonata_type_datetime_picker', array('attr' => array('style' => 'width:250px'),'format' => 'yyyy-MM-dd HH:mm:ss'))
  					->add('cutoff','sonata_type_datetime_picker', array('attr' => array('style' => 'width:250px'),'format' => 'yyyy-MM-dd HH:mm:ss'))
 					->add('is_public')
 					->add('price')
 					->add('position','point')
		;
    }
	
	
	public function filterByName($queryBuilder, $alias, $field, $value){
		if(!$value['value']){
			return;
		}
		$queryBuilder->andWhere($alias . '.name' . ' = ' . ':name' )
					->setParameter('name' , $value['value']->getName());
		return true;
	}

    protected function configureDatagridFilters(DatagridMapper $datagridMapper){
        $datagridMapper	->add('title')
						->add('user','doctrine_orm_callback', array(
	            												'callback' => array($this, 'filterByName'),
	            												'field_type' => 'text',
             												  ), 
             												  'entity',array(
														                'class' => 'AppBundle\Entity\User',
														                'choice_label' => 'surname'
															  )
						)
						->add('sport')
						->add('start', 'doctrine_orm_date_range', array('field_type'=>'sonata_type_date_range_picker'), null, array('format' => 'yyyy-MM-dd'))
						->add('end', 'doctrine_orm_date_range', array('field_type'=>'sonata_type_date_range_picker'), null, array('format' => 'yyyy-MM-dd'))
	  					->add('cutoff', 'doctrine_orm_date_range', array('field_type'=>'sonata_type_date_range_picker'), null, array('format' => 'yyyy-MM-dd'))
	 					->add('is_public')
	 					->add('price')
		;
    }

    protected function configureListFields(ListMapper $listMapper){
        $listMapper	->addIdentifier('id')
					->addIdentifier('title')
					->addIdentifier('user', 'entity', array(
            				'class' 	=> 	'AppBundle\Entity\User',
            				'property' 	=> 	'name',
            				'attr' 		=> 	array('style' => 'width:200px')
        				)
					)
					->addIdentifier('sport', 'entity', array(
            				'class' 	=> 	'AppBundle\Entity\Sport',
            				'property' 	=> 	'name',
            				'attr' 		=> 	array('style' => 'width:200px')
        				)
					)
					->addIdentifier('start')
					->addIdentifier('end')
					->addIdentifier('cutoff')
					->addIdentifier('is_public')
					->addIdentifier('price')
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