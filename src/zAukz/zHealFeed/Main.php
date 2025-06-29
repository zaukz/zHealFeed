<?php

namespace zAukz\zHealFeed;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->getLogger()->info("zHealFeed enabled.");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if (!$sender instanceof Player) {
            $sender->sendMessage("This command can only be used in-game.");
            return true;
        }

        switch (strtolower($command->getName())) {
            case "heal":
                $sender->setHealth($sender->getMaxHealth());
                $sender->sendMessage($this->getConfig()->get("heal-message"));
                return true;

            case "feed":
                $sender->getHungerManager()->setFood(20);
                $sender->sendMessage($this->getConfig()->get("feed-message"));
                return true;
        }
        return false;
    }
}
