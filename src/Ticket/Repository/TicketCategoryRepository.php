<?php

namespace Ticket\Repository;

use Doctrine\ORM\EntityRepository;

class TicketCategoryRepository extends EntityRepository
{

    /**
     * Ticket kategorisi var mı kontrol eder
     * @param $id
     * @param $categoryName
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
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

    /**
     * Ticket kategorilerini key => value şeklinde döndürür
     * @return array
     */
    public function ticketCategoryList()
    {
        $qb = $this->createQueryBuilder('tc');
        $qb->where('tc.deleted = false')->select('tc.id', 'tc.categoryName');

        $lists = $qb->getQuery()->getArrayResult();
        $r_list = array();

        foreach ($lists as $list) {
            $r_list[$list['id']] = $list['categoryName'];
        }

        return $r_list;
    }

}