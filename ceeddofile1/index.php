<?php 
session_start();

?>

<!-- upload -->
   <?php
   
            if (isset($_POST['upload']))
            {
           
              if(!$_FILES['file']['size']==0)
              {
             
    $fichier = ($_FILES['file']['name']);
    $taille_max = 31000000;
    $taille = filesize($_FILES['file']['tmp_name']);
     $ext = pathinfo($fichier, PATHINFO_EXTENSION);
    $filename = uniqid(rand(), true) .'.'.$ext;
// Set session variables
$_SESSION["fichier"] = $filename;


    if ($taille > $taille_max){
        $error = '<div class="alert">Fichier trop volumineux ...</div>';
    }
    if (!isset($error)){
       
        move_uploaded_file($_FILES['file']['tmp_name'], "upload/".$filename);
        
      } else {
        echo $error;
    }
}
}

?>
<?php


if(isset($_POST['upload']))
{
try
{
  $bdd = new PDO('mysql:host=localhost;dbname=babacars_ceeddofile','babacars','fPZzuYT9dy',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
  // create unique token
$tokken = uniqid();
$lien = 'http://babacars.promo-21.codeur.online/ceeddofile/upload/'.$filename;
$url='http://babacars.promo-21.codeur.online/ceeddofile/telechargement.php?tokken='.$tokken;
 
try
{
 

    $req = $bdd ->prepare('INSERT INTO fichier (url, tokken, nom, lien,taille,extension) VALUES(:url, :tokken, :nom, :lien, :taille, :extension)');
$req->execute(array(
  'url'=>$url,
  'tokken'=>$tokken,
  'nom'=>$fichier,
  'lien'=>$lien,
   'taille'=>$taille,
  'extension'=>$ext
));

}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}



}



?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ceeddofile</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
     <link rel="stylesheet" href="style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

  <!-- Animate.css -->
  <link rel="stylesheet" href="css/animate.css">
  <!-- Icomoon Icon Fonts-->
  <link rel="stylesheet" href="css/icomoon.css">
  <!-- Bootstrap  -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <!-- Superfish -->
  <link rel="stylesheet" href="css/superfish.css">

  <link rel="stylesheet" href="css/style.css">
  </head>
  
  <body style="margin: 0;padding: 0;background: #333;">
<!-- drag_drop fonction -->
  <img class="show-login-btn" style="margin-left: 25%; width: 12%;margin-top: -15%;border: black;" src="images/logo.png"> 
 <div class="login-box">
      <div class="hide-login-btn"><i class="fas fa-times"></i></div>
   

  
     <div id="fh5co-content-section" class="fh5co-section-gray">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
          
              <h3 >A Propos</h3>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="fh5co-testimonial text-center animate-box">
              <figure>
                <img src="images/personne1.jpg" alt="user">
              </figure>
              <blockquote>
                <p>Mamadou FAYE</p>
              </blockquote>
              <a href="https://www.facebook.com/mamadoubadiane.faye.3"><img src="images/facebook.png"></a>
              <a href="https://github.com/badianefaye"><img src="images/github.png"></a>
            </div>
          </div>
          <div class="col-md-3">
            <div class="fh5co-testimonial text-center animate-box">
              <figure>
                <img src="images/personne2.jpg" alt="user">
              </figure>
              <blockquote>
                <p>Babacar SYLLA</p>
              </blockquote>
              <a href="https://www.facebook.com/babskillah"><img src="images/facebook.png"></a>
              <a href="https://github.com/Babacaracs"><img src="images/github.png"></a>
            </div>
          </div>
          <div class="col-md-3">
            <div class="fh5co-testimonial text-center animate-box">
              <figure>
                <img src="images/personne4.jpg" alt="user">
              </figure>
              <blockquote>
                <p>Adji fatou DIEYE</p>
              </blockquote>
              <a href="https://www.facebook.com/adjifatou.diey"><img src="images/facebook.png"></a>
              <a href="https://github.com/Adjifatou"><img src="images/github.png"></a>
            </div>
          </div>
          <div class="col-md-3">
            <div class="fh5co-testimonial text-center animate-box">
              <figure>
                <img src="images/personne3.jpg" alt="user">
              </figure>
              <blockquote>
                <p>Cherif GUEYE</p>
              </blockquote>
              <a href="https://www.facebook.com/cherif.gueye.5"><img src="images/facebook.png"></a>
              <a href="https://github.com/GueyeCherif"><img src="images/github.png"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    </div>


    <script type="text/javascript">
    $(".show-login-btn").on("click",function(){
      $(".login-box").toggleClass("showed");
    });
    $(".hide-login-btn").on("click",function(){
      $(".login-box").toggleClass("showed");
    });
  </script>
 <script>
              
              function drag_drop(event) 
              
              {
              
                event.preventDefault();
         
               
               

              var file = event.dataTransfer.files[0];
              // alert(file.name+" | "+file.size+" | "+file.type);
              var formdata = new FormData();
              formdata.append("file1", file);
              var ajax = new XMLHttpRequest();
              ajax.open("POST", "file_upload_parser.php");
              ajax.send(formdata); 
                    
              
                }

                </script>

                


   
    <div id="div6" class="col-sm-9">
    
    <br><br><br>
    <div id="drop_zone" ondrop="drag_drop(event)" ondragover="return false">
             <form action="index.php" method="post" enctype="multipart/form-data">
           <center>
             <div class="upload-btn-wrapper"> 
             <br>
               <br>  
             <button class="btn" style="color:#3498db;font-size:28px;border-radius:25px;"><i class="fas fa-cloud-upload-alt"></i></button>
                 <input type="file" name="file" id="file">
                 
              </div>
          </center>
    </div>

              <br>
              <label for="envoiemail" class="col-sm-3 control-label">Votre email</label> 
              <br>
              <div class="inputWithIcon">
  <input type="email"  id="envoiemail" name="envoiemail" placeholder="Email" class="form-control" required>
  <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
</div>

         

         <br>
       <label for="destinataire" class="col-sm-3 control-label">Destinataire</label> 
       <br>
       <div class="inputWithIcon">
    <input type="email" id="destinataire" placeholder="email destinataire" name="destinataire" class="form-control" required>
      <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
      </div>

      <br>
              
      <label for="message" class="col-sm-3 control-label">Message</label>
      <br><br>
      <div class="col-sm-7 message">
        
        <textarea style="height: 130px;" type="text" id="message" name="message" class="form-control" placeholder="Votre message" ></textarea>
        
          </div>


      <br>
      <br>
<div class="offset-sm-1 col-sm-6">
                 <button type="submit"  class="btn btn1" name="upload" > Envoyer</button>
                 <button type="reset"  class="btn btn1" name="upload" > Reinitialiser</button>
             
          </form>
        </div>

    


   

   <?php
   
  

  if (isset($_POST['upload'])){

try {

$envoie = $_POST['envoiemail']; 
$destinataire = $_POST['destinataire']; 
$message = $_POST['message']; 

$message2 = 'Votre lien de telechargement : '.$url;
$message3="
<html>
<head>
<title>Ceedofile</title>
</head>
<body>
<img src ='http://babacars.promo-21.codeur.online/ceeddofile/upload/banniere.png'>
<p>Merci d'utiliser nottre service Ceeddofile</p>
<p>Message de l'expediteur <br>".$message."</p>
<p>".$message2."</p>
</body>
</html>
";
// Necessaire pour utiliser le HTML email pour avoir un rendu pro ..!
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//Reponse
$headers .= 'From: CABB <'.$envoie.'>' . "\r\n";


mail($destinataire, "Ceeddofile", $message3, $headers);
echo('<center><h3 style="color:white">Votre message a bien été envoyer</h3></center>');
} 
catch (Exception $e) {
echo 'Erreur :Votre message n\'est envoyer ';
}
}

?>

  </body>
</html>
