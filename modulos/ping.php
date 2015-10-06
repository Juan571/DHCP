<?php
echo $_SERVER['REMOTE_ADDR'];

/*
$output = shell_exec('sarg -z');
$cadena_buscada = "Unreachable";

$posicion_coincidencia = strpos($output, $cadena_buscada);

if (!is_bool($posicion_coincidencia)) {
    echo "no hay ping.."."<pre>$output</pre>";
}else{
    echo "Haciendo PING...";

    echo "<pre>$output</pre>";
}
*/
?>