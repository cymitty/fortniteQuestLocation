<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
<!--  <link rel="stylesheet" href="/assets/css/normalize.css">-->
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/global.css">
</head>
<body>
  <header class="main-menu container-fluid">
    <nav>
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link active" href="/">Список студентов</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/register.php">Регистрация</a>
        </li>
      </ul>
    </nav>
  </header>
  <main>
    <?php if ( !empty( $errors ) ): ?>
      <div class="container-fluid">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <?php foreach ($errors as $error) echo "<p>" . $error . "</p>" ?>
        </div>
      </div>
    <?php endif; ?>
    <?php if ( !empty($notifies) ): ?>
    <div class="container-fluid">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <?php foreach ($notifies as $notify) echo $notify; ?>
      </div>
    </div>
    <?php endif; ?>
