<?php

declare(strict_types=1);

namespace Dungeon;

/**
 * Un duel tour par tour entre deux Fighter. Bonus niveau 5.
 * Le dé est reçu en paramètre au lieu d'être fabriqué ici : c'est ce qui rend
 * le combat testable (on peut lui donner un dé truqué).
 */
final class Battle
{
    public function __construct(
        private readonly Fighter $a,
        private readonly Fighter $b,
        private readonly Dice $dice,
    ) {}

    /**
     * Doit dérouler le combat et renvoyer le vainqueur.
     * Règle : $a frappe en premier, les dégâts valent attack() + un lancer de dé ;
     * on s'arrête dès qu'un des deux n'est plus en vie.
     */
    public function fight(): Fighter
    {
        do {
            // $a attaque $b
            $damage = $this->a->attack() + $this->dice->roll();
            $this->b->takeDamage($damage);

            // Si $b est mort, on ne fait pas attaquer $b
            if (!$this->b->isAlive()) {
                return $this->a;
            }

            // $b attaque $a
            $damage = $this->b->attack() + $this->dice->roll();
            $this->a->takeDamage($damage);
        } while ($this->a->isAlive() && $this->b->isAlive());

        return $this->a->isAlive() ? $this->a : $this->b;
    }
}
