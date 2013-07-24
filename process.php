<?php
if(isset($_POST['submit'])) {
   $to = 'webmaster@reactionmaster.com' ;     //put your email address on which you want to receive the information
   $subject = 'I would like to give some feedback on the site';   //set the subject of email.
   $headers  = 'MIME-Version: 1.0' . "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $message = "<table><tr><td>Your Name</td><td>".$_POST['name']."</td></tr>
               <tr><td>E-Mail</td><td>".$_POST['email']."</td></tr>
               <tr><td>Message</td><td>".$_POST['message']."</td>
               </tr></table>" ;
   mail($to, $subject, $message, $headers);
   header('Location: contact.php');
}
?>