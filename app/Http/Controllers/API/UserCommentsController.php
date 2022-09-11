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
        /* Check If $_POST Content or $_POST from CLI */
        if($request->headers->get('Content-Type') == "application/json")
        {
            $json = $request->getContent();
            if(!DataValidationHelper::is_json($json))
            {
                $this->message = 'Invalid POST JSON';
                return response()->json([
                    'message' => $this->message, 
                    'message_status' => parent::FAILED_MESSAGE
                ], 422);
            }
            $_POST = json_decode($json, true);
        }elseif(app()->runningInConsole()){
            $_POST['id'] = $request->input('id');
            $_POST['comments'] = $request->input('comments');
            $_POST['password'] = self::APP_PASSWORD;
        }

        /* Check Each Input Variable if Present */
        foreach($this->input_variables as $key){
            if(DataValidationHelper::missing_post($key) or !$key)
            {
                $this->message = 'Missing key/value for "'. $key . '"';
                return response()->json([
                    'message' => $this->message, 
                    'message_status' => parent::FAILED_MESSAGE
                ], 422);
            }
        }

        /* Validate ID and Password */
        if(strtoupper($_POST['password']) != self::APP_PASSWORD)
        {
            $this->message = 'Invalid password';
            return response()->json([
                'message' => $this->message, 
                'message_status' => parent::FAILED_MESSAGE
            ], 401);
        }

        if(!is_numeric($_POST['id']))
        {   
            $this->message = 'Invalid id';
            return response()->json([
                'message' => $this->message, 
                'message_status' => parent::FAILED_MESSAGE
            ], 422);
        }

        
    }
}
