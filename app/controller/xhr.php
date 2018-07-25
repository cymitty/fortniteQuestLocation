<?php
$request = file_get_contents('php://input');
$coordinates = json_decode($request);
echo $coordinates->id;