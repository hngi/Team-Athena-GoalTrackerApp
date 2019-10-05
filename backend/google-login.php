<?php require ("vendor/autoload.php");

$g_client = new Google_Client();

$g_client->setClientId("374686635481-0ud7khmd7c85khnfcj2c4rq8so3vs0g0.apps.googleusercontent.com");
$g_client->setClientSecret("aB2IJYYXTvEVRoA1xfbVSwX6");
$g_client->setRedirectUri("http://athena-goal-tracker.elitelovers.org/index.html");
$g_client->setScopes("email");


$auth_url = $g_client->createAuthUrl();
echo "<a href='$auth_url'>Continue authentication with Google</a>";


$code = isset($_GET['code']) ? $_GET['code'] : NULL;


if(isset($code)) {

    try {

        $token = $g_client->fetchAccessTokenWithAuthCode($code);
        $g_client->setAccessToken($token);

    }catch (Exception $e){
        echo $e->getMessage();
    }




    try {
        $pay_load = $g_client->verifyIdToken();


    }catch (Exception $e) {
        echo $e->getMessage();
    }

} else{
    $pay_load = null;
}

if(isset($pay_load)){


    

}


