<?php
/**
 * Configuration générale de l'application
 */

return [
    'name'        => 'Le Commerce',
    'baseline'    => 'BAR · TABAC · PMU · FDJ · PRESSE · NIRIO',
    'url'         => getenv('APP_URL') ?: 'http://localhost:8000',
    'env'         => getenv('APP_ENV') ?: 'development',
    'debug'       => true,
    'timezone'    => 'Europe/Paris',
    'locale'      => 'fr',

    // Informations de l'établissement (affichées dans header/footer)
    'shop' => [
        'name'      => 'Le Commerce',
        'address'   => '3 Rue du Maréchal Leclerc',
        'zipcode'   => '76440',
        'city'      => 'Forges-les-Eaux',
        'phone'     => '02 35 90 50 16',
        'phone_href'=> '+33235905016',
        'email'     => 'lecommercetabac@gmail.com',
        'hours' => [
            'lun_sam' => '6h40 - 20h30',
            'dim'     => '6h40 - 20h00',
        ],
        'social' => [
            'facebook'  => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
        ],
        'google_rating' => 4.8,
        'google_reviews_count' => 230,
        // Coordonnées GPS du commerce, utilisées pour le calcul de distance
        // dans le module Zonage & Proximité (Lot 7).
        'latitude'  => 49.6136,
        'longitude' => 1.5399,
    ],
];
