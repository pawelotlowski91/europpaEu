<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cats extends Model
{
    /**
     * @var string
     */
    protected $table = 'cats';

    /** @var string */
    const COLUMN_ID             = 'id';

    /** @var string */
    const COLUMN_SHELTERS_ID    = 'shelters_id';

    /** @var string */
    const COLUMN_NAME           = 'name';

    /** @var string */
    const COLUMN_CREATED_AT     = 'created_at';

    /** @var string */
    const COLUMN_UPDATED_AT     = 'updated_at';
}