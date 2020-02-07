<?php

// 本代码用于获取Bilibili直播源（首选为0）
// 服务推荐架设在与播放器统一网络中，因为B站的API会判断你的位置，然后给出合适的CDN地址

    $roomId = $_GET["roomid"];

    //以下URL仅作测试使用
    //$roomUrl0 = "https://api.live.bilibili.com/room/v1/Room/room_init?id=$roomId";
    //$roomUrl1 = "https://api.live.bilibili.com/room/v1/Danmu/getConf?room_id=$roomId&platform=pc&player=web";
    //$roomUrl2 = "https://api.live.bilibili.com/xlive/web-room/v1/index/getRoomPlayInfo?room_id=$roomId&play_url=1&mask=1&qn=0&platform=web";

    $roomUrl = "https://api.live.bilibili.com/xlive/web-room/v1/index/getRoomPlayInfo?room_id=$roomId&play_url=1&mask=1&qn=0&platform=web";

    // create curl resource
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36');
    curl_setopt($ch, CURLOPT_URL, $roomUrl);
    $jsonData = curl_exec($ch);
    curl_close($ch);

    // decode json data
    $jsonData = json_decode($jsonData,true);
    //echo '<pre>' , var_dump($jsonData) , '</pre>';

    // if no match
    if (strcmp($jsonData["code"],"0") != 0) {
        http_response_code(403);
        die('Forbidden');
    }

    $streamUrl = $jsonData["data"]["play_url"]["durl"][0]["url"];
    //echo $streamUrl;
    //header('Content-Type: video/x-flv');
    header("Location: $streamUrl");
    exit();
?>
