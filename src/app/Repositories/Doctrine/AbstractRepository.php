<?php

namespace App\Repositories\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractRepository
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $queryBuilder = $this->getQueryBuilderForEntity();

        $query = $queryBuilder->getQuery();

        return $query->getResult();
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

        $query = $queryBuilder->getQuery();

        return $query->getResult();
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
            ->setParameter('id', $id);

        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }

    /**
     * @return QueryBuilder
     */
    private function getQueryBuilderForEntity(): QueryBuilder
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        return $queryBuilder
            ->select('entity')
            ->from($this->entity, 'entity')
            ->where('entity.deletedAt is null');
    }
}
