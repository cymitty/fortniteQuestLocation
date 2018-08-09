<?php
// $questsTree
?>
<link rel="stylesheet" href="/assets/css/global.css">

<div class="map">
  <img src="/assets/img/fortnite-map.jpg" alt="">
  <div class="map-pointer">
    <!--      <img src="/assets/img/map-pointer.jpg" alt="">-->
  </div>
</div>

<div class="notify" hidden>
  click по quest-item`у -> click по карте
</div>
<div class="xhr-response">
</div>


<!--<div class="add-new-pointer">Добавить новый pointer</div>-->

<div class="quests-toggle">
  Выбрать задание
</div>

<div class="quests" hidden>
  <div class='weekly'>
    <div class='quest-desc'>
      <i class="toggle"></i>
      <p>Еженедельные испытания</p>
    </div>
      <?php for ($i = 1; $i <= 10; $i++): ?>

        <ul class="quest-list">
          <header>Задания <span style="color: #fff;"><?= $i ?></span> недели</header>
            <?php foreach ($data['questsTree'] as $item): ?>
                <?php if ($item['week'] == $i): ?>
                <div class="quest-list-item hidden">
                  <li data-id="<?= $item['id']; ?>"><?= $item['name'] ?></li>
                  <div class="add-new-quest-location" data-id="<?= $item['id']; ?>">Предложить метку для квеста</div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>

      <?php endfor; ?>
  </div>
</div>
<script type="text/javascript" src="/assets/js/app.js"></script>