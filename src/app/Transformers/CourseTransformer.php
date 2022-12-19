<?php

namespace App\Transformers;

use App\Entities\Course;
use App\Formatters\DateTimeFormatter;

/**
 * @implements TransformerInterface<Course>
 */
class CourseTransformer implements TransformerInterface
{
    /**
     * @param Course $entity
     * @return array
     */
    public static function transform($entity): array
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
