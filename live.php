<?php

    // 苏州电视台直播源 - json格式
    $tvList = array(
        "sztv1"=>"https://mobile.kan0512.com/szh/channel_detail.php?appkey=mmv6bfo799vcDHqfZBlqtDp4NHCCb4xn&appid=36&device_token=edbc839c4d969a6cf67b840367a25750&version=4.0.4&app_version=4.0.4&avos_device_token=edbc839c4d969a6cf67b840367a25750&client_id_ios=523cd29827ef83a51c40132bea8987a2&channel_id=60&ad_group=mobile&",
        "sztv2"=>"https://mobile.kan0512.com/szh/channel_detail.php?appkey=mmv6bfo799vcDHqfZBlqtDp4NHCCb4xn&appid=36&device_token=edbc839c4d969a6cf67b840367a25750&version=4.0.4&app_version=4.0.4&avos_device_token=edbc839c4d969a6cf67b840367a25750&client_id_ios=523cd29827ef83a51c40132bea8987a2&channel_id=51&ad_group=mobile&",
        "sztv3"=>"https://mobile.kan0512.com/szh/channel_detail.php?appkey=mmv6bfo799vcDHqfZBlqtDp4NHCCb4xn&appid=36&device_token=edbc839c4d969a6cf67b840367a25750&version=4.0.4&app_version=4.0.4&avos_device_token=edbc839c4d969a6cf67b840367a25750&client_id_ios=523cd29827ef83a51c40132bea8987a2&channel_id=52&ad_group=mobile&",
        "sztv5"=>"https://mobile.kan0512.com/szh/channel_detail.php?appkey=mmv6bfo799vcDHqfZBlqtDp4NHCCb4xn&appid=36&device_token=edbc839c4d969a6cf67b840367a25750&version=4.0.4&app_version=4.0.4&avos_device_token=edbc839c4d969a6cf67b840367a25750&client_id_ios=523cd29827ef83a51c40132bea8987a2&channel_id=53&ad_group=mobile&"
    );

    // Accept "channel" as GET parameter
    $channel = $_GET["channel"];
    $channelUrl = $tvList[$channel];

    // if no match
    if (empty($channelUrl)) {
        http_response_code(403);
        die('Forbidden');
    }

    $jsonData = json_decode(file_get_contents($channelUrl),true);

    // uncomment below and comment all "header" lines to show the decoded json data
    //echo '<pre>' , var_dump($jsonData) , '</pre>';
    
    // Now we find the stream URL
    $streamUrl = $jsonData[0]["m3u8"];
    //echo $streamUrl;
    
    // Redirect the stream URL
    header("Location: $streamUrl");
    header('Content-Type: application/vnd.apple.mpegurl');
    exit();
?>
