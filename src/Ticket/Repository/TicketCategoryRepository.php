<?php

namespace Ticket\Repository;

use Doctrine\ORM\EntityRepository;

class TicketCategoryRepository extends EntityRepository
{

    public function existTicketCategory($id, $categoryName)
    {
        $qb = $this->createQueryBuilder('tc');
        $qb->where('tc.id <> :id')
            ->andWhere('tc.categoryName = :categoryName')
            ->andWhere('tc.deleted = false')
            ->setParameters(array(
            'id' => $id,
            'categoryName' => $categoryName
        ));

        return $qb->getQuery()->getOneOrNullResult();
    }

}