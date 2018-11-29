<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ceeddofile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  </head>
  <body>


<?php
session_start();
try
{
  $bdd = new PDO('mysql:host=localhost;dbname=babacars_ceeddofile','babacars','fPZzuYT9dy',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

//$test=$_SESSION["fichier"] ;
$cle=$_GET['tokken'];

$stmt = $bdd->prepare("SELECT lien,nom,taille,extension FROM fichier where tokken = ?");
if ($stmt->execute(array($_GET['tokken']))) {
  while ($row = $stmt->fetch()) {
    ($row['lien']);
    $test=($row['lien']); $test1=($row['taille']); $test2=($row['extension']); $test3=($row['nom']);
  }
  
  echo '<p style="color:white">Nom :'.$test3.'</p>';
        echo '<p style="color:white">Extension : '.$test1.'</p>';
        echo '<p style="color:white">Taille : '.$test1.' octect</p>';
echo '<a class="btn btn1" href="'.$test.'">Telecharger</a>';
}

session_destroy();
?>  	
  </body>
  </html>