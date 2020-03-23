<?php

namespace CRodrigo\PassportMultiauth\Tests\Fixtures\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use CRodrigo\PassportMultiauth\HasMultiAuthApiTokens;

class User extends Authenticatable
{
    protected $table = 'users';

    use HasMultiAuthApiTokens;

    public function getAuthIdentifierName()
    {
        return 'id';
    }
}
