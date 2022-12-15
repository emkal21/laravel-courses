<?php

namespace App\Responses;

use App\Exceptions\InvalidTransformerInResponseException;
use App\Traits\ResponseTransformsData;
use App\Transformers\TransformerInterface;
use ReflectionException;
use ReflectionMethod;

/** @template T of object */
abstract class EntityResponse extends SuccessResponse
{
    use ResponseTransformsData;

    /* @var T $entity */
    private $entity;

    /**
     * @param T $entity
     * @throws InvalidTransformerInResponseException
     */
    public function __construct($entity)
    {
        $this->entity = $entity;

        parent::__construct($this->transformData());
    }

    /**
     * @param ReflectionMethod $transformationMethod
     * @return array
     * @throws ReflectionException
     */
    protected function executeTransformation(ReflectionMethod $transformationMethod): array
    {
        return $transformationMethod->invoke(null, $this->entity);
    }

    /**
     * @return class-string<TransformerInterface>
     */
    abstract protected function getTransformerClass(): string;
}
