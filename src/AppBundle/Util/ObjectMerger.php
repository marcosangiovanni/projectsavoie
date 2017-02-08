<?php

namespace AppBundle\Util;

class ObjectMerger{
	
	public function mergeEntities($em, $mainEntity, $subEntity){

		$metadata = $em->getClassMetadata(get_class($mainEntity));
		
		foreach($metadata->fieldMappings as $k => $v){
			if($subEntity->__get($k) !== null){
				$mainEntity->__set($k,$subEntity->__get($k));
			}
		}
		return $mainEntity;
	}
	
}
