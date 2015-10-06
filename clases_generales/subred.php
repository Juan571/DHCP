<?php

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function IPisWithinCIDR($ipinput,$cidr){
    //$cidr = explode('/',$cidr);
    //$cidr = "192.168.100.0/24";
    $cidr = explode('/',$cidr);
    $ipinput = (ip2long($ipinput));
    $ip1 = (ip2long($cidr[0]));
    $ip2 = ($ip1 + pow(2, (32 - (int)$cidr[1])) - 1);
    return (($ip1 <= $ipinput) && ($ipinput <= $ip2));
}
function netmask2cidr($netmask)
{
    $bits = 0;
    $netmask = explode(".", $netmask);

    foreach($netmask as $octect)
        $bits += strlen(str_replace("0", "", decbin($octect)));

    return $bits;
}

function getIpRange(  $cidr) {

    list($ip, $mask) = explode('/', $cidr);

    $maskBinStr =str_repeat("1", $mask ) . str_repeat("0", 32-$mask );      //net mask binary string
    $inverseMaskBinStr = str_repeat("0", $mask ) . str_repeat("1",  32-$mask ); //inverse mask

    $ipLong = ip2long( $ip );
    $ipMaskLong = bindec( $maskBinStr );
    $inverseIpMaskLong = bindec( $inverseMaskBinStr );
    $netWork = $ipLong & $ipMaskLong;

    $start = $netWork+1;//ignore network ID(eg: 192.168.1.0)

    $end = ($netWork | $inverseIpMaskLong) -1 ; //ignore brocast IP(eg: 192.168.1.255)
    return array('firstIP' => $start, 'lastIP' => $end );
}

function getEachIpInRange ( $cidr) {
    $ips = array();
    $range = getIpRange($cidr);
    for ($ip = $range['firstIP']; $ip <= $range['lastIP']; $ip++) {
        $ips[] = long2ip($ip);
    }
    return $ips;
}
function delLineFromFile($fileName, $lineNum){
// check the file exists
    if(!is_writable($fileName))
    {
        print "El arhivo $fileName no tiene permisos de escritura";
        exit;
    }
    else
    {
        $arr = file($fileName);
    }
    $lineToDelete = $lineNum-1;

    if($lineToDelete > sizeof($arr))
    {
        print "la linea , <b>[$lineNum]</b>,  es muy alto";
        exit;
    }
    unset($arr["$lineToDelete"]);

    if (!$fp = fopen($fileName, 'w+'))
    {
        print "No se puede abrir el archivo($fileName)";
        exit;
    }
    if($fp)
    {
        foreach($arr as $line) { fwrite($fp,$line); }
        fclose($fp);
    }
    return true;
}
function subnet_info($network,$request)
{
    $slash_pos = strpos($network, '/');
    $netmask = substr($network, $slash_pos + 1);
    $ip = substr($network, 0, $slash_pos);

    // Change prefix to netmask
    if (strpos($netmask, '.') === false) {
        $prefix =  intval($netmask);
        $prefix_binary = str_pad(str_pad("",  $prefix, "1", STR_PAD_LEFT), 32, "0");
        $netmask = bindec (substr ($prefix_binary, 0 ,8));
        $netmask = $netmask.".".bindec (substr ($prefix_binary, 8 ,8));
        $netmask = $netmask.".".bindec (substr ($prefix_binary, 16 ,8));
        $netmask = $netmask.".".bindec (substr ($prefix_binary, 24 ,8));
    }

    $ip_array = explode('.', $ip);
    $netmask_array = explode('.', $netmask);

    $hosts = 1;
    for($i=0; $i<4; $i++)
    {
        $ip_quarter = $ip_array[$i];
        $netmask_quarter = $netmask_array[$i];

        $ip_binary_array[$i] = str_pad(decbin($ip_quarter), 8, "0", STR_PAD_LEFT);
        $netmask_binary_array[$i] = str_pad(decbin($netmask_quarter), 8, "0", STR_PAD_LEFT);

        $netmask_quarter = intval($netmask_quarter);
        $ip_quarter = intval($ip_quarter);

        $count = 256 - $netmask_quarter;
        $begin = intval($ip_quarter / $count) * $count;
        $end = $begin + $count - 1;
        $hosts *= $count;

        $begin_array[$i] = $begin;
        $end_array[$i] = $end;

        $begin_binary_array[$i] = str_pad(decbin($begin), 8, "0", STR_PAD_LEFT);
        $end_binary_array[$i] = str_pad(decbin($end), 8, "0", STR_PAD_LEFT);

        $wildcard_array[$i] = $netmask_quarter ^ 255;
    }

    $networkid = implode('.', $begin_array);
    $broadcast = implode('.', $end_array);
    $wildcard = implode('.', $wildcard_array);

    $networkid_binary = implode('.', $begin_binary_array);
    $broadcast_binary = implode('.', $end_binary_array);

    $ip_binary = implode('.', $ip_binary_array);
    $netmask_binary = implode('.', $netmask_binary_array);

    if (!isset($prefix)) {
        $prefix_binary = $netmask_binary;
        $prefix = 0;
        for($i = 0; $i < 32; $i++)
            if($prefix_binary[$i] == "1")
                $prefix++;
    }

    switch (strtolower($request)) {
        case "ip" :
            return $ip;
            break;
        case "netmask" :
        case "mask" :
            return $netmask;
            break;
        case "prefix" :
            return $prefix;
            break;
        case "netid" :
        case "network" :
        case "networkid" :
            return $networkid;
            break;
        case "broadcast" :
            return $broadcast;
            break;
        case "ipbin" :
        case "ip_bin" :
            return $ip_binary;
            break;
        case "netmaskbin" :
        case "netmask_bin" :
        case "maskbin" :
        case "mask_bin" :
        case "prefix_bin" :
        case "prefixbin" :
            return $prefix_binary;
            break;
        case "netid_bin" :
        case "network_bin" :
        case "networkid_bin" :
            return $networkid_binary;
            break;
        case "broadcast_bin" :
        case "broadcastbin" :
            return $broadcast_binary;
            break;
        case "wildcard" :
            return $wildcard;
            break;
        case "hosts" :
        case "count" :
            return $hosts;
            break;
        default :
            $request = intval($request);
            $num = 0;
            for ($j[0] = $begin_array[0]; $j[0] <= $end_array[0]; $j[0]++)
                for ($j[1] = $begin_array[1]; $j[1] <= $end_array[1]; $j[1]++)
                    for ($j[2] = $begin_array[2]; $j[2] <= $end_array[2]; $j[2]++)
                        for ($j[3] = $begin_array[3]; $j[3] <= $end_array[3]; $j[3]++) {
                            $host_ip = "$j[0].$j[1].$j[2].$j[3]";
                            $num++;
                            if ($request == $num) return $host_ip;
                        }
    }
}

?>