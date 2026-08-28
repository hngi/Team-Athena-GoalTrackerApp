<?php require ("vendor/autoload.php");

$g_client = new Google_Client();

$g_client->setClientId("711971010502-8qu668mi4flb4d5rdh1bqcfv3a5je0id.apps.googleusercontent.com");
$g_client->setClientSecret("UpEyOT8peKBBSzgcJh0_efGc");
$g_client->setRedirectUri("http://athena-goal-tracker.elitelovers.org/index.html");
$g_client->setScopes("email");

$auth_url = $g_client->createAuthUrl();
echo "<a href='$auth_url'>Continue authentication with Google </a>";

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


?>