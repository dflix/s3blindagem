<?php
/*
 * @author Cesar Szpak - Celke - cesar@celke.com.br
 * @pagina desenvolvida usando FullCalendar,
 * o código é aberto e o uso é free,
 * porém lembre-se de conceder os créditos ao desenvolvedor.
 */

define('HOST', 'www.hgmrastreadores.com.br');
define('USER', 'hgmras52_autocenter');
define('PASS', 'dflix7778');
define('DBNAME', 'hgmras52_autocenter');

$conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);
