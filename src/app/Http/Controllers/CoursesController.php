<?php

namespace App\Http\Controllers;

use App\Repositories\CourseRepositoryInterface;
use App\Responses\CourseResponse;
use App\Responses\EntityNotFoundResponse;
use Illuminate\Http\JsonResponse;

class CoursesController extends Controller
{
    private CourseRepositoryInterface $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function index(): JsonResponse
    {
        $page = 0;
        $itemsPerPage = 100;

        $courses = $this->courseRepository->paginate($itemsPerPage, $page);

        $payload = CourseResponse::many($courses);

        return response()->json($payload);
    }

    public function retrieve($id): JsonResponse
    {
        $course = $this->courseRepository->findById($id);

        if (is_null($course)) {
            $payload = EntityNotFoundResponse::make();
        } else {
            $payload = CourseResponse::one($course);
        }

        return response()->json($payload);
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
