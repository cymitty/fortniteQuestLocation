<div class="register container-fluid">
  <?php if ( $abiturient->getPassword() ) : ?>
  <h1>Изменить информацию о себе</h1>
  <?php else: ?>
    <h1>Регистрация Абитуриента</h1>
  <?php endif; ?>
  <form action="/register.php" method="POST" style="max-width: 650px; margin: 0 auto;">
    <div class="form-group">
      <label for="InputName">Имя*</label>
      <input type="text" name="name" class="form-control" id="InputName"  placeholder="Имя" value="<?= htmlspecialchars($abiturient->getName())?>" required>
    </div>
    <div class="form-group">
      <label for="InputLastName">Фамилия*</label>
      <input type="text" name="lastname" class="form-control" id="InputLastName" placeholder="Фамилия" value="<?= htmlspecialchars($abiturient->getLastName()) ?>" required>
    </div>
    <div class="form-group">
      <label for="InputBirthYear">Год рождения</label>
      <input type="text" name="birthyear" class="form-control" id="InputBirthYear" placeholder="Год рождения" value="<?= htmlspecialchars($abiturient->getBirthYear()) ?>" required>
    </div>
    <div class="form-group">
      <label for="InputEmail">Почта*</label>
      <input type="email" name="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="Почта" value="<?= htmlspecialchars($abiturient->getEmail()) ?>" required>
      <small id="emailHelp" class="form-text text-muted">Не беспокойтесь, мы никому не передаём адресс вашей электронной почты</small>
    </div>
    <div class="form-group">
      <label for="InputGroupNumber">Номер группы*</label>
      <input type="text" name="groupnumber" class="form-control" id="InputGroupNumber" placeholder="Группа" value="<?= htmlspecialchars($abiturient->getGroupNumber()) ?>" required>
    </div>
    <div class="form-group">
      <label for="InputPoints">Суммарное количество баллов ЕГЭ*</label>
      <input type="text" name="points" class="form-control" id="InputPoints" placeholder="Баллы" value="<?= htmlspecialchars($abiturient->getPoints()) ?>" required>
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
      <label class="form-check-label" for="exampleCheck1">Согласен на обработку моих персональных данных</label>
    </div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
  </form>
</div>