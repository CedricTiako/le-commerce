<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;

class AdminPlaceholderController extends Controller
{
    /**
     * Libellés humains des sections admin à venir (Lots 6 à 10).
     * Toute section absente de cette liste renvoie une 404 classique.
     */
    private const SECTIONS = [
        'etablissement' => 'Mon établissement',
        'services'      => 'Services du quotidien',
        'portefeuilles' => 'Portefeuille client',
        'messages'      => 'Messages & WhatsApp',
        'reservations'  => 'Réservations',
    ];

    public function show(string $section): void
    {
        Middleware::requireRole('admin');

        if (!isset(self::SECTIONS[$section])) {
            http_response_code(404);
            require dirname(__DIR__, 2) . '/Views/errors/404.php';
            return;
        }

        $label = self::SECTIONS[$section];

        $this->view('admin/placeholder', [
            'title'     => $label . ' — Administration Le Commerce',
            'pageTitle' => $label,
            'heading'   => $label,
        ], 'admin');
    }
}
