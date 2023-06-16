<?php

namespace App\Http\Traits;

use App\Models\Shelters;

trait SheltersValidationTrait
{
    /**
     * @param array $requestAll
     * @param Shelters $shelters
     * @return array
     */
    public function formValidation(array $requestAll, Shelters $shelters): array
    {
        $response = [];
        if(!empty($requestAll[Shelters::COLUMN_NAME])) {
            $shelters->{Shelters::COLUMN_NAME} = $requestAll[Shelters::COLUMN_NAME];
        } else {
            $response['errors'][] = __(sprintf(
                "Pole %s jest wymagane",
                $requestAll[Shelters::COLUMN_NAME]
            ));
        }

        if(!empty($requestAll[Shelters::COLUMN_STREET])) {
            $shelters->{Shelters::COLUMN_STREET} = $requestAll[Shelters::COLUMN_STREET];
        } else {
            $response['errors'][] = __(sprintf(
                "Pole %s jest wymagane",
                Shelters::COLUMN_STREET
            ));
        }

        if(!empty($requestAll[Shelters::COLUMN_POST_CODE])) {
            $shelters->{Shelters::COLUMN_POST_CODE} = $requestAll[Shelters::COLUMN_POST_CODE];
        } else {
            $response['errors'][] = __(sprintf(
                "Pole %s jest wymagane",
                Shelters::COLUMN_POST_CODE
            ));
        }

        if(!empty($requestAll[Shelters::COLUMN_CITY])) {
            $shelters->{Shelters::COLUMN_CITY} = $requestAll[Shelters::COLUMN_CITY];
        } else {
            $response['errors'][] = __(sprintf(
                "Pole %s jest wymagane",
                Shelters::COLUMN_CITY
            ));
        }

        if(!empty($requestAll[Shelters::COLUMN_COUNTRY])) {
            $shelters->{Shelters::COLUMN_COUNTRY} = $requestAll[Shelters::COLUMN_COUNTRY];
        } else {
            $response['errors'][] = __(sprintf(
                "Pole %s jest wymagane",
                Shelters::COLUMN_COUNTRY
            ));
        }

        return $response;
    }
}