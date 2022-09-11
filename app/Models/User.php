<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'comments'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const SUCCESS_MESSAGE = "success";
    public const FAILED_MESSAGE = "failed";
    public const SYSTEM_ERROR_MESSAGE = "Something Went Wrong! Please Contact Developer.";

    public function append_user_comments($id, $comments){
        try{
            $user = User::select(['comments'])->where('id',$id)->first();
            if(!empty($user))
            {
                $user->comments .= "\n".$comments;
                User::where('id',$id)->update([
                    "comments" => $user->comments
                ]);
            }else{
                $message = "No Such User (" . $id . ")";

                return response()->json([
                    'message' => $message,
                    'message_status' => self::FAILED_MESSAGE
                ], 404);
            }
        }catch(\Exception $e){
            return response()->json([
                'message' => self::SYSTEM_ERROR_MESSAGE,
                'message_status' => self::FAILED_MESSAGE
            ], 500);
        }
    }

    public function get_user_by_id($id){
        try{
            $result = User::select(['id','name','comments'])->where('id',$id)->first();
            if(!empty($result))
            {
                $message = "Success Fully Retrived Record!";

                return response()->json([
                    'message' => $message,
                    'message_status' => self::SUCCESS_MESSAGE,
                    'data' => $result
                ], 200);
            }else{
                $message = "No Such User (" . $id . ")";

                return response()->json([
                    'message' => $message,
                    'message_status' => self::FAILED_MESSAGE
                ], 404);
            }
        }catch(\Exception $e){
            
            return response()->json([
                'message' => self::SYSTEM_ERROR_MESSAGE,
                'message_status' => self::FAILED_MESSAGE
            ], 500);
        }
    }
}
