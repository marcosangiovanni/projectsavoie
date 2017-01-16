<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;

class FacebookFriendsController extends FOSRestController
{
	// ROUTE	:	"get_user_comments"   
	// CALL		:	[GET] /users/{user_id}/facebook_friends
    public function getFacebook_friendsAction($user_id){
		$facebook_friends = $this->getDoctrine()->getRepository('AppBundle:FacebookFriend')->findBy(array('user_id' => $user_id));
		$ar_facebook_friends = array();
		foreach ($facebook_friends as $facebook_friend) {
			$ar_facebook_friends[] = $facebook_friend;
		}
		$view = $this->view($ar_facebook_friends, 200);
        return $this->handleView($view);
    } 

	// ROUTE	:	"get_user_comment"    
	// CALL 	:	[GET] /users/{user_id}/facebook_friend/{facebook_friend_id}
    public function getFacebook_friendAction($user_id, $facebook_friend_id){
		$facebook_friend = $this->getDoctrine()->getRepository('AppBundle:FacebookFriend')->find($facebook_friend_id);
		if(!$facebook_friend){
			throw $this->createNotFoundException('No facebook friend found  for id '.$facebook_friend_id.' and user_id '.$user_id);
		}else{
			$view = $this->view($facebook_friend, 200);
        	return $this->handleView($view);
		}
    } 

    /*
    public function deleteCommentAction($user_id, $comment_id)
    {} // "delete_user_comment" [DELETE] /users/{user_id}/comments/{comment_id}

    public function newCommentsAction($user_id)
    {} // "new_user_comments"   [GET] /users/{user_id}/comments/new

    public function editCommentAction($user_id, $comment_id)
    {} // "edit_user_comment"   [GET] /users/{user_id}/comments/{comment_id}/edit

    public function removeCommentAction($user_id, $comment_id)
    {} // "remove_user_comment" [GET] /users/{user_id}/comments/{comment_id}/remove
	*/
}