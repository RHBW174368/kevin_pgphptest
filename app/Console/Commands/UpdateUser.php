<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_user:comment {id} {comments} {password?} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lets you Update User Comment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
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
