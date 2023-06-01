<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

function Breadcrump($key)
{
    $breadcrump = array(
        "backend" => "Admin",
        "create" => "Oluştur",
        "edit" => "Düzenle",
        "categories" => "Kategoriler",
        "products" => "Ürünler",
        "managements" => "Yöneticiler",
        "announcements" => "Duyurular",
        "pages" => "Sayfalar",
        "sliders" => "Slaytlar",
        "popups" => "Popuplar",
        "notifications" => "Bildirimler",
        "roles" => "Yetkiler",
    );
    return $breadcrump[$key] ?? null;
}

if (!function_exists('str_slug_tr')) {
    function str_slug_tr($str)
    {
        if (is_array($str)) {
            $str = implode(' ', $str);
        }

        $str = str_replace(
            ['Ö', 'ö', 'Ü', 'ü', 'Ş', 'ş', 'I', 'ı', 'İ'],
            ['O', 'o', 'U', 'u', 'S', 's', 'i', 'i', 'i'],
            $str
        );

        return Str::slug($str);
    }
}


if (!function_exists('str_replace_dynamic')) {
    function str_replace_dynamic(array $replace, $string)
    {
        return str_replace(array_keys($replace), array_values($replace), $string);
    }
}
if (!function_exists('generate_string')) {

    /*
     * @param int $length
     *
     * @return string
     * */

    function generate_string($length = 10): string
    {
        $range = 60;
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';

        $random_string = '';

        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, $range)];
        }

        return $random_string;
    }
}

if (!function_exists('date_to_path')) {
    /**
     * returns true if number is mobile phone
     * @param number string
     * @return string
     * */
    function date_to_path($date = null)
    {
        if ($date) {
            return Carbon::make($date)->format('Y/m/d');
        } else {
            return Carbon::now()->format('Y/m/d');
        }
    }
}

if (!function_exists('output')) {

    /**
     * returns function status and data
     * @param param array
     * @return array
     * */
    function output($param)
    {
        $statusArr = [1 => "success", -1 => "exception", 0 => "error"];
        $exceptionClassArr = ["exception" => "\Exception", "error" => "App\Exceptions\ApplicationErrorException"];
        $statusCodeArr = [1 => 200, -1 => 500, 0 => 400];
        $param["status"] = $param["status"] ?? 1;
        $status = $statusArr[$param["status"]] ?? "success";
        $statusCode = $statusCodeArr[$param["status"]] ?? 200;
        $message = ($param['message'] ?? '');
        $data = ($param['data'] ?? '');
        $exceptionClass = isset($exceptionClassArr[$status]) ? new $exceptionClassArr[$status]($message) : null;
        return ['status' => $status, 'message' => $message, 'data' => $data, 'statusCode' => $statusCode, "exceptionClass" => $exceptionClass];
    }
}

if (!function_exists('fillOnUndefined')) {

    function fillOnUndefined($variable, $index = null, $fillWith = null, $arrayDelimiter = ".")
    {
        if (!$arrayDelimiter) {
            return null;
        }


        if (!$index && $index !== '0' && $index !== 0) {
            return false;
        }

        $indexes = explode($arrayDelimiter, $index);

        $arrayDeep = $variable;

        foreach ($indexes as $perIndex) {
            if (!isset($arrayDeep[$perIndex])) {
                return $fillWith;
            }

            $arrayDeep = $arrayDeep[$perIndex];
        }


        return $arrayDeep;

    }
}

if (!function_exists('generateOrderNumber')) {
    function generateOrderNumber()
    {
        $dateString = time();
        $branchNumber = rand(100, 999);
        $generatedNumber = $branchNumber . substr($dateString, -7);
        $haveNumber = \App\Models\Order::where('tracking_number', $generatedNumber)->count();
        if ($haveNumber) {
            $generatedNumber = generateOrderNumber();
        }
        return $generatedNumber;
    }
}

if (!function_exists('generateTrackingNumber')) {
    function generateTrackingNumber()
    {
        return generateOrderNumber() . '-' . md5(uniqid());
    }
}

if (!function_exists('toDbDate')) {
    function toDBDate($date)
    {
        $date = str_replace('/', '.', $date);
        return isset($date) ? Carbon::createFromFormat('m.d.Y', $date)->format('Y-m-d') : null;
    }
}
if (!function_exists('convertDbDate')) {
    function convertDbDate($date)
    {
        return implode('-', array_reverse(explode('/', $date)));
    }
}
if (!function_exists('toHumanDate')) {
    function toHumanDate($date)
    {
        return isset($date) ? date('d/m/Y', strtotime($date)) : null;
    }

}
if (!function_exists('thumbnailLink')) {
    function thumbnailLink($imageName, $width, $height)
    {
        $name = explode('.', $imageName);
        $rename = $name[0] . "_" . $width . "x" . $height . "." . end($name);
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $rename)) {
            return $rename;
        }
        return $rename;
    }
}
if (!function_exists('thumbnailLinkCdn')) {
    function thumbnailLinkCdn($imageName, $width, $height)
    {
        $explode = explode('/', $imageName);

        $name = end($explode);
        $path = config('core.domains.cdn') . "/storage/uploads/product/";
        $exploded = explode('.', $name);
        $extension = end($exploded);
        $newName = $exploded[0] . "_" . $width . "x" . $height . "." . $extension;
        return $path . $newName;


    }
}
if (!function_exists('apiResponse')) {
    function apiResponse($status = -1, $message = "", $data = [], $statusCode = null, $errorCode = null)
    {

        $genericMessage = "Bilinmeyen Bir Hata Oluştu";
        $error = $status <= 0 ? true : false;
        $statusCode = $statusCode ? $statusCode : 200;
        $message = $status != -1 ? $message : $genericMessage;
        $message = $message ? $message : null;
        $data = $data && is_array($data) ? $data : [];

        $responseData =
            [
                "status" => $statusCode,
                "error" => $error,
                "errorCode" => $errorCode,
                "message" => $message,
                "data" => $data
            ];

        return response()->json($responseData, $statusCode);
    }
};


if (!function_exists('toDbDateTime')) {
    function toDbDateTime($date)
    {
        $date = str_replace('/', '.', $date);
        $date = str_replace('-', '.', $date);

        return isset($date) ? Carbon::createFromFormat('d.m.Y H:i', $date)->format('Y-m-d H:i') : null;
    }
}

if (!function_exists('toHumanDateTime')) {
    function toHumanDateTime($date)
    {
        return isset($date) ? date('d-m-Y H:i', strtotime($date)) : null;
    }

}

if (!function_exists('toApiDateTime')) {
    function toApiDateTime($date)
    {
        return isset($date) ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i') : null;
    }

}

if (!function_exists('toDbDateFromTr')) {
    function toDbDateFromTr($date)
    {
        $date = str_replace('/', '.', $date);
        return isset($date) ? Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d') : null;
    }

}

if (!function_exists('toApiDateTimeLocalized')) {
    function toApiDateTimeLocalized($date)
    {
        return isset($date) ? Carbon::createFromFormat('Y-m-d H:i:s', $date)->setTimezone('Europe/Istanbul')->format('d/m/Y H:i') : null;
    }

}

if (!function_exists('ccMasking')) {
    function ccMasking($number, $maskingCharacter = '*')
    {
        return substr($number, 0, 6) . str_repeat($maskingCharacter, strlen($number) - 10) . substr($number, -4);
    }
}


if (!function_exists('getCookieId')) {
    function getCookieId()
    {
        if (Cookie::has('visitorCookieId')) {
            $visitorCookieId = Cookie::get('visitorCookieId');
        } else {
            $visitorCookieId = generate_string(32);
            Cookie::queue('visitorCookieId', $visitorCookieId);
        }

        return $visitorCookieId;
    }
}
if (!function_exists('firstLetter')) {

    function firstLetter($nameSurname)
    {
        $bol = explode(" ", $nameSurname);
        $name = $bol[0];
        $surname = $bol[1];
        $x = substr($name, 1);
        $nameFirstLetter = str_replace($x, "", $name);
        $y = substr($surname, "1");
        $surnameFirstLetter = str_replace($y, "", $surname);
        return "$nameFirstLetter" . "$surnameFirstLetter";
    }
}

if (!function_exists('generateLinkShortCode')) {
    function generateLinkShortCode()
    {
        $dateString = time();
        $branchNumber = rand(100, 999);
        $generatedNumber = $branchNumber . substr($dateString, -7);
        $haveNumber = \App\Models\PaymentLink::where('short_code', $generatedNumber)->count();
        if ($haveNumber) {
            $generatedNumber = generateLinkShortCode();
        }
        return $generatedNumber;
    }
}

if (!function_exists('generateOrderId')) {
    function generateOrderId()
    {
        $dateString = time();
        $branchNumber = rand(11, 99);
        $generatedNumber = $branchNumber . substr($dateString, -7);
        $haveNumber = \App\Models\Payment::where('order_id', $generatedNumber)->count();
        if ($haveNumber) {
            $generatedNumber = generateOrderId();
        }
        return $generatedNumber;
    }
}

if (!function_exists('ccMasking')) {
    function ccMasking($number, $maskingCharacter = '*')
    {
        return substr($number, 0, 6) . str_repeat($maskingCharacter, strlen($number) - 10) . substr($number, -4);
    }
}

if (!function_exists('rip_tags')) {
    function rip_tags($string) {

        // ----- remove HTML TAGs -----
        $string = preg_replace ('/<[^>]*>/', ' ', $string);

        // ----- remove control characters -----
        $string = str_replace("\r", '', $string);    // --- replace with empty space
        $string = str_replace("\n", ' ', $string);   // --- replace with space
        $string = str_replace("\t", ' ', $string);   // --- replace with space

        // ----- remove multiple spaces -----
        $string = trim(preg_replace('/ {2,}/', ' ', $string));

        return $string;

    }
}
