<?php

$lacleapi = "1988be26b106";

$retourdelapi = 'yenapa';

$token = 'yenapa';

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

if($_GET['connection'] != false)
{
    VaChercher('http://api.betaseries.com/members/auth?login=' . $_GET['connection'] . '&password=' . md5 ($_GET['motdepasse']), false);
    $token = json_decode($retourdelapi, true)['token'];
    session_start();
    $_SESSION['connecté'] = 'vrai';
}

VaChercher('http://api.betaseries.com/members/infos', true);

session_start();
$i = $_SESSION['comteur']++;
?>

<htlm>
<head>
    <style>
    div {
    margin-top: 20px;
    }
    marquee {
     background-color: pink;
     padding: 25px 0;
    }
    </style>
<body>
<?php
 // VOICI LE CODE SOURCE DE BETASERIS
 // VERSION WEB 4.0
 // NE PAS TROP TOUCHER SINON SA MARCHE PLUS
?>
<body>
     <marquee>😂 Bienvenues sur BetaSeris
    <?php
    print json_decode($retourdelapi, true)['member']['login'];
    ?> 😂</marquee>

     <h1>déjà <?php print $i ?> visites sur Betaseris!!!!</h1>

     <form>
         Connection <input name="connection">
         Mot de pass <input name="motdepasse">
         <input type="submit">
    </form>

    <h3>Les séris du moment</h3>
        <a href="http://localhost:8989/breaking-bad.php">Beakring Bad</a>
        <a href="http://localhost:8989/the-walking-dead.php">The Walking ded</a>

    <?php if($_SESSION['connecté'] == 'vrai'){ ?>
    <h3>Tes séries à toi</h3>
    <a href="http://localhost:8989/tes-series.php?toi=<?php echo $token ?>">Ta liste personnalisée</a>
    <?php } ?>
</body>
</htlm>
