<?php
namespace AppBundle\EventListener;
use AppBundle\Exception\ApiException;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\Response;

class ApiExceptionSubscriber implements EventSubscriberInterface
{
    private $serializer;
    private $container;
    /**
     * ApiExceptionSubscriber constructor.
     */
    public function __construct($serializer, $container)
    {
        $this->serializer = $serializer;
        $this->container = $container;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        /* If need my custom exeption
        if (!$this->container->getParameter('json_response')) {
            return $event;
        }
        $e = $event->getException();
        if ($e instanceof MethodNotAllowedHttpException) {
            $response = $this->response([
                'message' => $e->getMessage()
            ], 405);
        } else if ($e instanceof NotFoundHttpException) {
            $response = $this->response([
                'message' => $e->getMessage()
            ], 404);
        } else if ($e instanceof ApiException) {
            $response = $this->response([
                'message' => $e->getData()
            ], $e->getStatusCode());
        } else {
            $response = $this->response([
                'message' => $e->getMessage()
            ], 500);
        }
        
        $event->setResponse($response);
        */
        $e = $event->getException();
        if (!$e instanceof ApiProblemException) {
            return;
        }

        $apiProblem = $e->getApiProblem();

        $response = new JsonResponse(
            $apiProblem->toArray(),
            $apiProblem->getStatusCode()
        );
        $response->headers->set('Content-Type', 'application/problem+json');
        $event->setResponse($response);
    }
    
    private function response($data, $code)
    {
        $response = new JsonResponse($data, $code);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST  => array('onKernelRequest', 9999),
            KernelEvents::RESPONSE => array('onKernelResponse', 9999),
            KernelEvents::EXCEPTION => 'onKernelException'
        );
    }
    public function onKernelRequest(GetResponseEvent $event) {
        // Don't do anything if it's not the master request.

        if (!$event->isMasterRequest()) {
            return;
        }
        $request = $event->getRequest();
        $method  = $request->getRealMethod();
        if ('OPTIONS' == $method) {
            $response = new Response();
            $event->setResponse($response);
        }


    }

    public function onKernelResponse(FilterResponseEvent $event) {
        // Don't do anything if it's not the master request.

        if (!$event->isMasterRequest()) {
            return;
        }

        $response = $event->getResponse();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE');
        $response->headers->set('Access-Control-Allow-Headers', 'X-Header-One,X-Header-Two');
        $response->headers->set('Content-type', 'application/json');

    }



}