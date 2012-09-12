<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
    </head>
    <body>
                       <?php
                      if($mbox = imap_open("{imap.googlemail.com:993/imap/ssl}INBOX", 'pppiekarz@gmail.com', 'ppp72301849',OP_READONLY))
                        $mailLib = new MailLib(); 
                        $mailLib->connect('pppiekarz@gmail.com','ppp72301849','imap.googlemail.com','993');
                        $emails=$mailLib->getMails();
                        for ($i=0;$i<30;$i++){
                        echo"EMAIL [$i] <br />";
                        $mail=$mailLib->getMail($emails[$i]);
                        echo "sender: ".$mail['sender']."<br />";
                        echo "recipient: ".$mail['recipient']."<br />";
                        echo "subject: ".$mail['subject']."<br />";
                        echo "date: ".date('Y-m-d',$mail['date'])."<br />";
                        echo "body: ".$mail['body']."<br />";
                        echo "attachments: "; print_r($mail['attachments']);
                        //print_r($emails);
                        echo"<br /><br /><br />";
                        if($i==2)break;
                        
                        }
                        ?>
                        
    </body>
</html>