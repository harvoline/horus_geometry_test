<?php

namespace App\Repository;

use App\Entity\ShapeAbstract;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShapeAbstract>
 *
 * @method ShapeAbstract|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShapeAbstract|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShapeAbstract[]    findAll()
 * @method ShapeAbstract[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShapeAbstractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShapeAbstract::class);
    }

    public function add(ShapeAbstract $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ShapeAbstract $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ShapeAbstract[] Returns an array of ShapeAbstract objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ShapeAbstract
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
