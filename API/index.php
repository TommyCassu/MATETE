<?php
require("Connexion.php");
if(isset($_GET["action"]) && $_GET["action"]== "all"){
    $c = new Connexion("api");
    $annonces = $c->RecupererAnnonces();
    echo "{annonces:".json_encode($annonces)."}";
}else{
    echo "{result:noresponse}";
}