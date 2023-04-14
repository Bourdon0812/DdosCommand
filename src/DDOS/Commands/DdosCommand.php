<?php

namespace DDOS\Commands;

use DDOS\Utils\DdosManager;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class DdosCommand extends Command {

    /**
     * ddos constructor.
     */
    public function __construct() {
        parent::__construct("ddos", "usage : /ddos [ip] [port]");
    }

    /**
     * @param CommandSender $player
     * @param string $commandLabel
     * @param array $args
     * @return mixed|void
     */
    public function execute(CommandSender $player, string $commandLabel, array $args) {
        if(!isset($args[1])) {
            $player->sendMessage("Veuillez bien entrer l'ip et le port");
            return;
        }

        $adresse = new DdosManager("{$args[0]}", $args[1]);
        $adresse->startDdos();
    }

}
