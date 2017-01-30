<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Sport;
use CrEOF\Spatial\PHP\Types\Geometry\Point;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;

use Symfony\Component\HttpFoundation\Response;

class TrainingsController extends FOSRestController
{

	// [GET] /trainings/{id}
	public function getTrainingAction($id)
    {
		//Find training data
		$training = $this->getDoctrine()->getRepository('AppBundle:Training')->find($id);

		if(!$training){
			throw $this->createNotFoundException('No training found for id '.$id);
		}else{
			
			$context = SerializationContext::create()
							->setGroups(array('detail'))
							->enableMaxDepthChecks();
			
			$serializer = SerializerBuilder::create()->build();
			
			$jsonContent = $serializer->serialize($training, 'json', $context);
			
			$jsonResponse = new Response($jsonContent);
    		return $jsonResponse->setStatusCode(200);

		}

    } 
    
	// [GET] /trainings
	// Set search parameters
    public function getTrainingsAction(){

		//Find request parameters
		$request = $this->getRequest();
		
		//The training is public or visible only to facebook users
		$is_public = $request->get('is_public');
		
		//The user starting position to search for trainings
		$x = $request->get('x');
		$y = $request->get('y');
		$point = new Point($x,$y);
		
		//The max distance in meters of training
		$max_distance = $request->get('distance');

		//The sports I intend to search within
		$sports = $request->get('sports');

		//The date of training
		//0 = today
		//1 = tomorrow
		//etc...
		$date = $request->get('date');

		//Instantiate the repositiory		
		$repository = $this->getDoctrine()->getRepository('AppBundle:Training');
		
		// Query creation with filters
		$query = $repository->createQueryBuilder('t')

					//Filtering conditions    	
    				->where('t.is_public = :is_public')
    				->andWhere('t.sport_id IN (:sports)')
    				->andWhere('DATE_DIFF(t.start,CURRENT_DATE()) IN (:date)')
    				->andWhere("st_distance_sphere(t.position,point(:x_position,:y_position)) < :max_distance")

					//Order by distance ASC
    				->orderBy("st_distance_sphere(t.position,point(:x_position,:y_position))", 'ASC')

					//Parameters passage					
    				->setParameter('is_public', $is_public)

					->setParameter('x_position', $point->getX())
					->setParameter('y_position', $point->getY())
					->setParameter('max_distance', $max_distance)

					->setParameter('sports', $sports)
					->setParameter('date', $date)
					
    				->getQuery()
		;
		
		//echo $query->getSelect();
		
		$trainings = $query->getResult();

		if(!$trainings){
			throw $this->createNotFoundException('No collection found');
		}else{
			$view = $this->view($trainings, 200);
        	return $this->handleView($view);
		}
    }

	// "post_trainings"           
	// [POST] /trainings
    public function postTrainingsAction()
    {} 

	// "put_trainings"             
	// [PUT] /trainings/{id}
    public function putTrainingAction($id)
    {}

	// "delete_trainings"          
	// [DELETE] /trainings/{id}
    public function deleteTrainingAction($id)
    {}

}