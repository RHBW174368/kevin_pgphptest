<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataValidationHelper extends Controller
{
    public static function apidie($string, $code = 200){
        $string .= "";
        http_response_code($code);
        if(defined('SCRIPT') && SCRIPT)
            throw new Exception($string);
        die($string);
    }

    public static function missing_request($field){
        return (!isset($_REQUEST[$field]) or !$_REQUEST[$field]);
    }

    public static function missing_post($field){
        return (!isset($_POST[$field]) or !$_POST[$field]);
    }

    public static function missing_get($field){
        return (!isset($_GET[$field]) or !$_GET[$field]);
    }

    public static function is_json($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
    
    public function contains($haystack, $needle, $case_sensitive = true){
        if(!$case_sensitive)
            return (strpos(strtolower($haystack), strtolower($needle)) !== FALSE);
        return (strpos($haystack, $needle) !== FALSE);
    }

    public function startswith($haystack, $needle, $case_sensitive = true){
        if(!$case_sensitive)
            return (strpos(strtolower($haystack), strtolower($needle)) === 0);
        return (strpos($haystack, $needle) === 0);
    }
}
