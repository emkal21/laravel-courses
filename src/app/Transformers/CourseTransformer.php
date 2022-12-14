<?php

namespace App\Transformers;

use App\Entities\Course;
use App\Entities\EntityInterface;
use App\Formatters\DateTimeFormatter;

class CourseTransformer extends AbstractTransformer
{
    /**
     * @param Course|EntityInterface $entity
     * @return array
     */
    public static function transform(Course|EntityInterface $entity): array
    {
        return [
            'id' => $entity->getId(),
            'title' => $entity->getTitle(),
            'description' => $entity->getDescription(),
            'status' => $entity->getStatus(),
            'is_premium' => $entity->isPremium(),
            'created_at' => DateTimeFormatter::format($entity->getCreatedAt()),
            'deleted_at' => DateTimeFormatter::format($entity->getDeletedAt()),
        ];
    }
}
