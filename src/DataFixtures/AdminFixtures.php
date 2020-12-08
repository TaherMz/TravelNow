<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    /**
     * AdminFixtures constructor.
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    public  function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $admin->setUsername('mzid');
        $admin->setPassword($this->encoder->encodePassword( $admin,'mzidadmin'));

        $manager->persist($admin);
        $manager->flush();
    }
}
