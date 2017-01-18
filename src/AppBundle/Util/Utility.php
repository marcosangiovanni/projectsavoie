<?php

/* Service class */

namespace AppBundle\Util;
use Doctrine\ORM\Mapping as ORM;

class Utility{
	
	const DATE_FORMAT_DATE = 'yyyy-MM-dd';
	const DATE_FORMAT_DATETIME = 'yyyy-MM-dd HH:mm:ss';
	const FIELD_STYLE_SMALL = 'width:250px';
	const FIELD_STYLE_MEDIUM = 'width:500px';
	
	
	public function filterByName($queryBuilder, $alias, $field, $value){
		if(!$value['value']){
			return;
		}
		$queryBuilder->andWhere($alias . '.name' . ' = ' . ':name' )->setParameter('name' , $value['value']->getName());
		return true;
	}
	
}
