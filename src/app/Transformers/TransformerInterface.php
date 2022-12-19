<?php

namespace App\Transformers;

/** @template T of object */
interface TransformerInterface
{
    /**
     * @param T $entity
     * @return array
     */
    public static function transform($entity): array;
}
