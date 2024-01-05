<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class SoldUserService
{
    private EntityManagerInterface $em;
    public function __construct( EntityManagerInterface $em){

        $this->em = $em;
    }
    public function decreaseSold(int $cost ,$user)
    {
        $user_sold = $user->getSold();

        $user->setSold($user_sold - $cost);

        $this->em->persist($user);
        $this->em->flush();

        $message="";
    }
    public function compareSold(int $sum_compared ,$user)
    {
        $user_sold = $user->getSold();

        return $sum_compared <= $user_sold;
        // true if user has a superior or equal sold
    }



}