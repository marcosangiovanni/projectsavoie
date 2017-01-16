<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;

use Symfony\Component\HttpFoundation\Request;

class UsersController extends FOSRestController
{
	/*
	private function setHeaderForSwagger(){
		if(in_array($this->get('kernel')->getEnvironment(), array('test', 'dev'))) {
			header("Access-Control-Allow-Origin: *");
		}
	}

	$clientManager = $this->get('fos_oauth_server.client_manager.default');
	$client = $clientManager->createClient();
	$client->setAllowedGrantTypes(array('authorization_code'));
	$clientManager->updateClient($client);

	*/
	
	// [GET] /users/{id}
	public function getUserAction($id)
    {
    	//Find USER By Token
    	$logged_user = $this->get('security.context')->getToken()->getUser();
		
		//Check is granted
		$is_granted = $this->get('security.context')->isGranted('ROLE_USER');
		
		//Find user data
		$user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
		if(!$user){
			throw $this->createNotFoundException('No product found for id '.$id);
		}else{
			$view = $this->view($user, 200);
        	return $this->handleView($view);
		}
    } 
    
	// [GET] /users
	// Set search parameters
    public function getUsersAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
		if(!$users){
			throw $this->createNotFoundException('No collection found');
		}else{
			$view = $this->view($users, 200);
        	return $this->handleView($view);
		}
    }

	// "post_users"           
	// [POST] /users
    public function postUsersAction()
    {} 

	// "put_user"             
	// [PUT] /users/{id}
    public function putUserAction($slug)
    {}

	// "delete_user"          
	// [DELETE] /users/{id}
    public function deleteUserAction($slug)
    {}

}