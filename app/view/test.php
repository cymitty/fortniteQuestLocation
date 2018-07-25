<?php
// $questsTree

?>
<style>
  .map {
    position: relative;
    overflow: hidden;
  }
  .map-pointer {
    position: absolute;
    width: 5px;
    height: 5px;
    background-color: black;
  }
</style>
<div class="pointers">

</div>

<div class="map">
<div class="map-pointer"></div>
</div>
<!--<div class="add-new-pointer">Добавить новый pointer</div>-->

<div class="quests">
    <?php for ($i = 1; $i <= 10; $i++): ?>

      <ul class="quest-list">
        Задания <?= $i ?>ой недели
        <?php foreach ($questsTree as $item): ?>
          <?php if ($item['week'] == $i): ?>
            <li class="quest-list-item gg" data-id="<?= $item['id'] ?>" hidden><?= $item['name'] ?></li>
          <?php endif; ?>
        <?php endforeach; ?>
        <p>drisnya</p>
      </ul>

    <?php endfor; ?>
</div>
<script type="text/javascript" src="/assets/js/main.js"></script>