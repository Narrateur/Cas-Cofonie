<!--<?php
     // Database connection details
     $dsn = 'sqlsrv:server=SERVER2012\MSSQL;database=phpkb';
     $user = 'dbuser';
     $pass = 'secure_password';

     // Initialise
     $conn = null;
     try {
         // Database connection
         $pdoObj = new PDO($dsn, $user, $pass);
         if(is_object($pdoObj)){
           echo 'Connection established successfully.';
         }
     }
     catch(PDOException $pe){
         // Throw exception
         echo 'Critical Error: Unable to connect to Database Server because: '.$pe->getMessage();
     }
?>
 -->


<?php
$serverName = "serverName\\sqlexpress"; //serverName\instanceName

// Vu que UID et PWD ne sont pas spécifiés dans le tableau $connectionInfo,
// la connexion va tenter d'utiliser l'authentification Windows.
$connectionInfo = array( "Database"=>"CasCofonie");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connexion établie.<br />";
}else{
     echo "La connexion n'a pu être établie.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>
