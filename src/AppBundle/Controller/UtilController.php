<?php

namespace AppBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Sport;

class UtilController extends FOSRestController
{
	//Utilizzata per consentire CORS
	public function setHeaderForSwagger(){
		if(in_array($this->get('kernel')->getEnvironment(), array('test', 'dev'))) {
			header("Access-Control-Allow-Origin: *");
		}
	}
	
	public function getUtilsAction(){
		//Creazione nuovo client
    	$clientManager = $this->get('fos_oauth_server.client_manager.default');
		$client = $clientManager->createClient();
		$client->setAllowedGrantTypes(array('authorization_code','password'));
		$clientManager->updateClient($client);
		//Risposta ok per creazione nuovo client
		$view = $this->view($client, 200);
        return $this->handleView($view);
    }
	
	public function getTranslationAction(){
		//Sport creation in en language
		$em = $this->getDoctrine()->getManager();
		$sport = new Sport;
		$sport->setTitle('my title in en');
		$em->persist($sport);
		$em->flush();
		//Find sport
		$sport_de = $this->getDoctrine()->getRepository('AppBundle:Sport')->findOneByTitle('my title in en');
		//Set de locale
		$sport_de->setTitle('my title in DE');
		$sport->setTranslatableLocale('de_de');
		$em->persist($sport);
		$em->flush();
	}
	
}