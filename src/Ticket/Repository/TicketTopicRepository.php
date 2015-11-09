<?php

namespace Ticket\Repository;

use Doctrine\ORM\EntityRepository;

class TicketTopicRepository extends EntityRepository
{
    /**
     * Ticketları döndürür. $recepientId verilirse atanan kullanıcıya gelen ticketları döndürür
     * @param null $authorId
     * @param null $recepientId
     * @return array
     */
    public function getTickets($authorId = null, $recepientId = null)
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t.id, t.subject, tp.priorityName, tp.className as priorityClass, ts.statusName, ts.className as statusClass')
            ->leftJoin('Ticket\Entity\TicketPriority', 'tp', 'WITH', 'tp.id = t.priorityId and tp.deleted = 0')
            ->leftJoin('Ticket\Entity\TicketStatus', 'ts', 'WITH', 'ts.id = t.statusId and ts.deleted = 0');

        if ($recepientId !== null) {
            $qb->where('t.recepientId = :recepientId AND t.deleted = 0')->setParameters(array(
                'recepientId' => $recepientId
            ));
        } else {
            $qb->where('t.authorId = :authorId AND t.deleted = 0')->setParameters(array(
                'authorId' => $authorId
            ));
        }

        return $qb->getQuery()->getArrayResult();
    }

    /**
     * Ticketın kategorilerine döndürür
     * @param $ticketId
     * @return array
     */
    public function getTicketCategories($ticketId)
    {
        $qb = $this->createQueryBuilder('t')
            ->select('tc.id, tc.categoryName')
            ->leftJoin('Ticket\Entity\TicketCategories', 'tcs', 'WITH', 'tcs.ticketId = t.id and tcs.deleted = 0')
            ->leftJoin('Ticket\Entity\TicketCategory', 'tc', 'WITH', 'tc.id = tcs.categoryId and tc.deleted = 0')
            ->where('t.deleted = 0')->andWhere('t.id = :ticketId')->setParameters(array(
                'ticketId' => $ticketId
            ));

        return $qb->getQuery()->getArrayResult();
    }
}