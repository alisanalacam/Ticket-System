<?php

namespace Ticket\Repository;

use Doctrine\ORM\EntityRepository;

class TicketPriorityRepository extends EntityRepository
{

    /**
     * Ticket önceliklerini key => value şeklinde döndürür
     * @return array
     */
    public function ticketPriorityList()
    {
        $qb = $this->createQueryBuilder('tp');
        $qb->where('tp.deleted = false')->select('tp.id', 'tp.priorityName');

        $lists = $qb->getQuery()->getArrayResult();
        $r_list = array();

        foreach ($lists as $list) {
            $r_list[$list['id']] = $list['priorityName'];
        }

        return $r_list;
    }

}