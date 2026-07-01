<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Models\Offer;
use App\Models\ProximityCampaign;

class AdminProximityController extends Controller
{
    public function index(): void
    {
        Middleware::requireRole('admin');

        $this->view('admin/proximity/index', [
            'title'     => 'Zonage & Proximité — Administration Le Commerce',
            'pageTitle' => 'Zonage & Proximité',

            'campaigns'       => ProximityCampaign::listWithOffer(),
            'campaignsActive' => ProximityCampaign::countByStatus('active'),
            'totalSent'       => ProximityCampaign::totalSent(),
            'totalUsed'       => ProximityCampaign::totalUsed(),

            'segmentLabels' => ProximityCampaign::SEGMENT_LABELS,
            'activeOffers'  => Offer::activeForSelect(),
            'shopLat'       => $this->sharedData['shop']['latitude'],
            'shopLng'       => $this->sharedData['shop']['longitude'],
        ], 'admin');
    }

    public function store(): void
    {
        Middleware::requireRole('admin');
        $this->verifyCsrf();

        $name      = trim((string) $this->input('name', ''));
        $radius    = (int) $this->input('radius_m', 500);
        $startTime = (string) $this->input('start_time', '');
        $endTime   = (string) $this->input('end_time', '');
        $days      = array_filter((array) $this->input('days', []));
        $segment   = (string) $this->input('target_segment', 'tous');
        $offerId   = $this->input('offer_id', '');
        $message   = trim((string) $this->input('message', ''));
        $publish   = $this->input('publish') ? 'active' : 'en_pause';

        $errors = [];
        if ($name === '' || mb_strlen($name) > 120) {
            $errors[] = 'Le nom de la campagne est obligatoire (120 caractères maximum).';
        }
        if ($radius < 100 || $radius > 5000) {
            $errors[] = 'Le rayon doit être compris entre 100 m et 5 km.';
        }
        if ($startTime === '' || $endTime === '' || $startTime >= $endTime) {
            $errors[] = 'La plage horaire est invalide (heure de fin après heure de début).';
        }
        if (empty($days)) {
            $errors[] = 'Merci de sélectionner au moins un jour de diffusion.';
        }
        if ($message === '' || mb_strlen($message) > 160) {
            $errors[] = 'Le message est obligatoire (160 caractères maximum).';
        }

        if ($errors) {
            $this->setFlash('error', implode(' ', $errors));
            $this->redirect('/admin/zonage');
            return;
        }

        ProximityCampaign::create([
            'name'           => $name,
            'radius_m'       => $radius,
            'start_time'     => $startTime,
            'end_time'       => $endTime,
            'days'           => implode(',', $days),
            'target_segment' => $segment,
            'offer_id'       => $offerId !== '' ? (int) $offerId : null,
            'message'        => $message,
            'status'         => $publish,
        ]);

        $this->setFlash('success', 'La campagne "' . $name . '" a bien été créée.');
        $this->redirect('/admin/zonage');
    }

    public function toggleStatus(int $id): void
    {
        Middleware::requireRole('admin');
        $this->verifyCsrf();

        $campaign = ProximityCampaign::find($id);
        if (!$campaign) {
            $this->setFlash('error', 'Campagne introuvable.');
            $this->redirect('/admin/zonage');
            return;
        }

        $newStatus = $campaign['status'] === 'active' ? 'en_pause' : 'active';
        ProximityCampaign::update($id, ['status' => $newStatus]);

        $this->setFlash('success', 'Statut de la campagne mis à jour.');
        $this->redirect('/admin/zonage');
    }
}
