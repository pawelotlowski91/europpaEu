<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    /**
     * @var string
     */
    protected $table = 'employees';

    /** @var string */
    const COLUMN_ID = 'id';

    /** @var string */
    const COLUMN_SHELTERS_ID = 'shelters_id';

    /** @var string */
    const COLUMN_NAME = 'name';

    /** @var string */
    const COLUMN_SURNAME = 'surname';

    /** @var string */
    const COLUMN_CREATED_AT = 'created_at';

    /** @var string */
    const COLUMN_UPDATED_AT = 'updated_at';
}