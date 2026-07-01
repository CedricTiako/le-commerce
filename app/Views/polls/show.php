<?php use App\Core\Csrf; ?>

<a href="<?= BASE_PATH ?>/mon-compte/sondages" class="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-500 hover:text-brand-500 mb-4">
  <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
  Retour aux sondages
</a>

<div class="max-w-xl bg-white border border-gray-100 rounded-2xl p-6 sm:p-8">
  <h1 class="font-extrabold text-2xl text-ink mb-1"><?= htmlspecialchars($poll['question']) ?></h1>
  <?php if ($poll['description']): ?><p class="text-gray-500 text-sm mb-6"><?= htmlspecialchars($poll['description']) ?></p><?php endif; ?>

  <?php if ($hasVoted): ?>
    <div class="flex items-center gap-2 bg-emerald-50 text-emerald-700 border border-emerald-100 rounded-lg px-4 py-3 text-sm mb-6">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
      Merci, vous avez déjà participé à ce sondage !
    </div>

    <div class="space-y-4">
      <?php foreach ($options as $opt): ?>
        <?php $pct = $total > 0 ? round(($opt['votes_count'] / $total) * 100) : 0; ?>
        <?php $isMine = (int) $opt['id'] === (int) $votedOptionId; ?>
        <div>
          <div class="flex justify-between text-sm mb-1.5">
            <span class="font-semibold <?= $isMine ? 'text-brand-600' : 'text-ink' ?>">
              <?= htmlspecialchars($opt['label']) ?> <?= $isMine ? '· votre choix' : '' ?>
            </span>
            <span class="text-gray-500"><?= $pct ?>%</span>
          </div>
          <div class="w-full bg-gray-100 rounded-full h-3">
            <div class="<?= $isMine ? 'bg-brand-500' : 'bg-gray-300' ?> h-3 rounded-full transition-all" style="width: <?= $pct ?>%"></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <p class="text-xs text-gray-400 mt-5"><?= $total ?> participation<?= $total > 1 ? 's' : '' ?> au total</p>

  <?php else: ?>
    <form method="POST" action="<?= BASE_PATH ?>/mon-compte/sondages/<?= $poll['id'] ?>/voter" class="space-y-3">
      <?= Csrf::field() ?>
      <?php foreach ($options as $opt): ?>
        <label class="block relative cursor-pointer">
          <input type="radio" name="option_id" value="<?= $opt['id'] ?>" required class="peer sr-only">
          <div class="border-2 border-gray-200 peer-checked:border-brand-500 peer-checked:bg-brand-50 peer-checked:text-brand-600 rounded-lg px-4 py-3.5 font-medium text-sm text-ink transition-colors">
            <?= htmlspecialchars($opt['label']) ?>
          </div>
        </label>
      <?php endforeach; ?>

      <?php if ($poll['reward_type'] !== 'aucune'): ?>
        <p class="text-xs text-emerald-600 font-semibold flex items-center gap-1.5 pt-1">
          🎁 Récompense de participation : <?= htmlspecialchars($rewardLabels[$poll['reward_type']]) ?>
          <?php if ($poll['reward_value'] && $poll['reward_type'] !== 'tirage_sort'): ?>
            (<?= $poll['reward_type'] === 'credit' ? number_format($poll['reward_value'], 2, ',', ' ') . ' €' : (int) $poll['reward_value'] . ' pts' ?>)
          <?php endif; ?>
        </p>
      <?php endif; ?>

      <button type="submit" class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold text-sm px-6 py-3.5 rounded-lg transition-colors mt-2">
        Voter
      </button>
    </form>
  <?php endif; ?>
</div>
