<?php

namespace App\Lib;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use GuzzleHttp\Client;
use Exception;
use JWTAuth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;


class MyHelper
{
    public static function login($request)
    {
        $credentials = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password')
        ];

        if (auth()->attempt($credentials)) {
            $admin = auth()->user();
            $token = JWTAuth::fromUser($admin);
            $admin['token'] = $token;
            $data = $admin->toArray();
            return  [
                'status' => 'success',
                'data' => $data
            ];
        } else {
            return ['status' => 'FAILED', 'messages' => "User not found"];
        }
    }

    public static function renderMenu($allMenu = null, &$hasActive = false, &$hasChildren = false)
    {
        $menuHtml = '';
        $hasActive = false;
        $hasChildren = false;
        if (is_null($allMenu)) {
            $allMenu = config('menu.sidebar');
        }

        foreach ($allMenu as $menu) {
            /** Feature Management
                if ($menu['required_configs'] ?? false) {
                    $menu['required_configs_rule'] = $menu['required_configs_rule'] ?? 'or';
                    if ($menu['required_configs_rule'] == 'and') {
                        foreach ($menu['required_configs'] as $configId) {
                            if (!MyHelper::hasAccess([$configId], session('configs'))) {
                                continue;
                            }
                        }
                    } else {
                        if (!MyHelper::hasAccess($menu['required_configs'], session('configs'))) {
                            continue;
                        }
                    }
                }

                if ($menu['required_features'] ?? false) {
                    $menu['required_features_rule'] = $menu['required_features_rule'] ?? 'or';
                    if ($menu['required_features_rule'] == 'and') {
                        foreach ($menu['required_features'] as $featureId) {
                            if (!MyHelper::hasAccess([$featureId], session('granted_features'))) {
                                continue;
                            }
                        }
                    } else {
                        if (!MyHelper::hasAccess($menu['required_features'], session('granted_features'))) {
                            continue;
                        }
                    }
                }
             */

            if (!session('is_super_admin')) {
                if ($menu['required_features'] ?? false) {
                    if (!MyHelper::hasAccess($menu['required_features'], session('granted_features'))) {
                        continue;
                    }
                }
            }

            $url = $menu['url'] ?? '';
            if (substr($url, 0, 4) == 'http') {
                $url = $menu['url'];
            } else {
                $url ??= '';
                $url = $url ? url($url) : 'javascript:void(0)';
            }
            // $url = substr($menu['url'] ?? '', 0, 4) == 'http' ? $menu['url'] : ($menu['url'] ?? '') ? url($menu['url']) : 'javascript:void(0)'; //php v7
            $icon = ($menu['icon'] ?? '') ? '<span class="menu-icon"><i class="' . $menu['icon'] . ' fs-2"></i></span>' : '<span class="menu-bullet"><span class="bullet bullet-dot"></span></span>';

            switch ($menu['type'] ?? 'single') {
                case 'tree':
                    // $submenu = '<li class="nav-item %active%"><a href="' . $url . '" class="nav-link nav-toggle">' . $icon . '<span class="title">' . $menu['label'] . '</span><span class="arrow %active%"></span></a><ul class="sub-menu">';
                    $submenu = '
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion %active%">
                                    <span class="menu-link">
                                        ' . $icon . '
                                        <span class="menu-title">' . $menu['label'] . '</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion">
                            ';


                    $submenu .= static::renderMenu($menu['children'], $subActive, $subAvailable);

                    $submenu = str_replace('%active%', $subActive ? 'here show' : '', $submenu);

                    $submenu .= '
                                    </div>
                                </div>
                            ';

                    if ($subAvailable) {
                        if ($subActive) {
                            $hasActive = true;
                        }
                        $menuHtml .= $submenu;
                    }
                    break;

                case 'group':
                    $submenu = '';
                    if ($menu['label'] ?? false) {
                        $submenu .= static::renderMenu([['type' => 'heading', 'label' => $menu['label']]], $subActive, $subAvailable);
                    }
                    $submenu .= static::renderMenu($menu['children'] ?? [], $subActive, $subAvailable);
                    if ($subAvailable) {
                        if ($subActive) {
                            $hasActive = true;
                        }
                        $menuHtml .= $submenu;
                    }
                    break;

                case 'heading':
                    // $menuHtml .= '<li class="heading" style="height: 50px;padding: 25px 15px 10px;"><h3 class="uppercase" style="color: #000;font-weight: 600;">' . $menu['label'] . '</h3></li>';
                    $menuHtml .= '<div class="menu-item pt-5">
                                        <div class="menu-content">
                                            <span class="menu-heading fw-bold text-uppercase fs-7">' . $menu['label'] . '</span>
                                        </div>
                                    </div>';
                    break;

                default:
                    if (!($menu['active'] ?? false)) {
                        $menu['active'] = 'request()->path() == ($menu["url"]??"")';
                    }
                    $active = ($menu['active'] ?? false) ? (eval('return ' . $menu['active'] . ';') ? 'active open' : '') : '';
                    if ($active) {
                        $hasActive = true;
                    }
                    // $menuHtml .= '<li class="nav-item ' . $active . '"><a href=" ' . $url . ' " class="nav-link">' . $icon . '<span class="title">' . ($menu['label'] ?? 'YAYAYA') . '</span></a></li>';
                    $menuHtml .= '
                                    <div class="menu-item">
                                        <a class="menu-link ' . $active . '" href="' . $url . '" >
                                            ' . $icon . '
                                            <span class="menu-title">'  . ($menu['label'] ?? '') .  '</span>
                                        </a>
                                    </div>
                                ';
                    break;
            }
        }
        if ($menuHtml) {
            $hasChildren = true;
        }
        return $menuHtml;
    }

    public static function hasAccess($granted, $features)
    {
        foreach ($granted as $g) {
            if (!is_array($features)) {
                $features = session('granted_features');
            }
            if (in_array($g, $features)) {
                return true;
            }
        }

        return false;
    }

    public static function extractToken($bearer_token)
    {
        $access_token = str_replace('Bearer ', '', $bearer_token);
        $token = new \Tymon\JWTAuth\Token($access_token);
        $decoded_token = JWTAuth::decode($token);

        return $decoded_token;
    }

    public static function uploadFile($file, $root_path, $path, $filename = "")
    {
        try {
            try {
                $ext = $file->getClientOriginalExtension();
                if ($filename == "") {
                    $filename = $file->getClientOriginalName();
                } else {
                    $filename = $filename . '.' . $ext;
                }

                $full_path = $root_path . "/" . $path . '/' . $filename;

                $save = Storage::disk(config('filesystems.default'))->put($full_path, file_get_contents($file), 'public');
                // $save = Storage::disk(config('filesystems.default'))->put($full_path, fread(fopen($file, "r"), filesize($file)), 'public'); // video cannot upload
                if ($save) {
                    return [
                        "path" => $full_path,
                        "file_name" => $filename
                    ];
                } else {
                    throw new Exception('Failed to store file!');
                }
            } catch (Exception $error) {
                throw new Exception($error->getMessage());
            }
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public static function createFilename(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace("." . $extension, "", $file->getClientOriginalName()); // Filename without extension

        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time());

        return $filename;
    }

    public static function deleteImageNotExist($path, $image_list = [])
    {
        if (!empty($image_list)) {
            // Get all files in the folder
            $files = Storage::files($path);
            // Loop through each file in the folder
            foreach ($files as $file) {
                // If the file is not in the array of filenames, delete it
                if (!in_array($file, $image_list)) {
                    Storage::delete($file);
                }
            }
        }
    }

    public static function format_number($value, $digit_after = 0)
    {
        return number_format($value, $digit_after, ',', '.');
    }

    public static function errorMessage($response)
    {
        if (isset($response['status']) && $response['status'] == "error" && !(app()->environment('production'))) {
            return $response['message'];
        }
        return 'Something went wrong!';
    }

    public static function formatGolangDate($timestamp)
    {
        // Split the timestamp into its components
        list($date, $time, $timezoneAbbreviation) = preg_split('/\s+/', $timestamp);

        // Create a DateTime object with the date and time
        $dateTime = new DateTime("$date $time");

        // Format the date and time part
        $formattedDate = $dateTime->format('Y-m-d\TH:i:s.u');

        switch ($timezoneAbbreviation) {
            case 'WIB':
                $offsetTime = "+07:00";
                break;

            case 'WITA':
                $offsetTime = "+08:00";
                break;

            case 'WIT':
                $offsetTime = "+09:00";
                break;

            default:
                $offsetTime = "+00:00";
                break;
        }

        // Combine the formatted date, time, and timezone abbreviation
        $formattedTimestamp = $formattedDate . $offsetTime;

        return $formattedTimestamp;
    }

    public static function reverseToPeriod($date, $timeZone)
    {
        $dateTime = \Carbon\Carbon::parse($date);

        if (empty($timeZone)) {
            $timeZone = "WIB";
        }

        // Map the 'time_zone' values to their respective time zones
        $timeZoneMap = [
            'WIB' => 'Asia/Jakarta',
            'WITA' => 'Asia/Makassar',
            'WIT' => 'Asia/Jayapura',
        ];

        // Set the time zone based on the 'time_zone' value
        $dateTime->setTimezone($timeZoneMap[$timeZone]);

        // Format the promo start and end times
        $formattedDateTime = $dateTime->format('d/m/Y h:i A');

        return $formattedDateTime;
    }

    public static function grantedFeature($feature_id)
    {
        if (in_array($feature_id, session('granted_features') ?? []) || session('is_super_admin')) {
            return true;
        } else {
            return false;
        }
    }

    public static function limitString($string, $length)
    {
        $limitedString = substr($string, 0, $length);
        if (strlen($string) > $length) {
            $limitedString .= '...'; // Tambahkan tanda elipsis
        }
        return $limitedString;
    }

    public static function getValueDay($array, $day)
    {
        $foundElement = null;
        foreach ($array as $element) {
            if ($element['day'] == $day) {
                $foundElement = $element;
                break;
            }
        }
        return $foundElement;
    }

    public static function declaredPeriod($period)
    {
        list($startStr, $endStr) = explode(" - ", $period);
        $startDateTime = date_create_from_format('d/m/Y h:i A', $startStr);
        $endDateTime = date_create_from_format('d/m/Y h:i A', $endStr);
        $timeStart = date_format($startDateTime, 'Y-m-d H:i');
        $timeEnd = date_format($endDateTime, 'Y-m-d H:i');
        return [
            'start' => $timeStart,
            'end' => $timeEnd
        ];
    }


    public static function dateTimeLocal($date = '')
    {
        if (empty($date)) {
            return '-';
        }
        $BulanIndo = array(
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        );
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl   = substr($date, 8, 2);
        $jam = date('H:i', strtotime($date));
        $result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun . " " . $jam . ' WIB';
        return ($result);
    }

    public static function formatDate($time, $timeZone = 'WIB')
    {
        $carbonDate = Carbon::parse($time);

        $timeZoneMap = [
            'WIB' => 'Asia/Jakarta',
            'WITA' => 'Asia/Makassar',
            'WIT' => 'Asia/Jayapura',
        ];

        $formattedDate = $carbonDate->setTimezone($timeZoneMap[$timeZone])->format('d F Y H:i');

        return $formattedDate;
    }

    public static function encrypt($id){
        $uuid = (string) \Str::uuid();
        $encodedId = sprintf("%08x", $id);
        return substr_replace($uuid, $encodedId, 24, 8);
    }

    public static function decrypt($uuid){
        $hexId = substr($uuid, 24, 8);
        return hexdec($hexId);
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function uploadFileCms(UploadedFile $file, string $directory, ?string $oldFile = null): array
    {
        if ($oldFile && Storage::disk('public')->exists($directory . '/' . $oldFile)) {
            Storage::disk('public')->delete($directory . '/' . $oldFile);
        }

        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($directory, $fileName, 'public');

        return ['path' => $filePath, 'name' => $fileName];
    }
}
