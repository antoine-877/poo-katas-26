<?php

declare(strict_types=1);

namespace Dungeon;

use InvalidArgumentException;

final class Game
{


    private Hero $hero;

    public function run(): void
    {
        echo "=== Le Donjon ===\n";

        do {
            echo "Comment s'appelle votre héros ? ";
            $name = trim(fgets(STDIN));

            try {
                $this->hero = new Hero($name);
            } catch (InvalidArgumentException) {
                continue;
            }

            break;
        } while (true);

        echo "Bienvenue, {$this->hero}.\n";
    }
}
