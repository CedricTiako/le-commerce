<?php

/**
 * Fonctions d'affichage partagées entre les vues publiques (Accueil, Le Bar...)
 */

if (!function_exists('beerGlass')) {
    function beerGlass(string $tone = 'amber'): string
    {
        $palette = [
            'amber' => ['#f0a83c', '#d6862a'],
            'dark'  => ['#4a2c1c', '#2f1b10'],
            'copper'=> ['#c9702e', '#a5551c'],
            'gold'  => ['#f4c542', '#dba526'],
        ][$tone] ?? ['#f0a83c', '#d6862a'];

        return '
        <svg viewBox="0 0 60 80" class="w-12 h-16 mx-auto">
          <path d="M14 14 h32 l-3 54 a4 4 0 0 1-4 4 H21 a4 4 0 0 1-4-4 Z" fill="' . $palette[0] . '" stroke="' . $palette[1] . '" stroke-width="1.5"/>
          <path d="M12 10 h36 a2 2 0 0 1 2 2.4 l-1 3.6 H11 l-1-3.6 A2 2 0 0 1 12 10Z" fill="#fdf6e8" stroke="#e8dcc0" stroke-width="1"/>
          <ellipse cx="30" cy="10.5" rx="18" ry="3.2" fill="#fffdf8"/>
        </svg>';
    }
}

/**
 * Fonction de mapping catégorie boisson -> teinte du verre stylisé
 */
if (!function_exists('drinkTone')) {
    function drinkTone(string $category): string
    {
        return [
            'biere_blonde' => 'amber',
            'biere_brune'  => 'dark',
            'biere_ambree' => 'copper',
        ][$category] ?? 'gold';
    }
}
