<?php

$c = new TopClient;
$c->appkey = $appkey;
$c->secretKey = $secret;
$req = new MixnickGetRequest;
$req->setNick("tbtest001");
$resp = $c->execute($req);

?>