<?php

namespace App\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectRepository;

/**
 * @template T
 * @implements DoctrineRepositoryInterface<T>
 */
abstract class DoctrineRepository implements DoctrineRepositoryInterface
{
    protected EntityManagerInterface $entityManager;
    protected ObjectRepository $repository;

    public function __construct(ManagerRegistry $registry)
    {
        /** @var class-string<T> $entityClass */
        $entityClass = $this->getEntityClass();

        /** @var EntityManagerInterface $entityManager */
        $entityManager = $registry->getManagerForClass($entityClass);

        $repository = $entityManager->getRepository($entityClass);

        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $queryBuilder = $this->getQueryBuilderForEntity();

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $itemsPerPage
     * @param int $page
     * @return array
     */
    public function paginate(int $itemsPerPage, int $page): array
    {
        $page = max(0, $page);

        $itemsPerPage = max(1, $itemsPerPage);
        $itemsPerPage = min(100, $itemsPerPage);

        $offset = ($page - 1) * $itemsPerPage;
        $offset = max(0, $offset);

        $queryBuilder = $this
            ->getQueryBuilderForEntity()
            ->setFirstResult($offset)
            ->setMaxResults($itemsPerPage);

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        $queryBuilder = $this
            ->getQueryBuilderForEntity()
            ->andWhere('entity.id = :id')
            ->setMaxResults(1)
            ->setParameter('id', $id);

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

    /**
     * @return QueryBuilder
     */
    private function getQueryBuilderForEntity(): QueryBuilder
    {
        return $this
            ->repository
            ->createQueryBuilder('entity')
            ->where('entity.deletedAt is null');
    }

    /**
     * @return class-string<T>
     */
    abstract protected function getEntityClass(): string;
}
