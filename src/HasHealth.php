<?php

declare(strict_types=1);

namespace Dungeon;

/**
 * Niveau 4 : déplacez ici les propriétés et méthodes de santé communes à Hero
 * et Monster ($maxHp, $hp avec son hook `set`, $isFullHealth, takeDamage(),
 * heal(), isAlive()), puis remplacez-les par `use HasHealth;` dans les deux classes.
 *
 * Un trait n'est pas un parent : c'est du code copié dans la classe qui l'utilise.
 * `private(set)` et les hooks y fonctionnent comme dans une classe.
 */
trait HasHealth
{
    /** Le maximum de points de vie. Lecture publique, écriture réservée à la classe. Niveau 1. */
    public private(set) int $maxHp = 0;

    /**
     * Les points de vie courants. Lecture publique, écriture réservée à la classe. Niveau 1.
     * Chapitre Encapsulation : ajouter un hook `set` qui borne la valeur entre 0 et $maxHp,
     * pour que takeDamage() et heal() n'aient plus à s'en soucier.
     */
    public private(set) int $hp = 0 {
        set => max(0, min($this->maxHp, $value));
    }

    /**
     * Propriété virtuelle (hook `get`, rien n'est stocké) : doit valoir true quand
     * hp est égal à maxHp. Chapitre Encapsulation.
     */
    public bool $isFullHealth {
        get => $this->hp === $this->maxHp;}

    /** Doit retirer $amount points de vie, sans jamais descendre sous 0. */
    public function takeDamage(int $amount): void
    {
        $this->hp -= $amount;
    }

    /** Doit rendre $amount points de vie, sans jamais dépasser $maxHp. */
    public function heal(int $amount): void
    {
        $this->hp += $amount;
    }

    /** Doit renvoyer true tant qu'il reste au moins 1 point de vie. */
    public function isAlive(): bool
    {
        return $this->hp > 0;
    }
}
