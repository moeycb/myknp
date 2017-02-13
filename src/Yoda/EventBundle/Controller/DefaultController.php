<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction($count, $firstName)
    {
      $data = array(
        'count' => $count,
        'firstName' => $firstName,
        'ackbar' => 'It\'s a traaaaaaaaaaap.',
      );
      $json = json_encode($data);

      $response = new JsonResponse($json);

      return $response;
    }
}
