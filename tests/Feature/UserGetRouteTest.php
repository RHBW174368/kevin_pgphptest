<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserGetRouteTest extends TestCase
{
    public $id = 1;

    public function test_user_id_is_integer_and_user_exist_from_database()
    {
        $id = is_integer($this->id);
        $user = User::where('id', $this->id)->exists();
        $this->assertTrue($id);
        $this->assertTrue($user);
    }

    public function test_get_user_request_success()
    {
        $response = $this->get(route('user_comments.show',['id' => $this->id]));
        $response->assertStatus(200);
    }

    public function test_user_variable_exist_in_view()
    {
        $response = $this->get(route('user_comments.show',['id' => $this->id]));
        $response->assertViewHas("user", $value = null);
    }
}
