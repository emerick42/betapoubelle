<?php
$lacleapi = "1988be26b106";

ob_start();
$curling = curl_init();

curl_setopt($curling, CURLOPT_URL, 'http://api.betaseries.com/shows/display?id=481');
curl_setopt($curling, CURLOPT_HEADER, 0);
curl_setopt($curling, CURLOPT_HTTPHEADER, array(
          'X-BetaSeries-Key: '.$lacleapi,
));

curl_exec($curling);

curl_close($curling);

$retourdelapi = ob_get_contents();
?>

<htlm>
<head>
    <style>
    body {
     background: url(<?php echo json_decode($retourdelapi, true)['show']['images']['poster']; ?>)
    }
    marquee {
     background-color: #79CE00;
     padding: 25px 0;
    }
    </style>
<body>
<body>
    <marquee>😂 Bienvenues sur BetaSeris 😂</marquee>
    
    <table>
        <tr><th><?php echo json_decode($retourdelapi, true)['show']['title']; ?></th></tr>
        <tr><td><img src="<?php echo json_decode($retourdelapi, true)['show']['images']['banner']; ?>" /></td></tr>
        <tr><?php echo json_decode($retourdelapi, true)['show']['description']; ?></p></td>
    <div>
        copyright Netacts 2016
    </div>
</body>
</htlm>
