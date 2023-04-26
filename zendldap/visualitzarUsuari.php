<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;
ini_set('display_errors',0);
if ($_GET['usuari'] && $_GET['uo']){
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-josaso.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $entrada='uid='.$_GET['usuari'].',ou='.$_GET['uo'].',dc=fjeclot,dc=net';
    $usuari=$ldap->getEntry($entrada);
    echo "<b><u>".$usuari["dn"]."</b></u><br>";
    foreach ($usuari as $atribut => $dada) {
        if ($atribut != "dn") echo $atribut.": ".$dada[0].'<br>';
    }
}
?>
<html>
<head>
<title>
MOSTRANT DADES D'USUARIS DE LA BASE DE DADES LDAP
</title>
</head>
<body>
<h2>Formulari per seleccionar l'usuari</h2>
<form action="visualitzarUsuari.php" method="GET">
Unitat organitzativa: <input type="text" name="uo"><br>
Usuari: <input type="text" name="usuari"><br>
<input type="submit"/>
<input type="reset"/>
</form>
<a href="menu.php">Tornar al menú </a>
</body>
</html>