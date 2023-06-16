<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cats;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Traits\CatsValidationTrait;

class CatsController extends Controller
{
    use CatsValidationTrait;

    /**
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        return response()->json(Cats::all());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getById(Request $request): JsonResponse
    {
        $foundCats = [];

        if(!empty($request->{Cats::COLUMN_ID})) {
            $foundCats = Cats::find((int)$request->{Cats::COLUMN_ID});
        }

        return response()->json($foundCats);
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
            $cats                   = new Cats();
            $response               = $this->formValidation($requestAll, $cats);
            $response['status']     = empty($response['errors']) && true === $cats->save();
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
            if($request->{Cats::COLUMN_ID}) {
                $cats = Cats::find((int)$request->{Cats::COLUMN_ID});
                if(null !== $cats) {
                    $response           = $this->formValidation($requestAll, $cats);
                    $response['status'] = empty($response['errors']) && true === $cats->save();
                } else {
                    $response['errors'][] = __(sprintf(
                        "Nie znaleziono kota o id: %d",
                        (int)$request->{Cats::COLUMN_ID}
                    ));
                }
            } else {
                $response['errors'][] = __(sprintf(
                    "Pole %s jest wymagane",
                    Cats::COLUMN_ID
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
        $catId      = (int)$request->{Cats::COLUMN_ID};
        $cat        = Cats::find($catId);

        if(null !== $cat) {
            $response['status'] = true === $cat->delete();
        } else {
            $response['status']     = false;
            $response['errors'][]   = sprintf(
                "Nie znaleziono kota o id: %d",
                $catId
            );
        }

        return response()->json($response);
    }
}