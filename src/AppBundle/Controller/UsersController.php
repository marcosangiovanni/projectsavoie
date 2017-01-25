<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use \DateTime;

class UsersController extends FOSRestController
{

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
    public function getUsersAction(){
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
	// New user insert
    public function postUsersAction(){
    	try{
    		//Get user manager
	    	$userManager = $this->container->get('fos_user.user_manager');

			//Creation of new user object
    		$user = $userManager->createUser();
			
			//Find request parameters
			$request = $this->getRequest();
			
			//User parameters for registration
			$data = $request->get('data');
			
			//A new user is alway created enabled
			$user->setEnabled(true);
			
			//Data passed in body
			$user->setName($data['name']);
			$user->setSurname($data['surname']);
			$user->setEmail($data['email']);
			$user->setPhone($data['phone']);
			$user->setDob(new DateTime($data['dob']));
			$user->setUsername($data['user']);
			$user->setPlainPassword($data['password']);
			
			//Save new user
			$userManager->updateUser($user);
			
			//Return user
			$view = $this->view($user, 200);
        	return $this->handleView($view);

    	}
    	//User and password already in use
    	catch(UniqueConstraintViolationException $e){
			throw new \Exception('user or email already in use');
    	}
		//This catch any other exception
		catch(\Exception $e){
			throw new \Exception('Something went wrong!');
    	}

    } 

	// "put_user"             
	// [PUT] /users/{id}
    public function putUserAction($slug)
    {}

	// "delete_user"          
	// [DELETE] /users/{id}
    public function deleteUserAction($slug)
    {}

}