<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Sport;

class TrainingsController extends FOSRestController
{

	// [GET] /trainings/{id}
	public function getTrainingAction($id)
    {
    	//Find USER By Token
    	$logged_user = $this->get('security.context')->getToken()->getUser();
		
		//Check is granted
		$is_granted = $this->get('security.context')->isGranted('ROLE_USER');
		
		//Find training data
		$training = $this->getDoctrine()->getRepository('AppBundle:Training')->find($id);
		if(!$training){
			throw $this->createNotFoundException('No training found for id '.$id);
		}else{
			$view = $this->view($training, 200);
        	return $this->handleView($view);
		}
    } 
    
	// [GET] /trainings
	// Set search parameters
    public function getTrainingsAction(){
        $training = $this->getDoctrine()->getRepository('AppBundle:Training')->findAll();
		if(!$training){
			throw $this->createNotFoundException('No collection found');
		}else{
			$view = $this->view($training, 200);
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