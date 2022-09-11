<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserPostRouteTest extends TestCase
{
    public $id = 1; 
    public $comments = "Post Test Comment";
    private $password = "720DF6C2482218518FA20FDC52D4DED7ECC043AB";

    public function test_post_id_is_integer()
    {
        $id = is_integer($this->id);
        $this->assertTrue($id);
    }

    public function test_post_missing_key_id()
    {
        $response = $this->post(route('user_comments.update'),[
            'comments' => 'Sample Comment'
        ]);
        $this->assertEquals('Missing key/value for "id"',$response->getData()->message);
    }

    public function test_post_missing_key_comments()
    {
        $response = $this->post(route('user_comments.update'),[
            'id' => 1
        ]);
        $this->assertEquals('Missing key/value for "comments"',$response->getData()->message);
    }

    public function test_post_update_user_success()
    {
        $response = $this->post(route('user_comments.update',[
            'id' => $this->id,
            'password' => $this->password,
            'comments' => $this->comments
        ]));
        $response->assertStatus(200);
    }
}
