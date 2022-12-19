<?php

namespace Tests\Feature;

use App\Entities\Course;
use App\Enums\CourseStatus;
use App\Services\CoursesService;
use DateTime;
use DateTimeInterface;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

abstract class CoursesTestCase extends TestCase
{
    protected CoursesService $coursesService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->coursesService = $this->app->make(CoursesService::class);
    }

    protected function assertCoursesCount(TestResponse $response, int $count): void
    {
        $response->assertStatus(200);

        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->has('data')
                ->count('data', $count)
                ->etc()
        );
    }

    protected function assertValidationErrors(TestResponse $response, array $errors): void
    {
        $response->assertStatus(422);

        $response->assertExactJson(['errors' => $errors]);
    }

    protected function truncateTable(): void
    {
        $this->coursesService->truncate();
    }

    protected function createCourses(
        CourseStatus $status = CourseStatus::Published,
        bool         $isPremium = true,
        DateTime     $createdAt = new DateTime(),
        int          $count = 10,
    ): void
    {
        foreach (range(1, $count) as $num) {
            entity(Course::class)->create([
                'num' => $num,
                'status' => $status,
                'isPremium' => $isPremium,
                'createdAt' => $createdAt,
            ]);
        }
    }

    protected function getIndexResponse(?string $page = null, ?string $itemsPerPage = null): TestResponse
    {
        $url = route('courses.index', [
            'page' => $page,
            'items_per_page' => $itemsPerPage,
        ]);

        return $this->getJson($url);
    }

    protected function getRetrieveResponse(string $id): TestResponse
    {
        $url = route('courses.retrieve', ['id' => $id]);

        return $this->getJson($url);
    }

    protected function getDeleteResponse(string $id): TestResponse
    {
        $url = route('courses.delete', ['id' => $id]);

        return $this->deleteJson($url);
    }

    protected function getUpdateResponse(string $id, array $payload = []): TestResponse
    {
        $url = route('courses.update', ['id' => $id]);

        return $this->putJson($url, $payload);
    }

    protected function getCreateResponse(array $payload = []): TestResponse
    {
        $url = route('courses.create');

        return $this->postJson($url, $payload);
    }

    protected function makeCourses(
        CourseStatus $status = CourseStatus::Published,
        bool         $isPremium = true,
        DateTime     $createdAt = new DateTime(),
        int          $fromCount = 1,
        int          $toCount = 10,
    ): array
    {
        $courses = [];

        foreach (range($fromCount, $toCount) as $num) {
            $courses[] = [
                'id' => $num,
                'title' => sprintf('Test Title %d', $num),
                'description' => sprintf('Test Description %d', $num),
                'status' => $status,
                'is_premium' => $isPremium,
                'created_at' => $createdAt->format(DateTimeInterface::ATOM),
                'deleted_at' => null,
            ];
        }

        return $courses;
    }
}
