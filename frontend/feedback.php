<?php 
$result="";
if(isset($_POST['submit'])){
require 'phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';
$mail->Username='jacksas540@gmail.com';
$mail->Password='hasyjay22';
$mail->setFrom($_POST['email'],$_POST['name']);
$mail->addAddress('jacksas540@gmail.com');
$mail->addReplyTo($_POST['email'],$_POST['name']);
$mail->isHTML(true);
$mail->Subject='Form Submission:' .$_POST['subject'];
$mail->Body='<h3>Name :'.$_POST['name'].'<br> Email: '.$_POST['email'].'<br>Message: '.$_POST['msg'].'</h3>';
if(!$mail->send()){
$result = "Something went worng. Please try again.";
}
else {
    $result="Thanks " .$_POST['name']. " for Your Feedbacks. ";
  }
}
?>
<html lang="en">
<head>
<style>
body {
  background: url('img/register.jpg')
}
.resize{
  font-size: 25px;
  color: #7ed321;
}
.color{
  background-color: #7ed321;
  color: white;
  
}
</style>
  <meta charset="UTF-8">
  <meta name="author" content="Hassan">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Feedback | Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4 mt-5 bg-light rounded">
        <h1 class="text-center font-weight-bold  resize">Your Feedback Could Help Us Improve Better</h1>
        <hr class="bg-light">
        <h5 class="text-center text-success"> <?=$result; ?></h5>
        <form action="" method="post" id="form-box" class="p-2">
          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
          </div>
          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
          </div>
          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-at"></i></span>
            </div>
            <input type="text" name="subject" class="form-control" placeholder="Enter subject" required>
          </div>
          <div class="form-group input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-comment-alt"></i></span>
            </div>
            <textarea name="msg" id="msg" class="form-control" placeholder="Write your message" cols="30" rows="4" required></textarea>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" id="submit" class="btn btn-block color" value="SEND">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>