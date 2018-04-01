<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<div class="errors"><?php foreach ($errors as $error) echo "<p>" . $error . "</p>" ?></div>
<form action="register.php" method="POST">
  <input type="text" name="name" placeholder="name" required>
  <input type="text" name="lastname" placeholder="lastname" required>
  <input type="text" name="email" placeholder="email" required>
  <input type="text" name="groupnumber" placeholder="groupnumber" required>
  <input type="text" name="points" placeholder="points" required>
  <input type="text" name="birthyear" placeholder="birthyear" required>
  <!--  <input type="password" name="password" placeholder="password">-->
  <input type="submit">
</form>

</body>
</html>
<?php
