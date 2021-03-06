<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    /** @var UserPasswordEncoderInterface */
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $userRole = new Role();
        $userRole->setName('ROLE_USER');
        $manager->persist($userRole);

        $adminRole = new Role();
        $adminRole->setName('ROLE_ADMIN');
        $manager->persist($adminRole);
        $manager->flush();

        /* USERS */
        $user = new User();
        $user->setEmail($faker->safeEmail)
            ->setPassword($this->encoder->encodePassword($user, 'user'))
            ->addUserRole($userRole);

        $manager->persist($user);

        $user = new User();
        $user->setEmail('user@gmail.com')
            ->setPassword($this->encoder->encodePassword($user, 'user'))
            ->addUserRole($userRole);

        $manager->persist($user);

        /* ADMIN */
        $user = new User();
        $user->setEmail('admin@gmail.com')
            ->setPassword($this->encoder->encodePassword($user, 'admin'))
            ->addUserRole($adminRole);

        $manager->persist($user);
        $manager->flush();
    }
}
