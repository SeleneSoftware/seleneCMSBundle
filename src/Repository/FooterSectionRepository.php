<?php

namespace Selene\CMSBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Selene\CMSBundle\Entity\FooterSection;

/**
 * @extends ServiceEntityRepository<FooterSection>
 *
 * @method FooterSection|null find($id, $lockMode = null, $lockVersion = null)
 * @method FooterSection|null findOneBy(array $criteria, array $orderBy = null)
 * @method FooterSection[]    findAll()
 * @method FooterSection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FooterSectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FooterSection::class);
    }

    //    /**
    //     * @return FooterSection[] Returns an array of FooterSection objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?FooterSection
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
