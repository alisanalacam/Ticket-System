<?php

namespace Ticket\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends EntityRepository implements UserProviderInterface
{

    /**
     * UserProvider
     * @param type $username
     * @return type
     */
    function loadUserByUsername($username)
    {
        $qb = $this->createQueryBuilder('u');

        $query = $qb->select('u')
            ->where(
                $qb->expr()->orx(
                    $qb->expr()->like('u.username', ':username'), $qb->expr()->like('u.email', ':username')
                )
            )
            ->setParameters(array('username' => $username))
            //->getQuery()->getOneOrNullResult();
            //->getQuery()->getSingleResult();
            ->getQuery()->getOneOrNullResult();

        return $query;
    }

    function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    function supportsClass($class)
    {
        return $class === 'Ticket\Entity\User';
    }
}