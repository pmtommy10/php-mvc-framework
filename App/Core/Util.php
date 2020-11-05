<?php

namespace App\Core;

final class Util
{

    static function setLang()
    {
        $url = str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);

        if (isset($_GET['lang']) && in_array($_GET['lang'], array('th', 'en', 'cn'))) {
            $getQuery = [];
            foreach ($_GET as $key => $value) {
                if ($key == 'lang') continue;
                $getQuery[$key] = $value;
            }
            setcookie('lang', $_GET['lang'], time() + 12 * 30.5 * 24 * 60 * 60, '/');
            $_GET = $getQuery;
            $queries = (count($_GET) ? '?' : '') . http_build_query($_GET);
            header("location: {$url}{$queries}");
        }
    }

    /**
     * if $param as array
     * - ['key' => 'value', ...]
     */
    static function getQuery($param = null, string $value = null)
    {
        if (is_array($param)) {
            foreach ($param as $key => $value) {
                $_GET[$key] = $value;
            }
            return (count($_GET) ? '?' : '') . http_build_query($_GET);;
        }

        if (!is_null($param)) $_GET[$param] = $value;
        return (count($_GET) ? '?' : '') . http_build_query($_GET);
    }

    static function VisitorCounter()
    {
        // cookie will expire when the browser close
        if (!isset($_COOKIE['counter'])) {
            $ip = Util::get_client_ip();
            if (strpos($ip, '66.249.') === false) {
                $pdo = Database::connect();
                $update_sql = "UPDATE visitor_count SET count = count + 1 WHERE DATE(timestamp) = DATE(NOW()) AND ip = ?";
                $update_q = $pdo->prepare($update_sql);
                $update_q->execute([$ip]);
                if (!$update_q->rowCount()) {
                    $sql = "INSERT INTO visitor_count (ip) VALUES (?) ON DUPLICATE KEY UPDATE count = count + 1";
                    $counter = $pdo->prepare($sql);
                    $counter->execute([$ip]);
                }
            }
            setcookie("counter", 1, time() + 3600);
        }
    }

    static function ProductVisitorCounter(int $productId)
    {
        // cookie will expire when the browser close
        try {
            if (!isset($_COOKIE['pd_counter_' . $productId])) {
                $ip = Util::get_client_ip();
                if (strpos($ip, '66.249.') === false) {
                    $sql = "UPDATE shop_product SET visitors = visitors + 1 WHERE id = ?";
                    $counter = Database::connect()->prepare($sql);
                    $counter->execute([$productId]);
                }
                setcookie("pd_counter_" . $productId, 1, time() + 3600);
            }
        } catch (\PDOException $e) {
            throw new \Exception('พบข้อบกพร่องทางเทคนิค รหัส: ' . $e->getCode(), 0, $e);
            return false;
        }
        return true;
    }

    static function ShopVisitorCounter(int $shopId)
    {
        // cookie will expire when the browser close
        try {
            if (!isset($_COOKIE['shop_counter_' . $shopId])) {
                $ip = Util::get_client_ip();
                if (strpos($ip, '66.249.') === false) {
                    $sql = "UPDATE shop SET visitors = visitors + 1 WHERE id = ?";
                    $counter = Database::connect()->prepare($sql);
                    $counter->execute([$shopId]);
                }
                setcookie("shop_counter_" . $shopId, 1, time() + 3600);
            }
        } catch (\PDOException $e) {
            throw new \Exception('พบข้อบกพร่องทางเทคนิค รหัส: ' . $e->getCode(), 0, $e);
            return false;
        }
        return true;
    }

    static function THdatetime($strDate, $format = 'datetime', $type = 'short')
    {
        $thMonths = array('', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
        $thShortMonths = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        if ($format === 'datetime') {
            $arr = explode(' ', $strDate);
            $strDate = $arr[0];
            if (isset($arr[1])) {
                $time = $arr[1];
                $timeArr = explode(':', $time);
                $time = $timeArr[0] . ':' . $timeArr[1];
            }
        }
        $dateArr = explode('-', $strDate);
        $y = (int) $dateArr[0];
        $m = (int) $dateArr[1];
        $d = (int) $dateArr[2];
        if ($y <= 2300) $y += 543;
        return $d . ' ' . ($type === 'long' ? $thMonths[$m] : $thShortMonths[$m]) . ' ' . $y . (isset($time) ? ', ' . $time . ' น.' : '');
    }

    static function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    static function csrf(String $token_key = null, bool $returnArray = false)
    {
        if (!isset($_SESSION['csrf_token_expire']) || !isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token_expire'] = strtotime('now') + 3600;
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        } else {
            $csrfTokenExpired = strtotime('now') > $_SESSION['csrf_token_expire'];
            if ($csrfTokenExpired) {
                $_SESSION['csrf_token_expire'] = strtotime('now') + 3600;
                $_SESSION['csrf_token'] = $csrfTokenExpired ? bin2hex(random_bytes(32)) : $_SESSION['csrf_token'] ?? bin2hex(random_bytes(32));
            }
        }

        if (!is_null($token_key)) {
            $csrf_token_key = sha1($token_key);
            $csrf_token = hash_hmac('sha256', $csrf_token_key, $_SESSION['csrf_token']);
            if ($returnArray) {
                return [
                    "csrf_token_key" => $csrf_token_key,
                    "csrf_token" => $csrf_token,
                ];
            }
            echo "<input type=\"hidden\" name=\"csrf_token_key\" value=\"$csrf_token_key\">";
            echo "<input type=\"hidden\" name=\"csrf_token\" value=\"$csrf_token\">";
        } else {
            if ($returnArray) {
                return ["csrf_token" => $_SESSION['csrf_token']];
            }
            echo "<input type=\"hidden\" name=\"csrf_token\" value=\"{$_SESSION['csrf_token']}\">";
        }
    }

    /**
     * @throws \Exception
     */
    static function csrfValidate(bool $throwException = true)
    {
        if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token'])) {
            throw new \Exception('พบปัญหาด้านความปลอดภัย โปรดลองใหม่อีกครั้ง หรือติดต่อทีมงานเพื่อขอความช่วยเหลือ');
        }
        if (isset($_POST['csrf_token_key'])) {
            $csrf_token = hash_hmac('sha256', $_POST['csrf_token_key'], $_SESSION['csrf_token']);
            $verifyHash = hash_equals($csrf_token, $_POST['csrf_token']);
        } else {
            $verifyHash = hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
        }

        if ($verifyHash === false) {
            if ($throwException) throw new \Exception('พบปัญหาด้านความปลอดภัย ท่านอาจใช้เวลาดำเนินการในส่วนนี้นานเกินไป โปรด Refresh หน้านี้และลองใหม่อีกครั้ง หรือติดต่อทีมงานเพื่อขอความช่วยเหลือ');
            return false;
        }
        return true;
    }

    /**
     * @throws \Exception
     */
    static function validateUploadImage(string $tmp_name, bool $throwException = true)
    {
        if (!file_exists($tmp_name)) throw new \Exception('ไม่พบไฟล์รูปภาพ');
        $mime = mime_content_type($tmp_name);
        $allowedMime = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp'];

        if (!in_array($mime, $allowedMime) || getimagesize($tmp_name) === false) {
            if (!$throwException) return false;
            throw new \Exception('ไฟล์รูปภาพมีปัญหา โปรดตรวจสอบไฟล์ที่อัพโหลดและลองอีกครั้ง ' . $mime);
        }

        return true;
    }

    static function productImage($imageName)
    {
        if (!$imageName) {
            return '//dummyimage.com/500x500';
        }
        $uploadWebPath = '/uploads/product/';
        $uploadRoot = UPLOADS.'/product/';
        
        $thumbnail = 'thumbnail/thumb_' . $imageName;
        if (is_file($uploadRoot.$thumbnail.'.jpg') && file_exists($uploadRoot.$thumbnail.'.jpg')) {
            return $uploadWebPath.$thumbnail;
        }
        return $uploadWebPath.$imageName;
    }
}
