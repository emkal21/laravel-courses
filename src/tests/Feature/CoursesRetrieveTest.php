<?php

namespace Tests\Feature;

class CoursesRetrieveTest extends CoursesTestCase
{
    public function test_creates_and_retrieves_course(): void
    {
        $this->truncateTable();

        $this->createCourses(count: 1);

        $response = $this->getRetrieveResponse('100');
        $response->assertStatus(404);

        $response = $this->getRetrieveResponse('1');
        $response->assertExactJson([
            'data' => $this->makeCourses()[0],
        ]);
    }
}
