<?php

return [
  'connectionString'   => 'mysql:host='.getenv('DOCKERHOSTIP').';dbname=ahadpos3;port=3307',
  'emulatePrepare'     => true,
  'username'           => 'admin',
  'password'           => 'adminpassword',
  'charset'            => 'utf8',
  'enableParamLogging' => true,
  // 'pdoClass' => 'NestedPDO',
];
