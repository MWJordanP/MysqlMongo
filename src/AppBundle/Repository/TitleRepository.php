<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Title;
use Doctrine\ORM\EntityRepository;

/**
 * Class TitleRepository
 */
class TitleRepository extends EntityRepository
{
    /**
     * @return Title[]
     */
    public function listTitles()
    {
        return $this->createQueryBuilder('title')
            ->innerJoin('title.keywords', 'keywords')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
}
