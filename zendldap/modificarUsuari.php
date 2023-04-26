<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);
if(isset($_POST['uid']) && isset($_POST['uo']) && isset($_POST['atribut']) && isset($_POST['contingut_nou'])) {
#
# Atribut a modificar --> Número d'idenficador d'usuari
#
$atribut=$_POST['atribut']; # El número identificador d'usuar té el nom d'atribut uidNumber
$nou_contingut=$_POST['contingut_nou'];
#
# Entrada a modificar
#
$uid = $_POST['uid'];
$unorg = $_POST['uo'];
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
# Modificant l'entrada
#
$ldap = new Ldap($opcions);
$ldap->bind();
$entrada = $ldap->getEntry($dn);
if ($entrada){
    Attribute::setAttribute($entrada,$atribut,$nou_contingut);
    $ldap->update($dn, $entrada);
    echo "Atribut modificat";
} else echo "<b>Aquesta entrada no existeix</b><br><br>";
}
?>
<html>
<head>
<title>
MODIFICAR USUARIS
</title>
</head>
<body>
<h2>Formulari per la modificació d'un usuari</h2>
<form action="./modificarUsuari.php" method="POST">
UID: <input type="text" name="uid"><br>
Unitat organitzativa: <input type="text" name="uo"><br>
Nou atribut: <input type="text" name="contingut_nou"><br>
<input type="radio" id="uid_Num" name="atribut" value="uid_Num">
<label>Numero uid</label><br>
<input type="radio" id="gid_Num" name="atribut" value="gid_Num">
<label>Numero gid</label><br>
<input type="radio" id="directori_Personal" name="atribut" value="directori_Personal">
<label>Directori Personal</label><br>
<input type="radio" id="Shell" name="atribut" value="Shell">
<label>Shell</label><br>
<input type="radio" id="cn" name="atribut" value="cn">
<label>cn</label><br>
<input type="radio" id="ns" name="atribut" value="sn">
<label>sn</label><br>
<input type="radio" id="given_Nom" name="atribut" value="given_Nom">
<label>Given Name</label><br>
<input type="radio" id="postal_Address" name="atribut" value="postal_Address">
<label>Adreça Postal</label><br>
<input type="radio" id="mobil" name="atribut" value="mobil">
<label>Mobil</label><br>
<input type="radio" id="telefon" name="atribut" value="telefon">
<label>Numero Telefon</label><br>
<input type="radio" id="titol" name="atribut" value="titol">
<label>Title</label><br>
<input type="radio" id="descripcio" name="atribut" value="descripcio">
<label>Description</label><br>
<input type="submit"/>
<input type="reset"/>
</form>
</body>
<a href="menu.php">Tornar al menú </a>
</html>