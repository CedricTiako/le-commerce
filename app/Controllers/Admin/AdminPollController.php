<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Middleware;
use App\Models\Poll;
use App\Models\PollOption;

class AdminPollController extends Controller
{
    public function index(): void
    {
        Middleware::requireRole('admin');

        $statusFilter = (string) $this->input('statut', 'actifs');
        $statusMap = ['actifs' => 'actif', 'programmes' => 'programme', 'termines' => 'termine', 'tous' => null];
        $status = $statusMap[$statusFilter] ?? 'actif';

        $featured = Poll::featured();
        $featuredOptions = $featured ? PollOption::forPoll($featured['id']) : [];
        $featuredTotal = array_sum(array_column($featuredOptions, 'votes_count'));

        $this->view('admin/polls/index', [
            'title'     => 'Sondages & Votes — Administration Le Commerce',
            'pageTitle' => 'Sondages & Votes',

            'polls'      => Poll::listWithStats($status),
            'activeTab'  => $statusFilter,

            'pollsActive'   => Poll::countByStatus('actif'),
            'pollsDelta'    => Poll::countCreatedThisMonth(),
            'totalParticipations' => Poll::totalParticipations(),
            'participationRate'  => Poll::averageParticipationRate(),
            'rewardsGiven'  => Poll::totalRewardsGiven(),

            'featured'        => $featured,
            'featuredOptions' => $featuredOptions,
            'featuredTotal'   => $featuredTotal,

            'rewardLabels' => Poll::REWARD_LABELS,
        ], 'admin');
    }

    public function create(): void
    {
        Middleware::requireRole('admin');

        $this->view('admin/polls/create', [
            'title'      => 'Créer un sondage — Administration Le Commerce',
            'pageTitle'  => 'Créer un nouveau sondage',
            'rewardLabels' => Poll::REWARD_LABELS,
            'errors' => [],
            'old'    => [],
        ], 'admin');
    }

    public function store(): void
    {
        Middleware::requireRole('admin');
        $this->verifyCsrf();

        $question    = trim((string) $this->input('question', ''));
        $description = trim((string) $this->input('description', ''));
        $endsAt      = (string) $this->input('ends_at', '');
        $rewardType  = (string) $this->input('reward_type', 'aucune');
        $rewardValue = $this->input('reward_value', '');
        $options     = array_filter(array_map('trim', (array) $this->input('options', [])));
        $publish     = $this->input('publish') ? 'actif' : 'programme';

        $errors = [];
        if ($question === '' || mb_strlen($question) > 180) {
            $errors['question'] = 'La question est obligatoire (180 caractères maximum).';
        }
        if (count($options) < 2) {
            $errors['options'] = 'Merci de proposer au moins 2 options de réponse.';
        }
        if ($endsAt === '' || strtotime($endsAt) === false || strtotime($endsAt) < strtotime('today')) {
            $errors['ends_at'] = 'La date de fin doit être aujourd\'hui ou une date future.';
        }
        if (!array_key_exists($rewardType, Poll::REWARD_LABELS)) {
            $errors['reward_type'] = 'Type de récompense invalide.';
        }
        if ($rewardType !== 'aucune' && $rewardType !== 'tirage_sort' && (!is_numeric($rewardValue) || (float) $rewardValue < 0)) {
            $errors['reward_value'] = 'Merci d\'indiquer une valeur de récompense valide.';
        }

        if ($errors) {
            $this->view('admin/polls/create', [
                'title'      => 'Créer un sondage — Administration Le Commerce',
                'pageTitle'  => 'Créer un nouveau sondage',
                'rewardLabels' => Poll::REWARD_LABELS,
                'errors' => $errors,
                'old'    => compact('question', 'description', 'endsAt', 'rewardType', 'rewardValue', 'options'),
            ], 'admin');
            return;
        }

        $pollId = Poll::create([
            'question'     => $question,
            'description'  => $description ?: null,
            'ends_at'      => date('Y-m-d', strtotime($endsAt)),
            'status'       => $publish,
            'reward_type'  => $rewardType,
            'reward_value' => $rewardType === 'aucune' ? null : (float) ($rewardValue ?: 0),
        ]);

        PollOption::createMany($pollId, $options);

        $this->setFlash('success', 'Le sondage "' . $question . '" a bien été créé.');
        $this->redirect('/admin/sondages');
    }

    public function results(int $id): void
    {
        Middleware::requireRole('admin');

        $poll = Poll::find($id);
        if (!$poll) {
            $this->setFlash('error', 'Sondage introuvable.');
            $this->redirect('/admin/sondages');
            return;
        }

        $options = PollOption::forPoll($id);
        $total = array_sum(array_column($options, 'votes_count'));

        $this->view('admin/polls/results', [
            'title'     => 'Résultats — ' . $poll['question'],
            'pageTitle' => 'Résultats du sondage',
            'poll'      => $poll,
            'options'   => $options,
            'total'     => $total,
        ], 'admin');
    }

    public function toggleStatus(int $id): void
    {
        Middleware::requireRole('admin');
        $this->verifyCsrf();

        $poll = Poll::find($id);
        if (!$poll) {
            $this->setFlash('error', 'Sondage introuvable.');
            $this->redirect('/admin/sondages');
            return;
        }

        $newStatus = $poll['status'] === 'actif' ? 'termine' : 'actif';
        Poll::update($id, ['status' => $newStatus]);

        $this->setFlash('success', 'Statut du sondage mis à jour.');
        $this->redirect('/admin/sondages');
    }
}
