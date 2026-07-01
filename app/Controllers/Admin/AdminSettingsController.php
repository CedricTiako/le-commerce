<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Models\Settings;

class AdminSettingsController extends Controller
{
    public function index(): void
    {
        Middleware::requireRole('admin');

        $this->view('admin/settings/index', [
            'title'     => 'Paramètres — Administration Le Commerce',
            'pageTitle' => 'Paramètres',
        ], 'admin');
    }

    public function update(): void
    {
        Middleware::requireRole('admin');
        $this->verifyCsrf();

        $data = [
            'shop_name'        => trim((string) $this->input('shop_name', '')),
            'shop_address'     => trim((string) $this->input('shop_address', '')),
            'shop_zipcode'     => trim((string) $this->input('shop_zipcode', '')),
            'shop_city'        => trim((string) $this->input('shop_city', '')),
            'shop_phone'       => trim((string) $this->input('shop_phone', '')),
            'shop_email'       => trim((string) $this->input('shop_email', '')),
            'hours_lun_sam'    => trim((string) $this->input('hours_lun_sam', '')),
            'hours_dim'        => trim((string) $this->input('hours_dim', '')),
            'social_facebook'  => trim((string) $this->input('social_facebook', '')),
            'social_instagram' => trim((string) $this->input('social_instagram', '')),
            'latitude'         => trim((string) $this->input('latitude', '')),
            'longitude'        => trim((string) $this->input('longitude', '')),
        ];

        if ($data['shop_name'] === '' || $data['shop_email'] === '' || !filter_var($data['shop_email'], FILTER_VALIDATE_EMAIL)) {
            $this->setFlash('error', 'Le nom et une adresse e-mail valide sont obligatoires.');
            $this->redirect('/admin/parametres');
            return;
        }

        Settings::updateMany($data);

        $this->setFlash('success', 'Paramètres mis à jour avec succès.');
        $this->redirect('/admin/parametres');
    }
}
