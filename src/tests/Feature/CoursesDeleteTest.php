<?php

namespace Tests\Feature;

class CoursesDeleteTest extends CoursesTestCase
{
    public function test_creates_and_deletes_course(): void
    {
        $updatePayload = [
            'title' => 'Edited title',
            'description' => 'Edited description',
            'status' => 'Pending',
            'is_premium' => false,
        ];

        $this->truncateTable();

        $this->createCourses(count: 1);

        $response = $this->getIndexResponse();
        $this->assertCoursesCount($response, 1);

        $response = $this->getRetrieveResponse('1');
        $response->assertStatus(200);

        $response = $this->getUpdateResponse('1', $updatePayload);
        $response->assertStatus(200);

        $response = $this->getDeleteResponse('1');
        $response->assertStatus(204);

        $response = $this->getIndexResponse();
        $this->assertCoursesCount($response, 0);

        $response = $this->getRetrieveResponse('1');
        $response->assertStatus(404);

        $response = $this->getUpdateResponse('1', $updatePayload);
        $response->assertStatus(404);

        $response = $this->getDeleteResponse('1');
        $response->assertStatus(404);
    }
}
