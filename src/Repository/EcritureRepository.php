<?php

namespace App\Repository;
use Doctrine\ORM\EntityRepository;


class EcritureRepository extends EntityRepository
{
   public function findAllQueryBuilder()
    {
        return $this->createQueryBuilder('ecriture')
                 ->orderBy('ecriture.nom', 'ASC');
    }
    
    public function findByMonth($mois,$annee)
    {
        return $this->createQueryBuilder('ecriture')
            ->where('MONTH(ecriture.date) = :mois')
            ->andWhere('YEAR(ecriture.date) = :annee')
            ->groupBy('ecriture.date')
            ->setParameters([
            'mois' => $mois,
            'annee'=>$annee
            ]);
    }
    
    public function findByYear($annee)
    {
        return $this->createQueryBuilder('ecriture')
            ->where('YEAR(ecriture.date) = :annee')
            ->groupBy('ecriture.date')
            ->setParameters([
            'annee' => $annee,
            ]);
    }
    
    public function findBetweenTwoDatesFlux($date1,$date2,$sensflux)
    {
         return $this->createQueryBuilder('ecriture')
        ->where('ecriture.date BETWEEN :debut AND :fin')
        ->andWhere('ecriture.sensflux = :sensflux')         
        ->setParameter('debut', $date1)
        ->setParameter('fin', $date2)
        ->setParameter('sensflux', $sensflux);
    }
    public function findBetweenTwoDates($date1,$date2)
    {
         return $this->createQueryBuilder('ecriture')
        ->where('ecriture.date BETWEEN :debut AND :fin')     
        ->setParameter('debut', $date1)
        ->setParameter('fin', $date2);
    }
    
    public function findCategorieBetweenTwoDates($date1,$date2,$categorie)
    {
        return $this->createQueryBuilder('ecriture')
                ->innerJoin('ecriture.categorie', 'cat', 'WITH', 'cat.nom = :categorie')
                ->where('ecriture.date BETWEEN :debut AND :fin')
                ->setParameter('categorie', $categorie)
                ->setParameter('debut', $date1)
                ->setParameter('fin', $date2)
                ->orderBy('ecriture.date', 'DESC');
    }
}