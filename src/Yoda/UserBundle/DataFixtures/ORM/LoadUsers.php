<?php
// src/AppBundle/DataFixtures/ORM/LoadEvents.php

namespace Yoda\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Yoda\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadUsers implements FixtureInterface, ContainerAwareInterface
{
  /*
   * @var ContainerInterface
   */
  private $container;

  public function load(ObjectManager $manager)
  {
    $user = new User();
    $user->setUsername('darth');
    $user->setEmail('darth@deathstar.com');
    // todo - fill in this encoded password... ya know... somehow...
    $user->setPassword($this->encodePassword($user, 'darthpass'));
    $manager->persist($user);

    $admin = new User();
    $admin->setUsername('wayne');
    $admin->setEmail('wayne@deathstar.com');
    $admin->setPassword($this->encodePassword($admin, 'waynepass'));
    $admin->setRoles(array('ROLE_ADMIN'));
    $manager->persist($admin);

    // the queries aren't done until now
    $manager->flush();
  }

  private function encodePassword(User $user, $plainPassword)
  {
    $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);

    return $encoder->encodePassword($plainPassword, $user->getSalt());
  }

  public function setContainer(ContainerInterface $container = null)
  {
    $this->container = $container;
  }
}