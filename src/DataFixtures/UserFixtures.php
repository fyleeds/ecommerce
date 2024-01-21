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
        $user->setEmail('admin@admin.com');
        $user->setUsername('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setSold(100);
        $user->setPfp('path/to/profile/picture.jpg'); // Set this appropriately

        // Create a new user instance
        $user2 = new User();
        $user2->setEmail('test@test.com');
        $user2->setUsername('test');
        $user2->setRoles(['ROLE_USER']);
        $user2->setSold(100);
        $user2->setPfp('path/to/profile/picture.jpg'); // Set this appropriately

        // Hash the password
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'admin');
        $user->setPassword($hashedPassword);

        // Hash the password
        $hashedPassword = $this->passwordHasher->hashPassword($user2, 'test');
        $user2->setPassword($hashedPassword);

        // Persist the user object
        $manager->persist($user);
        $manager->persist($user2);

        // Flush to the database
        $manager->flush();
    }
}
