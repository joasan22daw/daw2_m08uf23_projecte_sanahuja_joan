<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);
#
#
if(isset($_POST['uid']) && isset($_POST['uo'])) {
    $uid = $_POST['uid'];
    $unorg = $_POST['uo'];
}
$dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
#
#Opcions de la connexió al servidor i base de dades LDAP
$opcions = [
    'host' => 'zend-josaso.fjeclot.net',
    'username' => 'cn=admin,dc=fjeclot,dc=net',
    'password' => 'fjeclot',
    'bindRequiresDn' => true,
    'accountDomainName' => 'fjeclot.net',
    'baseDn' => 'dc=fjeclot,dc=net',
];
#
# Esborrant l'entrada
#
$ldap = new Ldap($opcions);
$ldap->bind();
try{
    $ldap->delete($dn);
} catch (Exception $e){
}
?>

<html>
<head>
<title>
ELIMINAR USUARIS
</title>
</head>
<body>
<h2>Formulari per l'eliminació d'un usuari</h2>
<form action="./eliminarUsuari.php" method="POST">
UID: <input type="text" name="uid"><br>
Unitat organitzativa: <input type="text" name="uo"><br>
<input type="submit"/>
<input type="reset"/>
</form>
</body>
<a href="menu.php">Tornar al menú </a>
</html>