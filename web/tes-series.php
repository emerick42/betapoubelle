<?php

$token = $_GET['toi'];
$lacleapi = "1988be26b106";
$retourdelapi = 'yenapa';

function getTesSeries() {
    global $retourdelapi;

    VaChercher('http://api.betaseries.com/members/infos', true);

    $jsonretourdelapi = json_decode($retourdelapi, true);
    return $jsonretourdelapi;
}

function VaChercher($adrese, $simple)
{
    global $lacleapi, $retourdelapi, $token;

    ob_start();
    $curling = curl_init();

    curl_setopt($curling, CURLOPT_URL, $adrese);
    curl_setopt($curling, CURLOPT_HEADER, 0);

    if (!$simple)
    {

    curl_setopt($curling, CURLOPT_POST, 1);

    }

    curl_setopt($curling, CURLOPT_HTTPHEADER, array(
              'X-BetaSeries-Key: '.$lacleapi,
              'Authorization: Bearer '.$token
    ));

    curl_exec($curling);

    curl_close($curling);

    $retourdelapi = ob_get_contents();
}

?>
<html>
    <body>
        <a href='http://localhost:8989/accueil.php'>Retour à l'accueil !</a>
        <h1>TES SÉRIES</h2>
        <div style="display: none;"><?php $series = getTesSeries() ?></div>
        <table>
            <?php foreach ($series['member']['shows'] as $serie) { ?>
                <div><?php echo $serie['title'] ?> <a target="_blank" href="<?php echo $serie['resource_url'] ?>">(un lien vers l'ancien site en attendant d'avoir tout refait)</div></a>
            <?php } ?>
            </table>
    </body>
</html>
