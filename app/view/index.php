<?php
// $questsTree

?>


<link rel="stylesheet" href="/assets/css/global.css">


<div class="xhr-response">
</div>
<div class="pointers">

</div>

<div class="quests">
    <div class='weekly'>
        <div class='quest-desc'>
            <i class="toggle"></i>
            <p>Еженедельные испытания</p>
        </div>
        <?php for ($i = 1; $i <= 10; $i++): ?>

            <ul class="quest-list">
                <header>Задания <span style="color: #fff;"><?= $i ?></span> недели</header>
                <?php foreach ($questsTree as $item): ?>
                    <?php if ($item['week'] == $i): ?>
                        <div data-id="<?= $item['id'] ?>" class="quest-list-item" hidden><li><?= $item['name'] ?></li></div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

        <?php endfor; ?>
    </div>
</div>

<div class="map">
  <img src="/assets/img/fortnite-map.jpg" alt="">
    <div class="map-pointer">
<!--      <img src="/assets/img/map-pointer.jpg" alt="">-->
    </div>
</div>

<script type="text/javascript" src="/assets/js/app.js"></script>