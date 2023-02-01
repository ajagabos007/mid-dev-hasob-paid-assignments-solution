<?php

namespace Tests;


use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use App\Models\User;
use Hasob\FoundationCore\Models\User;
use Hasob\FoundationCore\Models\Attachment;
use Hasob\FoundationCore\Models\Department;
use Hasob\FoundationCore\Models\Organization;

use Hasob\FoundationCore\Traits\Testing\WithUser;
use Hasob\FoundationCore\Traits\Testing\WithOrganization;
use Hasob\FoundationCore\Traits\Testing\WithDepartment;


use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithUser;
    use WithOrganization;
    use WithDepartment;
    // use DatabaseMigrations;

     /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpDepartment();
        $this->setUpOrganization();
        $this->setUpUser();
        $this->setUpAdmin();          
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     *
     * @throws \Mockery\Exception\InvalidCountException
     */
    protected function  tearDown():void {
        parent::tearDown();
        // $this->refreshOrganization();
    }
}
