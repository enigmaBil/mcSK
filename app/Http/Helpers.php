<?php
/**
 * Created by PhpStorm.
 * User: teukapmaths
 * Date: 09/11/2017
 * Time: 12:40
 */

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

// check user role
if (!function_exists('checkCredential')) {
    /**
     * @param $role
     * @return bool
     */
    function checkCredential($role)
    {
        $user = \Auth::user();
        $response = false;
        toggleDatabase(false);
        $profile = \DB::table('profile')->where('id', $user->profile_id)->first();

        if($user->profile_id == $profile->id && $profile->role == $role){
            $response = true;
        }

     return $response;
    }
}
// get appreciation 

if (!function_exists('getAppreciation')) {
     /**
     * @param $note
     * @return string
     */
    function getAppreciation($note)
    {
        if($note<=2){
            return 'null';
        }
        else if($note <= 6 && $note >=3){
            return 'tresFaible';
        }else if($note <= 7 && $note >=6){
            return 'faible';
        }else if($note <= 8 && $note >=7){
            return 'insuffisant';
        }
        else if($note <= 9 && $note >=8){
            return 'mediocre';
        }
        else if($note < 12 && $note >=10){
            return 'passable';
        }
        else if($note <14 && $note >=12){
            return 'ab';
        }
        else if($note <16 && $note >=14){
            return 'bien';
        }
        else if($note <18 && $note >=16){
            return 'TB';
        }
        else if($note <20 && $note >=18){
            return 'excellent';
        }
        else if($note ==20){
            return 'parfait';
        }
    }
}

//Switching database function

if (!function_exists('toggleDatabase')) {
    function toggleDatabase($isClientDatabase = true)
    {
        if ($isClientDatabase) {
            $user = \Auth::user();
            if ($user):
                $institution = \DB::table('institution')->where('id', $user->institution_id)->first();
                $settings = json_decode($institution->settings);

                config()->set('database.connections.mobility', [
                    'driver' => 'mysql',
                    'host' => env('DB_HOST', '127.0.0.1'),
                    'port' => env('DB_PORT', '3306'),
                    'database' => $settings->db->database,
                    'username' => $settings->db->username,
                    'password' => $settings->db->password,
                    'unix_socket' => env('DB_SOCKET', ''),
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'prefix' => '',
                    'strict' => false,
                    'engine' => null,
                ]);

                $connection = \DB::connection('mobility');
                \DB::purge(config('database.default'));
                \DB::setDefaultConnection($connection->getName());
            else:
                $connection = null;
            endif;
        } else {
            $connection = \DB::connection('mysql');
            \DB::purge(config('database.default'));
            \DB::setDefaultConnection($connection->getName());
        }

        return $connection;
    }
}

if (!function_exists('classActivePath')) {
    /**
     * Best practice for handling "active" menu item in L5
     * @param $paths
     * @return string
     */
    function classActivePath($paths)
    {

        if (is_array($paths)) {
            $flag = true;
            foreach ($paths as $path) {
                $path = explode('.', $path);
                $segment = 2;
                $flag = true;

                foreach ($path as $p) {
                    $flag = $flag && (request()->segment($segment) == $p);
                    $segment++;
                }

                if ($flag) break;
            }

            return $flag ? 'menu-open' : '';
        } else {
            $paths = explode('.', $paths);
            $segment = 2;
            foreach ($paths as $p) {
                if ((request()->segment($segment) == $p) == false) {
                    return '';
                }
                $segment++;
            }

            return 'menu-open';
        }

    }
}

if (!function_exists('_encrypt')) {
    function _encrypt($string)
    {
        $key = config('mobility.cypher-key');//key to encrypt and decrypts.
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }

        return urlencode(base64_encode($result));
    }
}

if (!function_exists('_decrypt')) {
    function _decrypt($string)
    {
        $key = config('mobility.cypher-key');//key to encrypt and decrypts.
        $result = '';
        $string = base64_decode(urldecode($string));
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }
        return $result;
    }
}

if (!function_exists('_flush')) {
    function _flush($table, $field)
    {
        return str_slug($table . config('app.name')) . '_' . $field;
    }
}

if (!function_exists('_unflush')) {
    function _unflush($table, $inputs)
    {
        $fields = [];
        $code = str_slug($table . config('app.name')) . '_';

        foreach ($inputs as $field => $value) {
            $tmp = explode($code, $field);
            if ($tmp && isset($tmp[1])) $fields[$tmp[1]] = $value;
        }
        return $fields;
    }
}

if (!function_exists('removeNamespaceFromXML')) {
    function removeNamespaceFromXML($xml)
    {
        // Because I know all of the the namespaces that will possibly appear in
        // in the XML string I can just hard code them and check for
        // them to remove them
        $toRemove = ['rap', 'turss', 'crim', 'cred', 'j', 'rap-code', 'evic'];
        // This is part of a regex I will use to remove the namespace declaration from string
        $nameSpaceDefRegEx = '(\S+)=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?';

        // Cycle through each namespace and remove it from the XML string
        foreach ($toRemove as $remove) {
            // First remove the namespace from the opening of the tag
            $xml = str_replace('<' . $remove . ':', '<', $xml);
            // Now remove the namespace from the closing of the tag
            $xml = str_replace('</' . $remove . ':', '</', $xml);
            // This XML uses the name space with CommentText, so remove that too
            $xml = str_replace($remove . ':commentText', 'commentText', $xml);
            // Complete the pattern for RegEx to remove this namespace declaration
            $pattern = "/xmlns:{$remove}{$nameSpaceDefRegEx}/";
            // Remove the actual namespace declaration using the Pattern
            $xml = preg_replace($pattern, '', $xml, 1);
        }

        // Return sanitized and cleaned up XML with no namespaces
        return $xml;
    }
}

if (!function_exists('namespacedXMLToArray')) {
    function namespacedXMLToArray($xml)
    {
        // One function to both clean the XML string and return an array
        return json_decode(json_encode(simplexml_load_string(removeNamespaceFromXML($xml))), true);
    }
}


if (!function_exists('dateFormat')) {
    function dateFormat($date, $format) {
        if(!$date) return null;
        return date($format, strtotime($date));
    }
}

use Illuminate\Support\Collection;

if (!function_exists('mergeCollection')) {
    function mergeCollection(Collection $collection1, Collection $collection2)
    {
        $collection = new Collection;
        foreach ($collection1 as $item) $collection->push($item);
        foreach ($collection2 as $item) $collection->push($item);
        return $collection;
    }
}

if (!function_exists('mob_url')) {
    function mob_url($path = '/')
    {
        $env = app()->environment();
        if ($env == 'pre-production' || $env == 'production' || $env == 'development' || $env == 'test') {
            return secure_url($path);
        } else if ($env == 'local') {
            return url()->to($path);
        } else {
            return url($path);
        }
    }
}


if (!function_exists('mob_links')) {
    /**
     * Permet de faire passer les liens des paginations de Laravel en https lorsqu'on est en production
     * @param  String $str
     * @return String
     */
    function mob_links($str)
    {
        $env = app()->environment();
        if ($env == 'production' || $env == 'development' || $env == 'test') {
            return str_replace('http://', 'https://', $str);
        } else if ($env == 'local') {
            return $str;
        } else {
            return $str;
        }
    }
}

if (!function_exists('mob_route')) {
    function mob_route($name, $parameters = [])
    {
        $env = app()->environment();
        if ($env == 'production' || $env == 'development' || $env == 'test') {
            $route = route($name, $parameters);
            if (strpos($route, 'https://') !== false) {
                return $route;
            } else {
                return str_replace('http://', 'https://', $route);
            }
        } else if ($env == 'local') {
            return route($name, $parameters);
        } else {
            return route($name, $parameters);
        }
    }
}

if (!function_exists('mob_asset')) {
    function mob_asset($name)
    {
        $env = app()->environment();
        if ($env == 'production' || $env == 'development' || $env == 'test') {
            $asset = asset($name);
            if (strpos($asset, 'https://') !== false) {
                return $asset;
            } else {
                return str_replace('http://', 'https://', $asset);
            }
        } else if ($env == 'local') {
            return asset($name);
        } else {
            return asset($name);
        }
    }
}

if (!function_exists('countByParameter')) {
    function countByParameter($tableName, $parameter)
    {
        toggleDatabase(true);
        return \DB::table($tableName)->where($parameter)->count();
    }
}


if (!function_exists('mobDateFormat')) {
    /**
     * This function alows you to format the date to rend to the views depending on the user language config. Exple 09-12-2018 for french
     * @param String $date . The date to format coming to the database
     * @param String $format . Optional. The format at which you want date should be returned
     * @return String
     */
    function mobDateFormat($date, $format = null)
    {
        if ($date) {
            $local = \App::getLocale();
            $format_ = is_null($format) ? getDateFormat() : $format;
            $carbonDate = \Carbon\Carbon::parse($date);
            return is_null($date) ? '' : $carbonDate->format($format_);
        }
        return '';
    }
}

if (!function_exists('mobDateToString')) {
    /**
     * Allows to translate a date carbon instance into a string understandable by humans. Exple 10, February 2018
     * @param  Carbon\Carbon $date The date to translate
     * @return  String
     * @todo  Gérer plus efficacement la traduction en français (en utlisant les méthodes de Carbon)
     */
    function mobDateToString($date)
    {
        if (is_null($date))
            return '';

        $local = \App::getLocale();
        \Carbon\Carbon::setLocale($local);
        $carbonDate = \Carbon\Carbon::parse($date);
        if ($local == 'fr') {
            $days = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];
            $months = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novemebre', 'Décembre'];

            $date = $days[intval($carbonDate->dayOfWeek)] . ', ' . $carbonDate->format('d') . ' ' . $months[intval($carbonDate->format('m')) - 1] . ' ' . $carbonDate->format('Y');
            return $date;
        }

        return $carbonDate->format('D, d F Y');
    }
}

if (!function_exists('getDateFormat')) {
    /**
     * Allows to get the Date format to use depending on the user language
     * @return  String
     */
    function getDateFormat()
    {
        return config('mobility.date-format.' . \App::getLocale());
    }
}

if (!function_exists('momoSetting')) {
    function momoSetting($setting, $type, $param = null)
    {
        $bool = isset($setting->momo->type) && $type == $setting->momo->type;
        if ($param) {
            return $bool ? $setting->momo->{$param} : null;
        }
        return $bool;
    }
}

if (!function_exists('mobParseDate')) {
    /**
     * This helper allows you to parse a string date into a carbon date instance
     * @param  String $date The date string to parse
     * @param Boolean $toString Whether you want the helper to return a string in the database format or not
     * @param  String $fromFormat The format at wich string date comes with
     * @return \Carbon\Carbon | String dependin on $toString parameter
     */
    function mobParseDate($date, $toString = true, $fromFormat = null)
    {
        $format = is_null($fromFormat) ? getDateFormat() : $fromFormat;
        $carbonDate = \Carbon\Carbon::createFromFormat($format, $date);
        return $toString ? $carbonDate->format(config('mobility.date-format.db')) : $carbonDate;
    }
}

if (!function_exists('getDateTimePickerFormat')) {
    /**
     * This helper retrieves the right format datetimepicket.js plugin should use depending on the user language config inorder to save to the database without problem
     * @return String.
     */
    function getDateTimePickerFormat()
    {
        return config('mobility.date-format.datetime-picker.' . \App::getLocale());
    }
}

if (!function_exists('mob_amount_round')) {
    function mob_amount_round($amount, $currency = "default")
    {
        $precision = config('mobility.precision.' . $currency);
        return round($amount, $precision);
    }
}

if (!function_exists('mob_round_value')) {
    function mob_round_value($amount,$precision)
    {
        return number_format((float)$amount, $precision, '.', ' ');
    }
}

if (!function_exists('mob_get_precision')) {
    function mob_get_precision()
    {
        //$precision = config('mobility.precision.' . $currency);
        $prec = \DB::table('general_config')
            ->select('value')
            ->where('name', '=', 'DECIMAL_LENGHT')
            ->get()
            ->toArray();

        $precision = $prec[0]->value;

        return $precision;
    }
}

if (!function_exists('build_name_for_automation')) {
    /**
     * @param $name
     * @param $length
     * @param string $sep
     * @return string
     */
    function build_name_for_automation($name, $length, $sep = '-', $flag = false)
    {
        if ($flag) {
            return str_slug(substr($name, 0, $length), $sep);
        }

        $result = [];
        $name = trim($name);
        $names = explode(" ", $name);
        $ln = count($names);
        if ($ln > 1) {
            $ex = (int)$length / $ln;
            foreach ($names as $name) {
                $result[] = substr($name, 0, $ex);
            }
            return str_slug(implode(" ", $result), $sep);
        } else {
            return str_slug(substr($name, 0, $length), $sep);
        }
    }
}


if (!function_exists('switchCompanyDatabase')) {
    function switchCompanyDatabase($company, $isClientDatabase = true)
    {
        if ($isClientDatabase) {
            $settings = json_decode($company->settings);

            config()->set('database.connections.mobility', [
                'driver' => 'mysql',
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '3306'),
                'database' => $settings->db->database,
                'username' => $settings->db->username,
                'password' => $settings->db->password,
                'unix_socket' => env('DB_SOCKET', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => false,
                'engine' => null,
            ]);

            $connection = \DB::connection('mobility');
            \DB::purge(config('database.default'));
            \DB::setDefaultConnection($connection->getName());
        } else {
            $connection = \DB::connection('mysql');
            \DB::purge(config('database.default'));
            \DB::setDefaultConnection($connection->getName());
        }

        return $connection;
    }
}


if (!function_exists('asLetters')) {
    function int2str($a, $separateur = ",")
    {
        $joakim = explode('.', $a);
        if (isset($joakim[1]) && $joakim[1] != '') {
            return int2str($joakim[0]) . ' Dirhams ' . int2str($joakim[1]) . ' Centimes.';
        }

        if ($a < 0) return 'moins ' . int2str(-$a);
        if ($a < 17) {
            switch ($a) {
                case 0:
                    return 'Zero';
                case 1:
                    return 'Un';
                case 2:
                    return 'Deux';
                case 3:
                    return 'Trois';
                case 4:
                    return 'Quatre';
                case 5:
                    return 'Cinq';
                case 6:
                    return 'Six';
                case 7:
                    return 'Sept';
                case 8:
                    return 'Huit';
                case 9:
                    return 'Neuf';
                case 10:
                    return 'Dix';
                case 11:
                    return 'Onze';
                case 12:
                    return 'Douze';
                case 13:
                    return 'Treize';
                case 14:
                    return 'Quatorze';
                case 15:
                    return 'Quinze';
                case 16:
                    return 'Seize';
            }
        } else if ($a < 20) {
            return 'dix-' . int2str($a - 10);
        } else if ($a < 100) {
            if ($a % 10 == 0) {
                switch ($a) {
                    case 20:
                        return 'Vingt';
                    case 30:
                        return 'Trente';
                    case 40:
                        return 'Quarante';
                    case 50:
                        return 'Cinquante';
                    case 60:
                        return 'Soixante';
                    case 70:
                        return 'Soixante-dix';
                    case 80:
                        return 'Quatre-vingt';
                    case 90:
                        return 'Quatre-vingt-dix';
                }
            } else if ($a < 70) {
                return int2str($a - $a % 10) . '-' . int2str($a % 10);
            } else if ($a < 80) {
                return int2str(60) . '-' . int2str($a % 20);
            } else {
                return int2str(80) . '-' . int2str($a % 20);
            }
        } else if ($a == 100) {
            return 'Cent';
        } else if ($a < 200) {
            return int2str(100) . ($a % 100 != 0 ? ' ' . int2str($a % 100) : '');
        } else if ($a < 1000) {
            return int2str((int)($a / 100)) . ' ' . int2str(100) . ' ' . ($a % 100 != 0 ? int2str($a % 100) : '');
        } else if ($a == 1000) {
            return 'Mille';
        } else if ($a < 2000) {
            return int2str(1000) . ($a % 1000 != 0 ? ' ' . int2str($a % 1000) : '');
        } else if ($a < 1000000) {
            return int2str((int)($a / 1000)) . ' ' . int2str(1000) . ' ' . ($a % 1000 != 0 ? int2str($a % 1000) : '');
        } else if ($a == 1000000) {
            return 'Un Million';
        } else if ($a < 2000000) {
            return 'Un Million ' . int2str((int)($a % 1000000));
        } else if ($a < 1000000000) {
            return int2str((int)($a / 1000000)) . ' Millions ' . int2str((int)($a % 1000000));
        } else if ($a == 1000000000) {
            return 'Un Milliard';
        } else if ($a < 2000000000) {
            return 'Un Milliard ' . int2str((int)($a % 1000000000));
        } else if ($a < 1000000000000) {
            $partMilliard = (int)($a / 1000000000) * 1000000000;
            $secondPart = $a - $partMilliard;
            //return int2str((int)($a/1000000000)).' Milliards '.int2str((int)($a%1000000000));
            return int2str((int)($a / 1000000000)) . ' Milliards ' . int2str((int)($secondPart));
        } else return $a;
    }
}


if (!function_exists('getSetting')) {
    function getSetting(&$var, $settingName, $repository, $defaultValue = -1)
    {
        if ($repository) {
            $setting = $repository->get($settingName);
            $var = $setting ? $setting->value : $defaultValue;
        } else {
            $var = $defaultValue;
        }
    }
}


if (!function_exists('generateCode')) {
    function generateCode($prefix, $table, $tableAttribute)
    {
        toggleDatabase(true);

        try {
            // gets last inserted row
            $result = \DB::table($table)
                ->select($tableAttribute)
                ->orderBy('id', 'desc')
                ->first();
        } catch (\Exception $exception) {
            return/* dd(__('messages.table-or-column-not-exist'));*/
                back()->with('error', __('messages.table-or-column-not-exist'));
        }

        $prefixMonthYear = $prefix . date('y-m');
        $range = config("mobility.gen-length");



        if (is_null($result)) {
            $ref = $prefixMonthYear . config("mobility.gen-separator") . str_pad('', $range - 1, '0', STR_PAD_RIGHT) . '1';

        } else {
            $oldCode = $result->{$tableAttribute};
            if(!$oldCode){
                $ref = $prefixMonthYear . config("mobility.gen-separator") . str_pad('', $range - 1, '0', STR_PAD_RIGHT) . '1';

            }else{
                // collecting last inserted value with respect to given table attribute
                $oldCode = $result->{$tableAttribute};

                $newLength = strlen($prefixMonthYear);

                if ($prefixMonthYear == substr($oldCode, 0, $newLength)) {
                    // collect incremented value
                    $increment = substr($oldCode, '-' . $range) + 1;
                    $newIncrement = str_pad((int)$increment, config('mobility.gen-length'), '0', STR_PAD_LEFT);

                    $ref = $prefixMonthYear . config("mobility.gen-separator") . $newIncrement;

                } else {
                    $ref = $prefixMonthYear . config("mobility.gen-separator") . str_pad('', $range - 1, '0', STR_PAD_RIGHT) . '1';

                }
            }

        }

        return $ref;
    }
}

if (!function_exists('currentWeek')) {
    function currentWeek(){
        $lastMonday = strtotime("last monday");
        $monday = date('w', $lastMonday)==date('w') ? $lastMonday+7*86400 : $lastMonday;
        $sunday = strtotime(date("Y-m-d",$monday)." +6 days");

        $this_week_start = date("Y-m-d",$monday);
        $this_week_end = date("Y-m-d",$sunday);

        return array($this_week_start,$this_week_end);
    }
}

if (!function_exists('currentMonth')) {
    function currentMonth(){

        $start_month = date('Y-m-01');
        $end_month = date("Y-m-t", strtotime($start_month));

        return array($start_month,$end_month);
    }
}

if (!function_exists('currentYear')) {
    function currentYear(){
        $year = date("Y");
        return $year;
    }
}


if (!function_exists('mob_ucFirst')) {

    function mob_ucFirst($str, $encoding = "UTF-8", $lower_str_end = false) {
        $first_letter = strtoupper(substr($str, 0, 1));
        dd($first_letter);
        $str_end = "";
        if ($lower_str_end) {
            $str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
        } else {
            $str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
        }
        $str = $first_letter . $str_end;
        return $str;
    }

}

if (!function_exists('getTableDetailsById')) {
    function getTableDetailsById($table,$id, $state = true)
    {
        toggleDatabase($state);

        try {
            // gets last inserted row
            $result = \DB::table($table)
                                ->where('id', $id)
                                ->orderBy('id','desc')
                                ->first();
        } catch (\Exception $exception) {
            return back()->with('error', __('messages.table-or-column-not-exist'));
        }

        return $result;
    }
}

if (!function_exists('colorGeneration')) {
    function colorGeneration($length)
    {
        $colors = '["';
        $max = $length;
        $minMax = $length-1;
        $colorMin = 1;
        $colorMax = 250;

        for($i=0;$i<$max;$i++):
            if($i==$minMax){
                $colors .= 'rgba('.rand($colorMin,$colorMax).','.rand($colorMin,$colorMax).','.rand($colorMin,$colorMax).',0.6)"]';
            }else{
                $colors .= 'rgba('.rand($colorMin,$colorMax).','.rand($colorMin,$colorMax).','.rand($colorMin,$colorMax).',0.6)","';
               }
        endfor;

        return $colors;
    }
}

if (!function_exists('chartJsInputFormatter')) {
    /**
     * @param $arrayInput
     * @param $arrayOfProperties
     * @param array $arrayPropertiesWithoutQuotes
     * @param bool $withColors
     * @return string
     */
    function chartJsInputFormatter($arrayInput,$arrayOfProperties,$arrayPropertiesWithoutQuotes = [],$withColors=false)
    {

        $objectInputs = (object)$arrayInput;
        //check if object is empty
        if(empty($arrayInput)){
             return 'Empty Array given!!!';
         }

        // Verification if passed parameter is an object!!!
        if(!is_array($arrayInput)){
            return 'Array required but another format given!';
        }

        // Verification if all properties exist in the object
        $errorPropertyMessage = '';

        $lastElement = end($arrayOfProperties);

        foreach ($arrayOfProperties as $arrayOfProperty){
            if(!array_key_exists($arrayOfProperty,reset($objectInputs))){
               if($arrayOfProperty == $lastElement){
                   $errorPropertyMessage .= $arrayOfProperty;
               }else{
                   $errorPropertyMessage .= $arrayOfProperty.', ';
               }
            }
        }

        if($errorPropertyMessage != ''){
            return 'The following properties: '.$errorPropertyMessage.' are not found in the array passed!';
        }

       // dd('I will proceed because all checks ok');



          $result = '';
        $final = '';

          $propertyLimit = count($arrayOfProperties);
          $propertyIterationCount = 0;

        foreach ($arrayOfProperties as $arrayOfProperty) {
            $propertyIterationCount++;

            //Going through each property to generate a string array of it's values
            if(in_array($arrayOfProperty,$arrayPropertiesWithoutQuotes)){
                $p1 = '[';
            }else{
                $p1 = '["';

            }

            $max = count((array)$objectInputs);
            $minMax = count((array)$objectInputs)-1;
            $count = 0;

            foreach ($objectInputs as $objectInput):
                $count++;
                $temporalObject = (object)$objectInput;

                if ($count == $max) {
                    $p1 .= ']';
                } elseif ($count == $minMax) {

                    if(in_array($arrayOfProperty,$arrayPropertiesWithoutQuotes)){
                        $p1 .= $temporalObject->{$arrayOfProperty};
                    }else{
                        $p1 .= $temporalObject->{$arrayOfProperty} . '"';
                    }
                } else {

                    if(in_array($arrayOfProperty,$arrayPropertiesWithoutQuotes)){
                        $p1 .= $temporalObject->{$arrayOfProperty} . ',';
                    }else{
                        $p1 .= $temporalObject->{$arrayOfProperty} . '","';
                    }

                }

            endforeach;

            if($propertyIterationCount == $propertyLimit){
                $result .= $p1;
            }else{
                $result .= $p1.',';
            }
        }

        if($withColors){
            $colors = '["';
            $max = count((array)$objectInputs);
            $minMax = count((array)$objectInputs)-1;
            $count = 0;
            foreach ($objectInputs as $objectInput):
                $count++;
            if ($count == $max) {

                $colors .= ']';
            } elseif ($count == $minMax) {
                    $colors .= 'rgba('.rand(200,194).','.rand(180,200).','.rand(120,154).',0.6)"';
            } else {
                    $colors .= 'rgba('.rand(200,194).','.rand(180,200).','.rand(120,154).',0.6)","';
            }

           endforeach;

            $result = $result.','.$colors;
        }

      return $result;
    }
}

if (!function_exists('searchElement')){
    /**
     * @param $table
     * @param $key
     * @param null $searchColumns
     * @return array|object
     */
    function searchElement($table, $key, $constraint =null, $searchColumns = null){

        try {
            // Define table to perform search
            $tableColumns = \DB::select("SHOW COLUMNS FROM ". $table);
            $sql_search = "select * from ".$table." where ";
        } catch (\Exception $exception) {
            return (object)['status'=> 'Error 404', 'message'=>'table not found!'];
        }
//dd($constraint,$tableColumns);

        $identifiers = [];

        if($searchColumns){
            foreach ($searchColumns as $searchColumn):
                try{
                    if($constraint){
                        $query = $sql_search . $searchColumn . " like('%" . $key . "%') and ".$constraint[0]."=".$constraint[1];
                        $queries = \DB::select($query);
                        if (!empty($queries)) {
                            foreach ($queries as $query):
                                $identifiers[] = [$query->id, $query];
                            endforeach;
                        }
                    }else {

                        $query = $sql_search . $searchColumn . " like('%" . $key . "%')";
                        $queries = \DB::select($query);
                        if (!empty($queries)) {
                            foreach ($queries as $query):
                                $identifiers[] = [$query->id, $query];
                            endforeach;
                        }
                    }
                }catch (\Exception $exception){
                    return (object)['status'=> 'Error 404', 'message'=>'column: '.$searchColumn.' not found!'];
                }

            endforeach;
        }else{
            foreach (array_slice($tableColumns,1) as $tableColumn){
                $column = $tableColumn->Field;
                $query = $sql_search.$column." like('%".$key."%')";
                $queries = \DB::select($query);
                if(!empty($queries)){
                    foreach ( $queries as $query):
                        $identifiers[] = [$query->id,$query];
                    endforeach;
                }
            }

        }

        $results = array_map("unserialize", array_unique(array_map("serialize", $identifiers)));
        //dd($identifiers);
        $output = [];
        if(!empty($results)){
            foreach ($results as $result){
                $output[] = $result[1];
            }
        }
        return $output;
    }
}

if (!function_exists('arrayDel')){

    function arrayDel($str,$array){
        if (in_array($str,$array)==true)
        {
            foreach ($array as $key=>$value)
            {
                if ($value==$str) unset($array[$key]);
            }
        }
    }
}

if (!function_exists('structData')){

    function structData($dataS,$seller){
        $result=[];
        $finalResult=[];
        $seller_in_data=[];
        foreach($seller as $id){
            $result[$id]= [];
        }

        foreach($dataS as $data){
            $id=$data["seller_id"];
            if(!in_array($id,$seller_in_data)){
                array_push($seller_in_data,$id);
            }
            $position = array_search($id, $seller);
            array_push($result[$id],$data);
        }


        foreach($result as $seller_id => $oneResult){

            if(!in_array($seller_id,$seller_in_data)){
                $finalResult[$seller_id]=new Exception("this Seller have not done any opération");
            }

            else{

                if(count($oneResult)!=12){
                    $year=["1","2","3","4","5","6","7","8","9","10","11","12"];

                    foreach($oneResult as $data){
                        arrayDel($data['months'], $year);
                    }
                    foreach($year as $month){
                        array_push($oneResult,[
                            "label" => null,
                            "seller_id" => "".$seller_id,
                            "months" => "".$month,
                            "total_amount" => 0,
                        ]);

                    }
                }
                $finalResult["".$seller_id]=$oneResult;}
        }

        return $finalResult;
    }
}
