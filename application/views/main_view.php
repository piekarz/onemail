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
        <script src="<?php echo base_url("application/views/js/jquery.js");?>" type="text/javascript"></script>
        <script src="<?php echo base_url("application/views/js/iframesize.js");?>" type="text/javascript"></script>
        <script src="<?php echo base_url("application/views/js/jquery-main.js");?>" type="text/javascript"></script>
     </head>
    <body>
        <div id="wrapper2">
            <section id="head">
                <header id="main"></header><nav id="main"><?php require_once('/application/views/menu.php'); ?></nav>
            </section>
                <section id="contentbg">
                    <article id="main">
                        <?php
                         if($mode=='mailbox'){
                             if($emails!=false){
                             echo '<table class="bordered">
                                    <tr>
                                    <th>'.lang('date').'</th>
                                    <th>'.lang('topic').'</th>
                                    <th>'.lang('sender').'</th>
                                    </tr>';
                                foreach($emails as $mail){
                                    if($mail['unread']){
                                            echo'<tr class="unread" onclick="window.location='."'".base_url("mailshow/index/".$mail['id'])."'".'"><td>'.date("Y/m/d",$mail['date']); 
                                            if($mail['subject']!='')
                                            echo'</td><td>'."<img src='".base_url('application/views/images/unread.png')."' class='leftimg' />".$mail['subject'];
                                            else echo'</td><td>'."<img src='".base_url('application/views/images/unread.png')."' class='leftimg' />".lang('notopic');
                                            echo'</td><td>'.$mail['sender'].'</td></tr></a>';
                                        }
                                        else {
                                            echo'<tr onclick="window.location='."'".base_url("mailshow/index/".$mail['id'])."'".'"><td>'.date("Y/m/d",$mail['date']);
                                            if($mail['subject']!='')
                                            echo'</td><td>'.$mail['subject'];
                                            else echo'</td><td>'.lang('notopic');
                                            echo'</td><td>'.$mail['sender'].'</td></tr></a>';
                                        }
                                }
                                echo'</table>';
                             }else {echo '<h4 class="alert_error">'.lang('badpage').'</h4>';}
                            }else echo '<h4 class="alert_info">'.lang('hello').'</h4>';
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