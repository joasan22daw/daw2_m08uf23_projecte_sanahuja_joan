<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);
#
# Entrada a esborrar: usuari 3 creat amb el projecte zendldap2
#
if(isset($_POST['confirmacion']) && $_POST['confirmacion'] == "Sí, eliminar usuario") {
$uid = 'sysdev';
$unorg = 'desenvolupadors';
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
    echo "<b>Entrada esborrada</b><br>";
} catch (Exception $e){
    echo "<b>Aquesta entrada no existeix</b><br>";
}
}
?>

<html>
<head>
<title>
ELIMINAR USUARI SYSDEV
</title>
</head>
<body>
<<h2>Confirmació d'eliminación de l'usuario</h2>
<p>¿Està segur que vol eliminar l'usuari sysdev</p>
<form action="./esborraSysdev.php" method="POST">
  <input type="hidden" name="uid" value="<?php echo $uid; ?>">
  <input type="hidden" name="uo" value="<?php echo $unorg; ?>">
  <input type="submit" name="confirmacion" value="Sí, eliminar usuario">
  <input type="button" name="cancelar" value="No, cancelar" onclick="history.back();">
</form>
</body>
<a href="menu.php">Tornar al menú </a>
</html>