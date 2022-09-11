<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\API\UserCommentsController;
use Illuminate\Http\Request;

class UpdateUser extends Command
{
    protected $signature = 'update_user:comment {id} {comments} {password?} ';

    protected $description = 'Lets you Update User Comment';

    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $id = $this->argument('id');
        $comment = $this->argument('comments');
        $password = $this->argument('password');
        $params = [
            'comments' => $comment,
            'id' => $id,
            'password' => $password
        ];
        $request = Request::create(route('user_comments.update'), 'POST', $params);
        $response = app()->handle($request);
        $responseBody = $response->getContent();
        echo $responseBody;
    }
}
