<?php

namespace App\Http\Controllers;

use App\Entities\Course;
use App\Enums\CourseStatus;
use App\Exceptions\InvalidTransformerInResponseException;
use App\Responses\CourseResponse;
use App\Responses\CoursesResponse;
use App\Responses\EntityNotFoundResponse;
use App\Responses\ErrorResponse;
use App\Responses\NoContentResponse;
use App\Services\CoursesService;
use App\Validators\CourseValidator;
use App\Validators\IndexValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return JsonResponse
     * @throws InvalidTransformerInResponseException
     */
    public function index(Request $request): JsonResponse
    {
        $validator = new IndexValidator($request->all());

        $errors = $validator->validate();

        if (count($errors) > 0) {
            return (new ErrorResponse($errors))->send();
        }

        $page = intval($request->input('page', 1));
        $itemsPerPage = intval($request->input('items_per_page', 10));

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

    /**
     * @throws InvalidTransformerInResponseException
     */
    public function create(Request $request): JsonResponse
    {
        $validator = new CourseValidator($request->all());

        $errors = $validator->validate();

        if (count($errors) > 0) {
            return (new ErrorResponse($errors))->send();
        }

        $course = new Course(
            title: $request->input('title'),
            description: $request->input('description'),
            status: CourseStatus::from($request->input('status')),
            isPremium: $request->input('is_premium'),
        );

        $this->coursesService->save($course);

        return (new CourseResponse($course))->send();
    }

    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws InvalidTransformerInResponseException
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $validator = new CourseValidator($request->all());

        $errors = $validator->validate();

        if (count($errors) > 0) {
            return (new ErrorResponse($errors))->send();
        }

        $id = intval($id);

        $course = $this->coursesService->findById($id);

        if (is_null($course)) {
            return (new EntityNotFoundResponse())->send();
        }

        $course->setTitle($request->input('title'));
        $course->setDescription($request->input('description'));
        $course->setStatus(CourseStatus::from($request->input('status')));
        $course->setIsPremium($request->input('is_premium'));

        $this->coursesService->save($course);

        return (new CourseResponse($course))->send();
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function delete(string $id): JsonResponse
    {
        $id = intval($id);

        $course = $this->coursesService->findById($id);

        if (is_null($course)) {
            $response = new EntityNotFoundResponse();
        } else {
            $this->coursesService->softDelete($course);

            $response = new NoContentResponse();
        }

        return $response->send();
    }
}
