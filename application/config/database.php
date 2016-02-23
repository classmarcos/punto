<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$active_group = 'prueba';
$active_record = TRUE;

// Nuestra primera base de datos y principal:
$db['default']['dns'] = '';
$db['default']['hostname'] = '';
$db['default']['username'] = '';
$db['default']['password'] = '';
$db['default']['database'] = '';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE; # Recomendado para poder trabajar con ambas conexiones en paralelo
$db['default']['db_debug'] = (ENVIRONMENT !== 'production');
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['encrypt'] = FALSE;
$db['default']['compress'] = FALSE;
$db['default']['stricton'] = FALSE;
$db['default']['failover'] = array();
$db['default']['save_queries'] = TRUE;

// Nuestra sefunda base de datos y principal:
$db['prueba']['dns'] = '';
$db['prueba']['hostname'] = '';
$db['prueba']['username'] = '';
$db['prueba']['password'] = '';
$db['prueba']['database'] = '';
$db['prueba']['dbdriver'] = 'mysqli';
$db['prueba']['dbprefix'] = '';
$db['prueba']['pconnect'] = FALSE; # Recomendado para poder trabajar con ambas conexiones en paralelo
$db['prueba']['db_debug'] = (ENVIRONMENT !== 'production');
$db['prueba']['cache_on'] = FALSE;
$db['prueba']['cachedir'] = '';
$db['prueba']['char_set'] = 'utf8';
$db['prueba']['dbcollat'] = 'utf8_general_ci';
$db['prueba']['swap_pre'] = '';
$db['prueba']['encrypt'] = FALSE;
$db['prueba']['compress'] = FALSE;
$db['prueba']['stricton'] = FALSE;
$db['prueba']['failover'] = array();
$db['prueba']['save_queries'] = TRUE;

