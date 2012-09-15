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
        <title><?php echo $header;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="author" content="Codrops" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/main.css");?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/demo.css");?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/style.css");?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/menu.css");?>" />
        <script src="<?php echo base_url("application/views/js/jquery-1.5.2.min.js");?>" type="text/javascript"></script>
        <script src="<?php echo base_url("application/views/js/iframesize.js");?>" type="text/javascript"></script>
        <script src="<?php echo base_url("application/views/js/hideshow.js");?>" type="text/javascript"></script>
     </head>
    <body>
        <div id="wrapper2">
            <section id="head">
                <header id="main"></header><nav id="main"><?php require_once('/application/views/menu.php'); ?></nav>
            </section>
                <section id="contentbg">
                    <article id="main">
                        <?php
                            if($email==null){
                                echo'podano złe dane maila';
                            }else{
                                echo"from: ".$email['sender']."<br />";
                                echo"recipment: ".$email['recipient']."<br />";
                                echo"subject: ".$email['subject']."<br />";
                                echo"date: ".$email['date']."<br />";
                                echo"body: ".$email['body']."<br />";
                                echo"attachments: ";
                                if($email['attachments']!=null){
                                    foreach ($email['attachments'] as $attachments)
                                        echo $attachments;                           
                                        }
                                echo"<br />";
                            }
                            ?>
                     
                    </article>
                    <aside id="main">
                        <?php require_once('/application/views/menu_mail.php'); ?>
                    </aside>
                    <footer id="main"><?php echo lang("global_footer") ?></footer>
                </section>
            
        </div>
    </body>
</html>