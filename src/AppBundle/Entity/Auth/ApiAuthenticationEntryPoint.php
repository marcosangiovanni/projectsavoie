<?php

namespace AppBundle\Entity\Auth;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ApiAuthenticationEntryPoint implements AuthenticationEntryPointInterface {

    private $realmName;

    public function __construct($realmName) {
        $this->realmName = $realmName;
    }

    public function start(Request $request, AuthenticationException $authException = null) {
        $content = array('data' => $authException->getMessageData(), 'error' => 444);
        $response = new Response();
        $response->headers->set('WWW-Authenticate', sprintf('Basic realm="%s"', $this->realmName));
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($content))
                ->setStatusCode(444);
        return $response;
    }    
}