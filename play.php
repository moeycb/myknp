<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;
use DateTime;

$loader = require_once __DIR__.'/app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$kernel->boot();

$container = $kernel->getContainer();
$container->enterScope('request');
$container->set('request', $request);

// all setup is done! Woo hoo!

use Yoda\EventBundle\Entity\Event;

$event = new Event();
$event->setName('Darth\'s surprise birthday party!');
$event->setLocation('Deathstart');
$event->setTime(new DateTime('tomorrow noon'));
//$event->setDetails('Ha! Darth hates surprises!');

$em = $container->get('doctrine')->getEntityManager();
$em->persist($event);
$em->flush();

