<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);
if(isset($_POST['uid']) && isset($_POST['unorg']) && isset($_POST['atribut']) && isset($_POST['nou_contingut'])) {
#
# Atribut a modificar --> Número d'idenficador d'usuari
#
$atribut=$_POST['atribut']; # El número identificador d'usuar té el nom d'atribut uidNumber
$nou_contingut=$_POST['nou_contingut'];
#
# Entrada a modificar
#
$uid = $_POST['uid'];
$unorg = $_POST['unorg'];
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
<h2>Formulari de modificació d'usuari</h2>
<form action="./modificarUsuari.php" method="POST">
UID: <input type="text" name="uid"><br>
Unitat organitzativa: <input type="text" name="unorg"><br>
Nou atribut: <input type="text" name="nou_contingut"><br>
<input type="radio" id="uidNumber" name="atribut" value="uidNumber">
<label>uid Number</label><br>
<input type="radio" id="gidNumber" name="atribut" value="gidNumber">
<label>gid Number</label><br>
<input type="radio" id="directoriPersonal" name="atribut" value="homeDirectory">
<label>Directori Personal</label><br>
<input type="radio" id="shell" name="atribut" value="loginShell">
<label>Shell</label><br>
<input type="radio" id="cn" name="atribut" value="cn">
<label>cn</label><br>
<input type="radio" id="ns" name="atribut" value="sn">
<label>sn</label><br>
<input type="radio" id="givenName" name="atribut" value="givenName">
<label>Given Name</label><br>
<input type="radio" id="postalAddress" name="atribut" value="postalAddress">
<label>Postal address</label><br>
<input type="radio" id="mobile" name="atribut" value="mobile">
<label>Mobile</label><br>
<input type="radio" id="telephoneNumber" name="atribut" value="telephoneNumber">
<label>Telephone Number</label><br>
<input type="radio" id="title" name="atribut" value="title">
<label>Title</label><br>
<input type="radio" id="description" name="atribut" value="description">
<label>Description</label><br>
<input type="submit"/>
<input type="reset"/>
</form>
<a href="menu.php">Tornar al menú </a>
</body>
</html>