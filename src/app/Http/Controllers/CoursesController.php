<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidTransformerInResponseException;
use App\Responses\CourseResponse;
use App\Responses\CoursesResponse;
use App\Responses\EntityNotFoundResponse;
use App\Services\CoursesService;
use Illuminate\Http\JsonResponse;

class CoursesController extends Controller
{
    private CoursesService $coursesService;

    /**
     * @param CoursesService $coursesService
     */
    public function __construct(CoursesService $coursesService)
    {
        $this->coursesService = $coursesService;
    }

    /**
     * @return JsonResponse
     * @throws InvalidTransformerInResponseException
     */
    public function index(): JsonResponse
    {
        $page = 1;
        $itemsPerPage = 5;

        $courses = $this->coursesService->paginate($itemsPerPage, $page);

        $response = new CoursesResponse($courses);

        return $response->send();
    }

    /**
     * @param string $id
     * @return JsonResponse
     * @throws InvalidTransformerInResponseException
     */
    public function retrieve(string $id): JsonResponse
    {
        $id = intval($id);

        $course = $this->coursesService->findById($id);

        if (is_null($course)) {
            $response = new EntityNotFoundResponse();
        } else {
            $response = new CourseResponse($course);
        }

        return $response->send();
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
