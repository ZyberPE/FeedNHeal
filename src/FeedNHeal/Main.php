<?php

namespace FeedNHeal;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->info("FeedNHeal enabled!");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {

        if (!$sender instanceof Player) {
            $sender->sendMessage("§cUse this command in-game.");
            return true;
        }

        switch ($command->getName()) {

            case "feed":
                if (!$sender->hasPermission("feed.use")) {
                    $sender->sendMessage("§cYou do not have permission.");
                    return true;
                }

                $sender->getHungerManager()->setFood(20);
                $sender->getHungerManager()->setSaturation(20.0);
                $sender->sendMessage("§aHunger successfully restored.");
                return true;

            case "heal":
                if (!$sender->hasPermission("heal.use")) {
                    $sender->sendMessage("§cYou do not have permission.");
                    return true;
                }

                $sender->setHealth($sender->getMaxHealth());
                $sender->sendMessage("§aHealed successfully.");
                return true;
        }

        return false;
    }
}
