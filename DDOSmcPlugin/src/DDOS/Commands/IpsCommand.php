<?php

namespace DDOS\commands;

use DDOS\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class IpsCommand extends Command {

    public function __construct() {
        parent::__construct("ip", "usage : /ip [player]");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {
        if(count($args) < 1) {
            $sender->sendMessage("§cUsage: /ip player");
            return false;
        }

        $player = Main::getInstance()->getServer()->getPlayerExact($args[0]);

        if($player === null) {
            $sender->sendMessage("§cJoueur non connecté");
            return false;
        }

        $sender->sendMessage("§aL'ip de " . $player->getName() . " est" . $player->getNetworkSession()->getIp());
        $sender->sendMessage("§aLe port avec lequel " . $player->getName() . " est connecté est " . $player->getNetworkSession()->getPort());
        return true;
    }

}