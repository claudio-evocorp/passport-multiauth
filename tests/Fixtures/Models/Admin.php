<?php

namespace CRodrigo\PassportMultiauth\Tests\Fixtures\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use CRodrigo\PassportMultiauth\HasMultiAuthApiTokens;

class Admin extends Authenticatable
{
    protected $table = 'admins';

    use HasMultiAuthApiTokens;

    public function getAuthIdentifierName()
    {
        return 'id';
    }
}
