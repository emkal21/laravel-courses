<?php

namespace App\Transformers;

use App\Entities\EntityInterface;

abstract class AbstractTransformer
{
    /**
     * @param EntityInterface $entity
     * @return array
     */
    abstract static public function transform(EntityInterface $entity): array;
}
