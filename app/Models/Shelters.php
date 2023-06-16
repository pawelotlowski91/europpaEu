<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shelters extends Model
{
    /**
     * @var string
     */
    protected $table = 'shelters';

    /** @var string */
    const COLUMN_ID             = 'id';

    const COLUMN_NAME           = 'name';

    /** @var string */
    const COLUMN_STREET         = 'street';

    /** @var string */
    const COLUMN_POST_CODE      = 'post_code';

    /** @var string */
    const COLUMN_CITY           = 'city';

    /** @var string */
    const COLUMN_COUNTRY        = 'country';

    /** @var string */
    const COLUMN_CREATED_AT     = 'created_at';

    /** @var string */
    const COLUMN_UPDATED_AT     = 'updated_at';
}
