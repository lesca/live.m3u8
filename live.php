<?php


        $tvList = array(
                "sztv1"=>"https://anylive.website.com/szh/channel_detail.php?channel_id=1",
                "sztv2"=>"https://anylive.website.com/szh/channel_detail.php?channel_id=2",
                "sztv3"=>"https://anylive.website.com/szh/channel_detail.php?channel_id=3",
                "sztv4"=>"https://anylive.website.com/szh/channel_detail.php?channel_id=4",
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
