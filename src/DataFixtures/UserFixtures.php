<?php // src/DataFixtures/UserFixtures.php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
class UserFixtures extends Fixture implements OrderedFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function getOrder()
    {
        return 1; // Load first  UserFixtures
    }

    public function load(ObjectManager $manager): void
    {
        // Create a new user instance
        $user = new User();
        $user->setEmail('user@example.com');
        $user->setUsername('username');
        $user->setRoles(['ROLE_USER']);
        $user->setSold(100);
        $user->setPfp('path/to/profile/picture.jpg'); // Set this appropriately

        // Hash the password
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'your_plain_password');
        $user->setPassword($hashedPassword);

        // Persist the user object
        $manager->persist($user);

        // Flush to the database
        $manager->flush();
    }
}
