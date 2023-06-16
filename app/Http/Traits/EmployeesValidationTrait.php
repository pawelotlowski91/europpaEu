<?php

namespace App\Http\Traits;

use App\Models\Employees;
use App\Models\Shelters;

trait EmployeesValidationTrait
{
    public function formValidation(array $requestAll, Employees $employees): array
    {
        $response = [];

        if(!empty($requestAll[Employees::COLUMN_SHELTERS_ID])) {

            $shelters = Shelters::find($requestAll[Employees::COLUMN_SHELTERS_ID]);

            if(null === $shelters) {
                $response['errors'][] = __(sprintf(
                    "Brak schroniska o id: %d",
                    $requestAll[Employees::COLUMN_SHELTERS_ID]
                ));
            } else {
                $employees->{Employees::COLUMN_SHELTERS_ID} = $requestAll[Employees::COLUMN_SHELTERS_ID];
            }

        } else {
            $response['errors'][] = __(sprintf(
                "Pole %s jest wymagane",
                Employees::COLUMN_SHELTERS_ID
            ));
        }

        if(!empty($requestAll[Employees::COLUMN_NAME])) {
            $employees->{Employees::COLUMN_NAME} = $requestAll[Employees::COLUMN_NAME];
        } else {
            $response['errors'][] = __(sprintf(
                "Pole %s jest wymagane",
                Employees::COLUMN_NAME
            ));
        }

        if(!empty($requestAll[Employees::COLUMN_SURNAME])) {
            $employees->{Employees::COLUMN_SURNAME} = $requestAll[Employees::COLUMN_SURNAME];
        } else {
            $response['errors'][] = __(sprintf(
                "Pole %s jest wymagane",
                Employees::COLUMN_SURNAME
            ));
        }

        return $response;
    }
}