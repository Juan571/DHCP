<?php
function obtener_ip(){
if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
return array_shift(explode(",",$_SERVER["HTTP_X_FORWARDED_FOR"]));
else if(!empty($_SERVER["HTTP_CLIENT_IP"]))
return $_SERVER["HTTP_CLIENT_IP"];
else
return $_SERVER["REMOTE_ADDR"];
}
echo obtener_ip();

?>