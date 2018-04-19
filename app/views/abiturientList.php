<style>
  .abiturient {
    padding: 7px;
  }
  .pages a {
    margin-right: 10px;
  }
</style>
<div class="abiturient-list container">
  <div class="container">
    <div class="row" style="align-items: baseline">
      <div class="col-md-5">
        <h1 style="text-align: left;">Список абитуриентов</h1>
      </div>
      <div class="col-md-7 align-baseline text-right" >
        <form action="/search.php" method="get">
          <label for="inputSearch">Поиск</label>
          <input type="text" name="search" id="inputSearch" value="<?php if (isset($search)) echo htmlspecialchars($search) ?>">
          <input type="submit" value="Найти" >
        </form>
      </div>
      <?php if ( isset($search) && $search != '' ): ?>
      <div class="search col-md-12">
        <div class="search-info">Показаны только абитуриенты, найденные по запросу <?= '"' . htmlspecialchars($search) . '"'?>.</div>
        <div><a href="/index.php">[Показать всех абитуриентов]</a></div>
      </div>
      <?php endif; ?>
    </div>
  </div>


  <table class="student-list table table-striped table-bordered" style="width: 100%">
    <thead class="" style="background-color: #117a8b">
    <tr>
      <th style="<?php if ( isset($order) && $order == 'name' ) echo 'background-color: #4db6c8;' ?>">
        <a href="<?= $OrderNameLink ?>">Имя</a><a href="<?= $SortNameLink ?>">[q]</a>
      </th>
      <th style="<?php if ( isset($order) && $order == 'lastname' ) echo 'background-color: #4db6c8;' ?>">
        <a href="<?= $OrderLastNameLink ?>">Фамилия</a><a href="<?= $SortLastNameLink ?>">[q]</a>
      </th>
      <th style="<?php if ( isset($order) && $order == 'birthyear' ) echo 'background-color: #4db6c8;' ?>">
        <a href="<?= $OrderBirthYearLink ?>">Год рождения</a><a href="<?= $SortBirthYearLink ?>">[q]</a>
      </th>
      <th style="<?php if ( isset($order) && $order == 'groupnumber' ) echo 'background-color: #4db6c8;' ?>">
        <a href="<?= $OrderGroupNumberLink ?>">Номер группы</a><a href="<?= $SortGroupNumberLink ?>">[q]</a>
      </th>
      <th style="<?php if ( isset($order) && $order == 'points' || !isset($order) ) decho 'background-color: #4db6c8;' ?>">
        <a href="<?= $OrderPointsLink ?>">ЕГЭ</a><a href="<?= $SortPointsLink ?>">[q]</a>
      </th>
    </tr>
    </thead>
    <tbody>
      <?php foreach ( $abiturients as $abiturient) : ?>
      <tr>
        <td><?= htmlspecialchars( $abiturient->getName() ) ?></td>
        <td><?= htmlspecialchars( $abiturient->getLastName() ) ?></td>
        <td><?= htmlspecialchars( $abiturient->getBirthYear() ) ?></td>
        <td><?= htmlspecialchars( $abiturient->getGroupNumber() ) ?></td>
        <td><?= htmlspecialchars( $abiturient->getPoints() ) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <nav>
    <ul class="pagination ">
      <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1">Previous</a>
      </li>
      <?php foreach ($pages as $pageNumber => $pageLink): ?>
        <li class="page-item"><a class="page-link" href="<?= $pageLink ?>"><?= $pageNumber ?></a></li>
      <?php endforeach; ?>
      <li class="page-item">
        <a class="page-link" href="#">Next</a>
      </li>
    </ul>
  </nav>
</div>

