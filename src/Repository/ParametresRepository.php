<?php

namespace App\Repository;
use Doctrine\ORM\EntityRepository;


class ParametresRepository extends EntityRepository
{
   public function findAllQueryBuilder()
    {
        return $this->createQueryBuilder('parametres')
                 ->orderBy('parametres.id', 'ASC');
    }
}