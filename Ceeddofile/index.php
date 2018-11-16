<?php 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "vendor\autoload.php"; 
//a utiliser pour le server reel pour avoir le chemein exact
//$str=getcwd();
  if (isset($_POST['upload'])){
$mail = new PHPMailer(true);
try {
  //Server settings
  $mail->SMTPDebug = 0;                                 // Enable verbose debug output
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'babslegrands.bs@gmail.com';                 // SMTP username
  $mail->Password = 'babacar93';                           // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                    // TCP port to connect to




$envoie = $_POST['envoiemail']; 
$destinataire = $_POST['destinataire']; 
$message = $_POST['message']; 

$mail->setFrom($envoie, 'Ceeddo');
$mail->addAddress($destinataire, 'Client');
$mail->Subject  = 'Ceeddo';
$mail->Body     = $message.'Votre lien de telechargement : '.'http://localhost/Ceeddofile/upload/'.$_FILES['file']['name'];
$mail->send();


echo 'Message has been sent';
} 
catch (Exception $e) {
echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
}

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ceeddofile</title>
    <style>
        #drop_zone {
            background-color: #3451; 
            border: #999 1px dashed;
            width: 300px; 
            height: 200px;
            padding: 8px;
            font-size: 18px;
            transition:2s;
        }

         #drop_zone:hover
         {
          background-color: #EEE; 
         }


        </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
  </head>
  <body>


   
    <div id="div6" class="col-sm-8">
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


                <script>
              
              function drag_drop(event) 
              
              {
              
                event.preventDefault();
         
               alert(event.dataTransfer.files[0].name);
               

              var file = event.dataTransfer.files[0];
              // alert(file.name+" | "+file.size+" | "+file.type);
              var formdata = new FormData();
              formdata.append("file1", file);
              var ajax = new XMLHttpRequest();
              ajax.open("POST", "file_upload_parser.php");
              ajax.send(formdata); 
                    
              
                }

                </script>


              <br>


          <label for="envoiemail" class="col-sm-3 control-label">Votre email</label> 
           <div class="col-sm-3">
             <i class="fa fa-envelope prefix btn-lg-text "></i>

           <input type="text" id="envoiemail" name="envoiemail" placeholder="Email" class="form-control" required>
      
      
          </div>

             <br>

       <label for="destinataire" class="col-sm-3 control-label">Destinataire</label> 
       
       <div class="col-sm-3">
       <i class="fa fa-envelope prefix btn-lg-text "></i>
    <input type="email" id="destinataire" placeholder="email destinataire" name="destinataire" class="form-control" required>
    
      </div>
      <br>
      <label for="message" class="col-sm-3 control-label">Message</label>
      <div class="col-sm-4">
        <textarea type="text" id="message" name="message" class="form-control" placeholder="Votre message" ></textarea>
        
          </div>


      <br>


                 <button type="submit"  class="btn btn1" name="upload" > Envoyer</button>
             
          </form>
        </div>

    


   

<!-- upload -->
   <?php
   
            if (isset($_POST['upload']))
            {
           
              
             
    $fichier = ($_FILES['file']['name']);
    $taille_max = 31000000;
    $taille = filesize($_FILES['file']['tmp_name']);
     $ext = pathinfo($fichier, PATHINFO_EXTENSION);
    $filename = uniqid(rand(), true) .'.'.$ext;
// Set session variables
$_SESSION["fichier"] = $filename;

    var_dump($_SESSION["fichier"]);

    if ($taille > $taille_max){
        $error = '<div class="alert">Fichier trop volumineux ...</div>';
    }
    if (!isset($error)){
       
        move_uploaded_file($_FILES['file']['tmp_name'], "upload/".$filename);
        
      } else {
        echo $error;
    }
}

?>
  </body>
</html>
