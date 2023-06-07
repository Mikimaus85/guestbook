<?php

namespace App\Repository;

use App\Entity\GuestbookEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GuestbookRepository extends ServiceEntityRepository
{
    public function __construct(private readonly ManagerRegistry $registry){
        parent::__construct($this->registry, GuestbookEntity::class);
    }

    public function add(GuestbookEntity $guestbookEntity){
        $manager = $this->getEntityManager();
        $manager->persist($guestbookEntity);
    }

    public function flush(){
        $this->getEntityManager()->flush();
    }

    public function getPaginatedEntries(int $limit, int $page): array 
    {
        $offset = ($page - 1 ) * $limit;
        return $this->findBy([], ['createAt' => 'DESC'], $limit, $offset); // weitere Parameter möglich, [2 ist order by], $limit, $offset etc..
    }

}