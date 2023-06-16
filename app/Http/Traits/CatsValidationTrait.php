<?php

namespace App\Http\Traits;

use App\Models\Cats;
use App\Models\Shelters;

trait CatsValidationTrait
{
    /**
     * @param array $requestAll
     * @param Cats $cats
     * @return array
     */
    public function formValidation(array $requestAll, Cats $cats): array
    {
        $response = [];

        if(!empty($requestAll[Cats::COLUMN_SHELTERS_ID])) {

            $shelters = Shelters::find($requestAll[Cats::COLUMN_SHELTERS_ID]);

            if(null === $shelters) {
                $response['errors'][] = __(sprintf(
                    "Brak schroniska o id: %d",
                    $requestAll[Cats::COLUMN_SHELTERS_ID]
                ));
            } else {
                $cats->{Cats::COLUMN_SHELTERS_ID} = $requestAll[Cats::COLUMN_SHELTERS_ID];
            }

        } else {
            $response['errors'][] = __(sprintf(
                "Pole %s jest wymagane",
                Cats::COLUMN_SHELTERS_ID
            ));
        }

        if(!empty($requestAll[Cats::COLUMN_NAME])) {
            $cats->{Cats::COLUMN_NAME} = $requestAll[Cats::COLUMN_NAME];
        } else {
            $response['errors'][] = __(sprintf(
                "Pole %s jest wymagane",
                Cats::COLUMN_NAME
            ));
        }

        return $response;
    }
}