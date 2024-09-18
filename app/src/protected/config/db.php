<?php

return [
  'connectionString'   => 'mysql:host=' . getenv('DOCKERHOSTIP') . ';dbname=' . getenv('MYSQL_DATABASE') . ';port=' . getenv('MYSQL_PORT'),
  'emulatePrepare'     => true,
  'username'           => getenv('MYSQL_USER'),
  'password'           => getenv('MYSQL_PASSWORD'),
  'charset'            => 'utf8',
  'enableParamLogging' => true,
  // 'pdoClass' => 'NestedPDO',
];
