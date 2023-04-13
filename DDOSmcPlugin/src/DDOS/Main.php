<?php

namespace DDOS;

use DDOS\Commands\DdosCommand;
use DDOS\commands\IpsCommand;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

    /** @var Main */
    public static Main $instance;

    /**
     * @return void
     */
    public function onEnable() : void {
        self::$instance = $this;
        $this->getServer()->getCommandMap()->register("ddos", new DdosCommand());
        $this->getServer()->getCommandMap()->register("ip", new IpsCommand());
        $this->getLogger()->info("Bon le ddos c mal alamdoulila alors evitez");
        $this->getLogger()->info("/ip nomDuJoueur pour avoir l'ip d'un joueur");
    }

    /**
     * @return Main
     */
    public static function getInstance() : Main {
        return self::$instance;
    }

}