<?php

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Server Status</title>
</head>

<body>
<?php
//Page Variables
    $online='<td style="background-color:#00FF00; padding:5px;">Online</td>';
    $offline='<td style="background-color:#FF0000; padding:5px;">Offline</td>';
//Functions
    function servercheck($server,$port){
        //Check that the port value is not empty
        if(empty($port)){
            $port=80;
        }
        //Check that the server value is not empty
        if(empty($server)){
            $server='104.168.141.169';
        }
        //Connection
        $fp=@fsockopen($server, $port, $errno, $errstr, 1);
            //Check if connection is present
            if($fp){
                //Return Alive
                return 1;
            } else{
                //Return Dead
                return 0;
            }
        //Close Connection
        fclose($fp);
    }
//Ports and Services to check
$services=array(
    'HTTP (Port 80)' => array($server => 80),
    'HTTPS (Port 443)' => array($server => 443),
    'FTP (Port 21)' => array($server => 21),
    'MySQL (Port 3306)' => array($server => 3306),
    'SMTP (Port 25)' => array($server =>  25),
    'POP3 (Port 110)' => array($server =>  110),
    'Internet Connection' => array('google.com' => 80)
);
?>
<table>
<?php
//Check All Services
foreach($services as $name => $server){
?>
    <tr>
    <td><?php echo $name; ?></td>
<?php
    foreach($server as $host => $port){
        if(servercheck($host,$port)){ echo $online; }else{ echo $offline; }
    }
?>
    </tr>
<?php
}
?>
</table>
</body>
</html> 