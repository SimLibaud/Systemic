<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Organisation;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadOrganisationData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $organisation = (new Organisation())
            ->setName('Organisation 1')
        ;

        $manager->persist($organisation);
        $manager->flush();

        $this->addReference('organisation_1', $organisation);
    }

    public function getOrder()
    {
        return 20;
    }

}