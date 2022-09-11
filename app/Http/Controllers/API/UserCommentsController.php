<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserCommentsController extends Controller
{
    public $message;
    public $response = [];
    public $input_variables = ['password', 'id', 'comments'];
    private const APP_PASSWORD = '720DF6C2482218518FA20FDC52D4DED7ECC043AB';
    
    public function show($id)
    {
        if(!is_numeric($id))
        {
            $this->message = "Invalid ID! (" . $id . ")";
            return response()->json(['message' => $this->message, 'message_status' => parent::FAILED_MESSAGE], 422);
        }

        /* Return Message on Error */
        $this->response = User::get_user_by_id($id);
        if($this->response->getData()->message_status == 'failed')
        {
            return $this->response;
        }

        /* On Success Return Data and View */
        $user = json_decode($this->response->getContent())->data;
        return view("view",compact("user"));
    }

    public function update(Request $request, $id)
    {
        
    }
}
