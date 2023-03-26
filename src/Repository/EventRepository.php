<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function save(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getEventByAddress($address): array
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $results = $qb->select('e','t')
            ->from(Event::class, 'e')
            ->andWhere('e.address=:val')
            ->setParameter('val', $address)
            ->join('e.ticket','t')
            ->getQuery()
            ->getArrayResult();
        for ($i = 0; $i < count($results); $i++) {
            $results[$i]['imageName'] = '/uploads/media/' . $results[$i]['imageName'];
        }
        return $results;
    }

    public function getAllEvents(): array
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $results = $qb->select('e','t')
            ->from(Event::class, 'e')
            ->join('e.ticket','t')
            ->getQuery()
            ->getArrayResult();
        for ($i = 0; $i < count($results); $i++) {
            $results[$i]['imageName'] = '/uploads/media/' . $results[$i]['imageName'];
        }
        return $results;
    }

    //    /**
    //     * @return Event[] Returns an array of Event objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Event
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
