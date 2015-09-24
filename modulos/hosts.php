<?php


$file = fopen("/etc/dhcp/dhcpd.conf", "r");
$archivohosts="/etc/sarg/usertab";
$hosts = array();
if (!$fp = fopen($archivohosts, 'w+'))
{
    $resp="no se puede abrir el archivo";
    die($resp);
}
while (!@feof($file)) {

    //  if (fgets($file)){
    $cadena_buscada = "host";
    $linea = @fgets($file);
    // echo $cont.fgets($file)."<br>";

    $posicion_coincidencia = strpos($linea, $cadena_buscada);
    #var_dump($posicion_coincidencia);
    if (!is_bool($posicion_coincidencia)) {

        //   echo substr($linea, 4,-2)."<br>";
        $datosh['nombre'] =trim(substr($linea, 4, -2));
        $descripcion = fgets($file);
        $pos = strpos($descripcion, "#");
        //   echo "Descripcion: ".substr($descripcion, $pos+1,-1)."<br>";//substr($linea, 4,-2)."<br>";
        $datosh['descrip'] = substr($descripcion, $pos + 1, -1);
        $mac = fgets($file);
        $pos = strpos($mac, ":");
        //   echo "Mac: ".substr($mac,$pos-2,-2)."<br>";
        $datosh['mac'] = substr($mac, $pos - 2, -2);
        substr($descripcion, $pos + 1, -1);
        $ip = fgets($file);

        preg_match('/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $ip, $matches);
        //   echo "IP: ".$matches[0]."<br>"."<br>";
        $datosh["ip"] = $matches[0];

        $hosts[] = $datosh;




        fwrite($fp,$datosh["ip"]." ".$datosh['nombre']."\n");






    }
}
echo "Archivo Genererado Satisfactoriamente";
//  echo json_encode($hosts);
fclose($file);
fclose($fp);


?>