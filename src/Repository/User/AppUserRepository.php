<?php

namespace App\Repository\User;

use Sylius\Bundle\UserBundle\Doctrine\ORM\UserRepository as BaseUserRepository;
use Sylius\Component\User\Model\UserInterface;
use Sylius\Component\User\Repository\UserRepositoryInterface;

class AppUserRepository extends BaseUserRepository implements UserRepositoryInterface
{
    public function findOneByEmail(string $email): ?UserInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.customer', 'customer')
            ->andWhere('customer.emailCanonical = :email OR o.username = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
