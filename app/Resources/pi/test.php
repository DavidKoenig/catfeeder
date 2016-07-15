<?php
$source = $_SERVER['SERVER_ADDR'];
$target = shell_exec("hostname -I");
$port = 11337;

$nGroup = "11010";
$nSwitch = "04";
$nAction = "1";

$output = $nGroup.$nSwitch.$nAction;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("Could not create socket here\n");
socket_bind($socket, $source) or die("Could not bind to socket\n");
socket_connect($socket, $target, $port) or die("Could not connect to socket\n");
socket_write($socket, $output, strlen ($output)) or die("Could not write output\n");
socket_close($socket);
?>
