<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     *  Trouve toutes les tâches, avec les tâches non terminées d'abord.
     * 
     * @param int|null $taskListId
     * @return Task[]
     */
    public function findOrderByStatus(?int $taskListId = null): array
    {
        $qb = $this->createQueryBuilder('t')
            ->orderBy('t.isDone', 'ASC')
            ->addOrderBy('t.createdAt', 'DESC');
        
            if ($taskListId) {
                $qb->andWhere('t.taskList = :taskList')
                   ->setParameter('taskList', $taskListId);
            }

            return $qb->getQuery()->getResult();
    }

}