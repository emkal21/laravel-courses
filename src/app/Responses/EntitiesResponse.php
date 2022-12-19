<?php

namespace App\Responses;

use App\Exceptions\InvalidTransformerInResponseException;
use App\Traits\ResponseTransformsData;
use App\Transformers\TransformerInterface;
use ReflectionException;
use ReflectionMethod;

/** @template T of object */
abstract class EntitiesResponse extends SuccessResponse
{
    use ResponseTransformsData;

    /* @var T[] $entities */
    private array $entities;

    /**
     * @param T[] $entities
     * @throws InvalidTransformerInResponseException
     */
    public function __construct($entities)
    {
        $this->entities = $entities;

        parent::__construct($this->transformData());
    }

    /**
     * @param ReflectionMethod $transformationMethod
     * @return array
     * @throws ReflectionException
     */
    protected function executeTransformation(ReflectionMethod $transformationMethod): array
    {
        /* @var T $entity */
        return array_map(fn($entity): array => $transformationMethod->invoke(null, $entity), $this->entities);
    }

    /**
     * @return class-string<TransformerInterface>
     */
    abstract protected function getTransformerClass(): string;
}
