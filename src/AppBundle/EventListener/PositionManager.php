<?php
namespace AppBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Stop;
use AppBundle\Entity\Position;
use AppBundle\Entity\Lastposition;

class PositionManager
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $position = $args->getEntity();

        // only act on some "Position" entity
        if (!$position instanceof Position) {
            return;
        }
		
		$user = $position->getUser();
		
		$em = $args->getEntityManager();
		$repository = $em->getRepository('AppBundle:Lastposition');
		$lastposition = $repository->findOneBy(array('user_id' => $user->getId()));
		
		if(!$lastposition){

			$lastposition = new Lastposition();
			$lastposition->setPosition($position->getPosition());
			$lastposition->setdatetime($position->getCreated());
			$lastposition->setUser($user);

			//Entity manager
		    $em->persist($lastposition);

		}else{
			//If i have a User lastposition i check the distance covered between the two points
			
			// Query creation with filters
			$query = $repository->createQueryBuilder('l')

					//Select fields	
    				->select("st_distance_sphere(l.position,point(:x_position,:y_position)) as distance_in_meters")

					//Filtering conditions    	
    				->where('l.id = :lastposition_id')

					//Parameters passage					
    				->setParameter('lastposition_id', $lastposition->getId())

					->setParameter('x_position', $position->getPosition()->getX())
					->setParameter('y_position', $position->getPosition()->getY())
					
    				->getQuery();
					
			$distance = $query->getResult();
			
			$distance = $distance[0]['distance_in_meters'];
			
			if($distance < 20){
				//If distance is lower than N it's a "stay in place" and i create a Stop entity
				if($lastposition->getStopId()){
					//Recupero lo stop	
					$repository = $em->getRepository('AppBundle:Stop');
					$stop = $repository->find($lastposition->getStopId());
					$stop->setStop($position->getCreated());
					$stop->setDuration($position->getCreated()->getTimestamp()-$stop->getStart()->getTimestamp());
					$em->persist($stop);			
				}else{
					//Creo un nuovo stop
					$stop = new Stop();
					
					$stop->setUser($position->getUser());
					$stop->setStart($position->getCreated());
					$stop->setStop($position->getCreated());
					$stop->setDuration($position->getCreated()->getTimestamp()-$lastposition->getDatetime()->getTimestamp());
					$stop->setPosition($position->getPosition());
					
					//Persist to get ID
					$em->persist($stop);
					$em->flush();
					
					//Set stop id to nex get
					$lastposition->setStopId($stop->getId());
					$em->persist($lastposition);

				}
			}else{
				//If distance is greater than N I update last position and i clean stop id
				$lastposition->setPosition($position->getPosition());
				$lastposition->setStopId(null);
				$lastposition->setDatetime($position->getCreated());
				$lastposition->setUser($user);
	
				//Entity manager
			    $em->persist($lastposition);
				
			}
		}
		
		//Carico tutte le entità	
	    $em->flush();
		
		
    }

}