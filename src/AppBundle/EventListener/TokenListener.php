<?php
namespace AppBundle\EventListener;

use AppBundle\Controller\ApiTokenInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;


class TokenListener
{
    private $tokens;

    private $em;



    public function __construct($tokens,EntityManager $entityManager)
    {
        $this->tokens = $tokens;
        $this->em = $entityManager;

    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof ApiTokenInterface) {

            //$token = $event->getRequest()->query->get('token');
            //get auth header
            $token = $event->getRequest()->headers->get('Authorization');
            //now check token in Database

            $user = new User();

            $user = $this->em->getRepository('AppBundle:User')->findOneBy(array('password' => $token));
           //$user = $this->em->getRepository('AppBundle:User')->findOneBy(array('password' => '111', 'price' => 19.99));

            //$user = $em->getRepository('AppBundle:User')->findOneBy(array('password' => '111'));

           // echo $user->getId();

          //  die();

         //   if (!in_array($token, $this->tokens)) {
            if(!$user) {
                //return error -> token not correct


                //if API token incorrect return 404 error
                //throw new AccessDeniedHttpException('This action needs a valid token!');



              //  echo 'invalid token';
             //   echo $event->getRequest()->headers->get('Authorization');
             //   die();
            }

            // mark the request as having passed token authentication
            $event->getRequest()->attributes->set('auth_token', $token);
        }
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        // check to see if onKernelController marked this as a token "auth'ed" request
        if (!$token = $event->getRequest()->attributes->get('auth_token')) {
            return;
        }

        $response = $event->getResponse();

        // create a hash and set it as a response header
        $hash = sha1($response->getContent().$token);
        $response->headers->set('X-CONTENT-HASH', $hash);
    }
}