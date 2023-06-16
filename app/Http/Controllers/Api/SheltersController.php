<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shelters;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Traits\SheltersValidationTrait;

class SheltersController extends Controller
{

    use SheltersValidationTrait;

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        return response()->json(Shelters::all());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getById(Request $request): JsonResponse
    {
        $foundShelter = [];

        if(!empty($request->{Shelters::COLUMN_ID})) {
            $foundShelter = Shelters::find((int)$request->{Shelters::COLUMN_ID});
        }

        return response()->json($foundShelter);
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
            $shelters           = new Shelters();
            $response           = $this->formValidation($requestAll, $shelters);
            $response['status'] = empty($response['errors']) && true === $shelters->save();
        }

        return response()->json($response, true === $response['status'] ? 200 : 500);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function edit(Request $request): JsonResponse
    {
        $response   = [];
        $requestAll = $request->all();

        if(!empty($requestAll)) {
            if($request->{Shelters::COLUMN_ID}) {
                $shelters = Shelters::find($request->{Shelters::COLUMN_ID});

                if(null !== $shelters) {
                    $response           = $this->formValidation($requestAll, $shelters);
                    $response['status'] = empty($response['errors']) && true === $shelters->save();
                } else {
                    $response['errors'][] = __(sprintf(
                        "Nie znaleziono schroniska o id: %d",
                        (int)$request->{Shelters::COLUMN_ID}
                    ));
                }

            } else {
                $response['errors'][] = __(sprintf(
                    "Pole %s jest wymagane",
                    Shelters::COLUMN_ID
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
        $shelterId  = (int)$request->{Shelters::COLUMN_ID};
        $shelter    =  Shelters::find($shelterId);

        if(null !== $shelter) {
            $response['status'] = true === $shelter->delete();
        } else {
            $response['status']     = false;
            $response['errors'][]   = sprintf(
                "Nie znaleziono schroniska o id: %d",
                $shelterId
            );
        }

        return response()->json($response);
    }
}