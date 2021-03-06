<?php

$ip = '127.0.0.1';
$port = 38100;

$s = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_bind($s, $ip, $port);
socket_listen($s);
socket_set_nonblock($s);
// bytea
for (;;) {
    if ($con = socket_accept($s)) {
        $in = socket_read($con, 1024);
        $in = str_replace("\r", '', $in);
        echo $in . "\n\n";
        $httpParts = explode('Sec-WebSocket-Key: ', $in);
        $keyPair = explode("\n", $httpParts[1]);
        $key = $keyPair[0];
        //echo $key;
        $SecWebSocketAccept = base64_encode(pack('H*', sha1($key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
        $upgrade = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
	"Upgrade: websocket\r\n" .
	"Connection: Upgrade\r\n" .
	"Sec-WebSocket-Accept:$SecWebSocketAccept\r\n\r\n";

        $sent = socket_write($con, $upgrade);
        echo "Sent = {$sent} \n";
        //print_r($httpParts);
        //print_r($in);
        /*
        $SecWebSocketAccept = base64_encode(pack('H*', sha1($info['Sec-WebSocket-Key'] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
    $upgrade = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
	"Upgrade: websocket\r\n" .
	"Connection: Upgrade\r\n" .
	"Sec-WebSocket-Accept:$SecWebSocketAccept\r\n\r\n";
        /**/

        /*
        echo "Connected\n";
        $in = socket_read($con, 100);
        $res = unpack('ncode/Nsize/a*val', $in);
        print_r($res);

        $data = sha1('test');
        echo "\nData {$data} \n";
        $body = pack('a*', $data);
        $sent = socket_write($con, $body);
        echo "Sent = {$sent} \n";
        /**/
    }
}

//echo "Error: " . socket_strerror(socket_last_error()) . "\n";


