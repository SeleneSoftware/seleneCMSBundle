<?php

namespace Selene\CMSBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Selene\CMSBundle\Entity\ImageFile;
use Selene\CMSBundle\Traits\RepositorySlugTrait;

/**
 * @extends ServiceEntityRepository<ImageFile>
 *
 * @method ImageFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageFile[]    findAll()
 * @method ImageFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageFileRepository extends ServiceEntityRepository
{
    use RepositorySlugTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageFile::class);
    }

    public function save(ImageFile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ImageFile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ImageFile[] Returns an array of ImageFile objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ImageFile
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
