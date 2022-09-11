<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public const SUCCESS_MESSAGE = "success";
    public const FAILED_MESSAGE = "failed";
    public const SYSTEM_ERROR_MESSAGE = "Something Went Wrong! Please Contact Developer.";
}
