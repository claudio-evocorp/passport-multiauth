<?php

namespace CRodrigo\PassportMultiauth\Tests\Unit;

use CRodrigo\PassportMultiauth\Config\AuthConfigHelper;
use CRodrigo\PassportMultiauth\Exceptions\MissingConfigException;
use CRodrigo\PassportMultiauth\Tests\Fixtures\Models\Company;
use CRodrigo\PassportMultiauth\Tests\Fixtures\Models\Customer;
use CRodrigo\PassportMultiauth\Tests\Fixtures\Models\User;
use CRodrigo\PassportMultiauth\Tests\TestCase;

class AuthConfigHelperTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->setAuthConfigs();
    }

    public function testGetProviderGuard()
    {
        $guard = AuthConfigHelper::getProviderGuard('companies');

        $this->assertEquals('company', $guard);
    }

    public function testGetProviderGuardWithNotPassportDriver()
    {
        $this->expectException(MissingConfigException::class);
        $this->expectExceptionMessage('Any guard found for provider customers and driver passport');

        config(['auth.guards.customer.driver' => 'token']);
        config(['auth.guards.customer.provider' => 'customers']);

        config(['auth.providers.customers.driver' => 'eloquent']);
        config(['auth.providers.customers.model' => Customer::class]);

        AuthConfigHelper::getProviderGuard('customers');
    }

    public function testGetUserGuard()
    {
        $guard = AuthConfigHelper::getUserGuard(new User);

        $this->assertEquals('api', $guard);
    }

    public function testGetUserGuardToCompanyModel()
    {
        $guard = AuthConfigHelper::getUserGuard(new Company);

        $this->assertEquals('company', $guard);
    }

    public function testGetUserProviderWithModelNotExistentOnProviders()
    {
        $this->expectException(MissingConfigException::class);
        $this->expectExceptionMessage('Any provider found to '.Customer::class.'. Please, check your config/auth.php file.');

        AuthConfigHelper::getUserProvider(new Customer);
    }
}
