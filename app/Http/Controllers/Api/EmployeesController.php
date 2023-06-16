<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Traits\EmployeesValidationTrait;
class EmployeesController extends Controller
{

    use EmployeesValidationTrait;

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        return response()->json(Employees::all());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getById(Request $request): JsonResponse
    {
        $foundEmployees = [];

        if(!empty($request->{Employees::COLUMN_ID})) {
            $foundEmployees = Employees::find((int)$request->{Employees::COLUMN_ID});
        }

        return response()->json($foundEmployees);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $response   = [];
        $requestAll = $request->all();

        if(!empty($requestAll)) {
            $employees  = new Employees();
            $response   = $this->formValidation($requestAll, $employees);
            $response['status'] = empty($response['errors']) && true === $employees->save();
        }

        return response()->json($response, true === $response['status'] ? 200 : 500);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function edit(Request $request): JsonResponse
    {
        $response       = [];
        $requestAll     = $request->all();

        if(!empty($requestAll)) {
            if($request->{Employees::COLUMN_ID}) {
                $employees = Employees::find((int)$request->{Employees::COLUMN_ID});

                if(null !== $employees) {
                    $response = $this->formValidation($requestAll, $employees);
                    $response['status'] = empty($response['errors']) && true === $employees->save();
                } else {
                    $response['errors'][] = __(sprintf(
                        "Nie znaleziono pracownika o id: %d",
                        (int)$request->{Employees::COLUMN_ID}
                    ));
                }
            } else {
                $response['errors'][] = __(sprintf(
                    "Pole %s jest wymagane",
                    Employees::COLUMN_ID
                ));
            }
        }

        return response()->json($response, true === $response['status'] ? 200 : 500);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $response   = [];
        $employeeId = (int)$request->{Employees::COLUMN_ID};
        $employee   = Employees::find($employeeId);


        if(null !== $employee) {
            $response['status'] = true === $employee->delete();
        } else {
            $response['status']     = false;
            $response['errors'][]   = sprintf(
                "Nie znaleziono kota o id: %d",
                $employee
            );
        }

        return response()->json($response);
    }
}