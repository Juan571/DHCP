<?php

$output = shell_exec('ping -c1 192.168.100.126');
$cadena_buscada = "Unreachable";

$posicion_coincidencia = strpos($output, $cadena_buscada);

if (!is_bool($posicion_coincidencia)) {
    echo "no hay ping.."."<pre>$output</pre>";
}else{
    echo "Haciendo PING...";

    echo "<pre>$output</pre>";
}

?>