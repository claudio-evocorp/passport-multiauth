<?php

namespace CRodrigo\PassportMultiauth\Tests\Fixtures\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use CRodrigo\PassportMultiauth\HasMultiAuthApiTokens;

class Company extends Authenticatable
{
    protected $table = 'companies';

    use HasMultiAuthApiTokens;

    public function getAuthIdentifierName()
    {
        return 'id';
    }
}
