<?php

####RESTART SERVICE IN PHP
//exec("sudo /etc/init.d/networking restart");
include_once("../../../clases_generales/subred.php");
//$f = "../../dhcpd2.conf";
$f = "/etc/dhcp/dhcpd.conf";

if(isset($_REQUEST['action'])){
    $action = $_REQUEST['action'];
} else {
    die("Ninguna accion ha sido a definida");
}
if(isset($_REQUEST['data'])){
    $red = $_REQUEST['data']["subnet"];
    $data = $_REQUEST['data'];
} else {
    $red['resp'] = "errorRed";
    die(json_encode($red));
}

switch ($action) {

    case $action === 'EliminarHost':

        $ipeliminar=trim(strtoupper($data['ipsel']));

        $file = fopen($f, "rw");
        $cont = 0;
        while (!feof($file)) {
            $cont++;
            $cadena_buscada = $ipeliminar;
            $linea = fgets($file);
            $posicion_coincidencia = strpos($linea, $cadena_buscada);
            if (!is_bool($posicion_coincidencia)) {
                $a="no exixte";
                break;
            }////IF
        }//whileee

        if (is_bool($posicion_coincidencia)){
            die ($_REQUEST['data']['id_red']);
        }
        $linea = $cont-3;
        //
        //fclose($file);
        delLineFromFile($f,$linea);
        delLineFromFile($f,$linea);
        delLineFromFile($f,$linea);
        delLineFromFile($f,$linea);

        if (delLineFromFile($f,$linea)){
            $resp = array();
            $resp["evento"]=$action;
            $resp["respuesta"]="Eliminado";
            echo json_encode($resp);
        }
        exec("sudo /etc/init.d/isc-dhcp-server restart");

        break;

    case $action === 'EditarHost':

        $ipsel=$data['id_sel'];
        $idred=$data['red'];
        $descripcion=strtoupper($data['descripcion_ip']);
        $ip_nueva=$data['ip'];
        $mac_ip=strtoupper($data['mac_ip']);
        $nombre_ip=strtoupper(trim($data['nombre_ip']));

        if (!IPisWithinCIDR($ip_nueva,$idred)){
            $resp = array();
            $resp["evento"]=$action;
            $resp["respuesta"]="erroip";
            die(json_encode($resp));
        }

        $file = fopen($f, "rw");
        $cont = 0;
        while (!feof($file)) {
            $cont++;
            $cadena_buscada = $ipsel;
            $linea = fgets($file);
            $posicion_coincidencia = strpos($linea, $cadena_buscada);
            if (!is_bool($posicion_coincidencia)) {
                $a="no exixte";
                break;
            }////IF
        }//whileee

        if (is_bool($posicion_coincidencia)){
            die ($_REQUEST['data']['id_red']);
        }
        $linea = $cont-3;
        //
        //fclose($file);
        delLineFromFile($f,$linea);
        delLineFromFile($f,$linea);
        delLineFromFile($f,$linea);
        delLineFromFile($f,$linea);

        if (!delLineFromFile($f,$linea)){
            $resp = array();
            $resp["evento"]=$action;
            $resp["respuesta"]="no se puede abrir el archivo";
            echo json_encode($resp);
        }
        $cont=$linea-1;

        $arr = file($f);
        $arr = array_values($arr);
        $totallineas = count($arr);
        // fclose($file);
        $arr1=array_slice($arr, 0,$cont);

        $ipNueva[]="host $nombre_ip {";
        $ipNueva[]="    # $descripcion";
        $ipNueva[]="    hardware ethernet $mac_ip;";
        $ipNueva[]="    fixed-address $ip_nueva;";
        $ipNueva[]="}";

        foreach($ipNueva as $x => $value) {
            array_push($arr1,$value."\n");
        }
        $arr2=array_slice($arr, $cont,$totallineas);
        $arr=array_merge($arr1,$arr2);


        if (!$fp = fopen($f, 'w+'))
        {
            $resp = array();
            $resp["evento"]=$action;
            $resp["respuesta"]="no se puede abrir el archivo";
            echo json_encode($resp);
        }
        if($fp)
        {
            foreach($arr as $line) {
                fwrite($fp,$line);
            }
            fclose($fp);
        }
        $resp = array();
        $resp["evento"]=$action;
        $resp["respuesta"]="editado";
        exec("sudo /etc/init.d/isc-dhcp-server restart");

        echo json_encode($resp);
        break;

    case $action === 'GuardarHost':

        $idred=$data['red'];
        $descripcion=strtoupper($data['descripcion_ip']);
        $ip_nueva=$data['ip'];
        $mac_ip=strtoupper($data['mac_ip']);
        $nombre_ip=strtoupper(trim($data['nombre_ip']));

        if (!IPisWithinCIDR($ip_nueva,$idred)){
            $resp = array();
            $resp["evento"]=$action;
            $resp["respuesta"]="erroip";
            die(json_encode($resp));
        }

        $leyendoips= "fixed-address";
        $file = fopen($f, "rw");
        $cont = 0;
        while (!feof($file)) {
            $cont++;
            $cadena_buscada = $leyendoips;
            $linea = fgets($file);
            $posicion_coincidencia = strpos($linea, $cadena_buscada);
            if (!is_bool($posicion_coincidencia)) {

                preg_match('/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $linea, $matches);
                //   echo "IP: ".$matches[0]."<br>"."<br>";

                $tempip = trim($matches[0]);
                if (IPisWithinCIDR($tempip,$idred))//$matches[0];
                break;
            }////IF
        }//whileee

        if (is_bool($posicion_coincidencia)){
            die ($_REQUEST['data']['id_red']);
        }
        fclose($file);

//die("asda");
       // echo "$linea ";
        $cont=$cont-4;


        $arr = file($f);
        $arr = array_values($arr);
        $totallineas = count($arr);
        // fclose($file);
        $arr1=array_slice($arr, 0,$cont);

        $ipNueva[]="host $nombre_ip {";
        $ipNueva[]="    # $descripcion";
        $ipNueva[]="    hardware ethernet $mac_ip;";
        $ipNueva[]="    fixed-address $ip_nueva;";
        $ipNueva[]="}";

        foreach($ipNueva as $x => $value) {
            array_push($arr1,$value."\n");
        }
        $arr2=array_slice($arr, $cont,$totallineas);
        $arr=array_merge($arr1,$arr2);
        //print_r($arr);

        if (!$fp = fopen($f, 'w+'))
        {
            $resp = array();
            $resp["evento"]=$action;
            $resp["respuesta"]="no se puede abrir el archivo";
            echo json_encode($resp);
        }
        if($fp)
        {
            foreach($arr as $line) {
                fwrite($fp,$line);
            }
            fclose($fp);
        }
        $resp = array();
        $resp["evento"]=$action;
        $resp["respuesta"]="guardado";
        exec("sudo /etc/init.d/isc-dhcp-server restart");
        echo json_encode($resp);
        break;

    case $action === 'obtenerHosts':

        $file = fopen($f, "rw");
        $hosts = array();
        while (!feof($file)) {

            //  if (fgets($file)){
            $cadena_buscada = "host";
            $linea = fgets($file);
            // echo $cont.fgets($file)."<br>";

            $posicion_coincidencia = strpos($linea, $cadena_buscada);
            #var_dump($posicion_coincidencia);
            if (!is_bool($posicion_coincidencia)) {

                //   echo substr($linea, 4,-2)."<br>";
                $datosh['nombre'] = strtoupper(trim(substr($linea, 4, -2)));
                $descripcion = fgets($file);
                $pos = strpos($descripcion, "#");
                //   echo "Descripcion: ".substr($descripcion, $pos+1,-1)."<br>";//substr($linea, 4,-2)."<br>";
                $datosh['descrip'] = trim(substr($descripcion, $pos + 1, -1));
                $mac = fgets($file);
                $pos = strpos($mac, ":");
                //   echo "Mac: ".substr($mac,$pos-2,-2)."<br>";
                $datosh['mac'] = strtoupper(substr($mac, $pos - 2, -2));
                substr($descripcion, $pos + 1, -1);
                $ip = fgets($file);

                preg_match('/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})/', $ip, $matches);
                //   echo "IP: ".$matches[0]."<br>"."<br>";

                $datosh["ip"] = trim($matches[0]);
                if ($red=="todos"){
                    $hosts[] = $datosh;
                }else{
                    if (IPisWithinCIDR($matches[0],$red))//$matches[0];
                    $hosts[] = $datosh;
                }
            }
        }
        echo json_encode($hosts);
        fclose($file);
        break;
    case $action === 'obtenerDatosRed':

        $red_datos['hosts'] =subnet_info($red,"hosts");
        $red_datos['ip_red'] =subnet_info($red,"networkid");
        $red_datos['broadcast'] =subnet_info($red,"broadcast");

        echo json_encode($red_datos);
        fclose($file);
        break;
    default :
        break;
}


?>