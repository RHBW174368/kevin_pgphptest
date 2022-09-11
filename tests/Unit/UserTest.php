<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use App\Http\Controllers\Helpers\DataValidationHelper;

class UserTest extends TestCase
{
    public $id = 1;

    public function test_user_id_is_integer()
    {
        $id = is_integer($this->id);
        $this->assertTrue($id);
    }
}
