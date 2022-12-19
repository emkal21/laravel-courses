<?php

namespace Tests\Feature;

use App\Enums\CourseStatus;
use DateTime;
use DateTimeInterface;

class CoursesCreateTest extends CoursesTestCase
{
    public function test_empty_request(): void
    {
        $this->truncateTable();

        $response = $this->getCreateResponse();

        $this->assertValidationErrors($response, [
            'The title field is required.',
            'The status field is required.',
            'The is premium field is required.',
        ]);
    }

    public function test_validate_title(): void
    {
        $this->truncateTable();

        $payload = ['status' => CourseStatus::Published, 'is_premium' => true];

        $payload['title'] = null;
        $response = $this->getCreateResponse($payload);
        $this->assertValidationErrors($response, ['The title field is required.']);

        $payload['title'] = '';
        $response = $this->getCreateResponse($payload);
        $this->assertValidationErrors($response, ['The title field is required.']);

        $payload['title'] = str_repeat('a', 256);
        $response = $this->getCreateResponse($payload);
        $this->assertValidationErrors($response, ['The title must not be greater than 255 characters.']);

        $payload['title'] = str_repeat('a', 255);
        $response = $this->getCreateResponse($payload);
        $response->assertStatus(200);
    }

    public function test_validate_description(): void
    {
        $this->truncateTable();

        $payload = ['title' => 'test title', 'status' => CourseStatus::Published, 'is_premium' => true];

        $payload['description'] = null;
        $response = $this->getCreateResponse($payload);
        $this->assertValidationErrors($response, ['The description must be a string.']);

        $payload['description'] = str_repeat('a', 255);
        $response = $this->getCreateResponse($payload);
        $response->assertStatus(200);
    }

    public function test_validate_status(): void
    {
        $this->truncateTable();

        $payload = ['title' => 'test title', 'is_premium' => true];

        $payload['status'] = null;
        $response = $this->getCreateResponse($payload);
        $this->assertValidationErrors($response, ['The status field is required.']);

        $payload['status'] = '';
        $response = $this->getCreateResponse($payload);
        $this->assertValidationErrors($response, ['The status field is required.']);

        $payload['status'] = 'invalid';
        $response = $this->getCreateResponse($payload);
        $this->assertValidationErrors($response, ['The selected status is invalid.']);

        $payload['status'] = CourseStatus::Published;
        $response = $this->getCreateResponse($payload);
        $response->assertStatus(200);
    }

    public function test_validate_is_premium(): void
    {
        $this->truncateTable();

        $payload = ['title' => 'test title', 'status' => CourseStatus::Published];

        $payload['is_premium'] = null;
        $response = $this->getCreateResponse($payload);
        $this->assertValidationErrors($response, ['The is premium field is required.']);

        $payload['is_premium'] = '';
        $response = $this->getCreateResponse($payload);
        $this->assertValidationErrors($response, ['The is premium field is required.']);

        $payload['is_premium'] = 'invalid';
        $response = $this->getCreateResponse($payload);
        $this->assertValidationErrors($response, ['The is premium field must be true or false.']);

        $payload['is_premium'] = true;
        $response = $this->getCreateResponse($payload);
        $response->assertStatus(200);
    }

    public function test_create_valid_course(): void
    {
        $createdAt = new DateTime();

        $this->truncateTable();

        $payload = [
            'title' => 'test title',
            'description' => 'test title',
            'status' => CourseStatus::Published,
            'is_premium' => true,
        ];

        $response = $this->getCreateResponse($payload);

        $response->assertStatus(200);

        $response->assertExactJson([
            'data' => [
                'id' => 1,
                'title' => 'test title',
                'description' => 'test title',
                'status' => CourseStatus::Published,
                'is_premium' => true,
                'created_at' => $createdAt->format(DateTimeInterface::ATOM),
                'deleted_at' => null,
            ],
        ]);
    }
}
