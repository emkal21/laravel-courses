<?php

namespace Tests\Feature;

use DateTime;

class CoursesIndexTest extends CoursesTestCase
{
    private int $itemsPerPage = 10;
    private int $coursesToCreate = 50;

    public function test_returns_empty_array_if_no_courses_exist(): void
    {
        $this->truncateTable();

        $response = $this->getIndexResponse();

        $this->assertCoursesCount($response, 0);
    }

    public function test_returns_errors_on_validation_failed(): void
    {
        $response = $this->getIndexResponse('', '');

        $this->assertValidationErrors($response, [
            'The page must be an integer.',
            'The page must be at least 1.',
            'The items per page must be an integer.',
            'The items per page must be at least 1.',
        ]);

        $response = $this->getIndexResponse('failedvalidation', 'failedvalidation');

        $this->assertValidationErrors($response, [
            'The page must be an integer.',
            'The items per page must be an integer.',
        ]);

        $response = $this->getIndexResponse('-1', '-1');

        $this->assertValidationErrors($response, [
            'The page must be at least 1.',
            'The items per page must be at least 1.',
        ]);

        $response = $this->getIndexResponse('0', '0');

        $this->assertValidationErrors($response, [
            'The page must be at least 1.',
            'The items per page must be at least 1.',
        ]);

        $response = $this->getIndexResponse(null, 200);

        $this->assertValidationErrors($response, [
            'The items per page must not be greater than 100.',
        ]);
    }

    public function test_returns_array_if_courses_exist(): void
    {
        $this->truncateTable();

        $this->createCourses();

        $response = $this->getIndexResponse();

        $this->assertCoursesCount($response, $this->itemsPerPage);
    }

    public function test_returns_empty_array_on_invalid_page(): void
    {
        $response = $this->getIndexResponse(50);

        $this->assertCoursesCount($response, 0);
    }

    public function test_returns_correct_courses(): void
    {
        $createdAt = new DateTime();

        $this->truncateTable();

        $this->createCourses(createdAt: $createdAt, count: $this->coursesToCreate);

        $this->checkPageResults($createdAt, 1, $this->itemsPerPage);
        $this->checkPageResults($createdAt, 2, $this->itemsPerPage);
    }

    private function checkPageResults(DateTime $createdAt, int $page, int $itemsPerPage)
    {
        $response = $this->getIndexResponse($page);

        $this->assertCoursesCount($response, $itemsPerPage);

        $courses = $this->makeCourses(
            createdAt: $createdAt,
            fromCount: (($page - 1) * $itemsPerPage) + 1,
            toCount: $page * $this->itemsPerPage,
        );

        $response->assertExactJson(['data' => $courses]);
    }
}
