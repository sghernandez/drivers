<?php

// ======================= LOGIN Y SEGURIDAD ==========================================================

$config['attempts'] = 10; // cantidad de intentos permitidos al intentar loguearse
$config['minutes']= 5; // minutos que deberá esperar el usuario para intentar loguearse después de haber excedido los intentos        
$config['login_activo'] = TRUE; // para evitar múltiples sesiones...
$config['timeout'] = TRUE; // para cerrar la sesión luego de que haya transcurrido: $config['minutos_inactividad']
$config['minutos_inactividad'] = 5; // minutos limite para cerrar la sesión por inactividad
