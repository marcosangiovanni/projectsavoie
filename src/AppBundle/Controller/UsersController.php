<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;

use Symfony\Component\HttpFoundation\Request;

class UsersController extends FOSRestController
{
	
	private function setHeaderForSwagger(){
		if(in_array($this->get('kernel')->getEnvironment(), array('test', 'dev'))) {
			header("Access-Control-Allow-Origin: *");
		}
	}
	
	// [GET] /users/{id}
	public function getUserAction($id)
    {
    	//die('unauTOOOOOOOOOOOOOOOOOOO');
		$this->setHeaderForSwagger();
		//die('dashgdjhdjas');
		
    	//Così si recupera l'utente
    	$user = $this->get('security.context')->getToken()->getUser();
		//Check che sia autenticato
		var_dump($this->get('security.context')->isGranted('ROLE_ADMIN'));

		/*
		$clientManager = $this->get('fos_oauth_server.client_manager.default');
		$client = $clientManager->createClient();
		$client->setAllowedGrantTypes(array('authorization_code'));
		$clientManager->updateClient($client);
		*/
		
		$user = $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
		if(!$user){
			throw $this->createNotFoundException('No product found for id '.$id);
		}else{
			$view = $this->view($user, 200);
        	return $this->handleView($view);
		}
    } 
    
    public function getUsersAction()
    {
    	//Così si recupera l'utente
    	$user = $this->get('security.context')->getToken()->getUser();
//		var_dump($this->get('security.context')->isGranted('ROLE_JCVD'));
//		exit;
		
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
		if(!$users){
			throw $this->createNotFoundException('No collection found');
		}else{
			$view = $this->view($users, 200);
        	return $this->handleView($view);
		}
    }

	public function copyUserAction($id) // RFC-2518
    {} // "copy_user"            [COPY] /users/{id}

    public function propfindUserPropsAction($id, $property) // RFC-2518
    {} // "propfind_user_props"  [PROPFIND] /users/{id}/props/{property}

    public function proppatchUserPropsAction($id, $property) // RFC-2518
    {} // "proppatch_user_props" [PROPPATCH] /users/{id}/props/{property}

    public function moveUserAction($id) // RFC-2518
    {} // "move_user"            [MOVE] /users/{id}

    public function mkcolUsersAction() // RFC-2518
    {} // "mkcol_users"          [MKCOL] /users

    public function optionsUsersAction()
    {} // "options_users"        [OPTIONS] /users

/*
    public function getUsersAction()
    {} // "get_users"            [GET] /users
*/

    public function newUsersAction()
    {} // "new_users"            [GET] /users/new

    public function postUsersAction()
    {} // "post_users"           [POST] /users

    public function patchUsersAction()
    {} // "patch_users"          [PATCH] /users

    public function editUserAction($slug)
    {} // "edit_user"            [GET] /users/{slug}/edit

    public function putUserAction($slug)
    {} // "put_user"             [PUT] /users/{slug}

    public function patchUserAction($slug)
    {} // "patch_user"           [PATCH] /users/{slug}

    public function lockUserAction($slug)
    {} // "lock_user"            [LOCK] /users/{slug}

    public function unlockUserAction($slug)
    {} // "unlock_user"          [UNLOCK] /users/{slug}

    public function banUserAction($slug)
    {} // "ban_user"             [PATCH] /users/{slug}/ban

    public function removeUserAction($slug)
    {} // "remove_user"          [GET] /users/{slug}/remove

    public function deleteUserAction($slug)
    {} // "delete_user"          [DELETE] /users/{slug}

    public function getUserCommentsAction($slug)
    {} // "get_user_comments"    [GET] /users/{slug}/comments

    public function newUserCommentsAction($slug)
    {} // "new_user_comments"    [GET] /users/{slug}/comments/new

    public function postUserCommentsAction($slug)
    {} // "post_user_comments"   [POST] /users/{slug}/comments

    public function getUserCommentAction($slug, $id)
    {} // "get_user_comment"     [GET] /users/{slug}/comments/{id}

    public function editUserCommentAction($slug, $id)
    {} // "edit_user_comment"    [GET] /users/{slug}/comments/{id}/edit

    public function putUserCommentAction($slug, $id)
    {} // "put_user_comment"     [PUT] /users/{slug}/comments/{id}

    public function postUserCommentVoteAction($slug, $id)
    {} // "post_user_comment_vote" [POST] /users/{slug}/comments/{id}/votes

    public function removeUserCommentAction($slug, $id)
    {} // "remove_user_comment"  [GET] /users/{slug}/comments/{id}/remove

    public function deleteUserCommentAction($slug, $id)
    {} // "delete_user_comment"  [DELETE] /users/{slug}/comments/{id}

    public function linkUserFriendAction($slug, $id)
    {} // "link_user_friend"     [LINK] /users/{slug}/friends/{id}

    public function unlinkUserFriendAction($slug, $id)
    {} // "unlink_user_friend"     [UNLINK] /users/{slug}/friends/{id}

}