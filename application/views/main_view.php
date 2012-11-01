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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/main.css");?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/demo.css");?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/style.css");?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("application/views/css/menu.css");?>" />
        <script src="<?php echo base_url("application/views/js/jquery.js");?>" type="text/javascript"></script>
        <script src="<?php echo base_url("application/views/js/jquery-main.js");?>" type="text/javascript"></script>
     </head>
    <body>
        <div id="wrapper2">
            <section id="head">
                <header id="main"></header><nav id="main"><?php require_once('application/views/menu.php');                 ?>
                
                </nav>
            </section>
                <section id="contentbg">
                    <article id="main">
                        <?php
                       //Check mode of main page
                        if($mode=='mailbox'){
                       //Check if we choose mailbox and try to connect
                       if(!isset($nochoose)){
                           //Check if there are some emails in mailbox
                             if($emails!=false){
                             echo'<a href="'.base_url('main/mailbox/').'" class="pagebutton">1</a> 
                                  <a href="'.base_url('main/mailbox/2').'" class="pagebutton">2</a> 
                                  <a href="'.base_url('main/mailbox/3').'" class="pagebutton">3</a> ... ';
                                  if(1!=$thispage and 2!=$thispage and ($numberpages-1)!=$thispage and $numberpages!=$thispage){
                                        echo'<a href="'.base_url('main/mailbox/'.($thispage-1)).'" class="pagebutton">'.($thispage-1).'</a> 
                                             <a href="'.base_url('main/mailbox/'.$thispage).'" class="pagebutton">'.($thispage).'</a> 
                                             <a href="'.base_url('main/mailbox/'.($thispage+1)).'" class="pagebutton">'.($thispage+1).'</a> ... ';

                                  }
                                  echo'<a href="'.base_url('main/mailbox/'.($numberpages-2)).'" class="pagebutton">'.($numberpages-2).'</a> 
                                  <a href="'.base_url('main/mailbox/'.($numberpages-1)).'" class="pagebutton">'.($numberpages-1).'</a> 
                                  <a href="'.base_url('main/mailbox/'.$numberpages).'" class="pagebutton">'.($numberpages).'</a><br /><br />';
                             echo '<table class="bordered">
                                    <tr>
                                    <th>'.lang('date').'</th>
                                    <th>'.lang('topic').'</th>
                                    <th>'.lang('sender').'</th>
                                    </tr>';
                                //Show list of emails
                                foreach($emails as $mail){
                                    //Check if unreaded
                                    if($mail['unread']){
                                            echo'<tr class="unread" onclick="window.location='."'".base_url("mailshow/index/".$mail['id'])."'".'"><td>'.date("Y/m/d",$mail['date']); 
                                            if($mail['subject']!='')
                                            echo'</td><td>'."<img src='".base_url('application/views/images/unread.png')."' class='leftimg' />".$mail['subject'];
                                            else echo'</td><td>'."<img src='".base_url('application/views/images/unread.png')."' class='leftimg' />".lang('notopic');
                                            echo'</td><td>'.$mail['sender'].'</td></tr></a>';
                                        }
                                        //or readed
                                        else {
                                            echo'<tr onclick="window.location='."'".base_url("mailshow/index/".$mail['id'])."'".'"><td>'.date("Y/m/d",$mail['date']);
                                            if($mail['subject']!='')
                                            echo'</td><td>'.$mail['subject'];
                                            else echo'</td><td>'.lang('notopic');
                                            echo'</td><td>'.$mail['sender'].'</td></tr></a>';
                                        }
                                }
                                echo'</table>';
                                //If there aren't emails it could be bad page
                             }else echo '<h4 class="alert_error">'.lang('badpage').'</h4>';
                            //If email wasn't choosed from list
                            }else{ 
                                //or was choosed and can not connect to email serv
                                if($nochoose!='nochoose') echo '<h4 class="alert_error">'.lang('noconn').'</h4>';
                                //otherwise warning that email wasn't choosed from left list
                                else echo '<h4 class="alert_warning">'.lang('nochoose').'</h4>';}
                                    //Message if MAIN mode
                                    }else echo '<h4 class="alert_info">'.lang('hello').'</h4>';
                            ?>
                     
                    </article>
                    <aside id="main">
                        <?php require_once('application/views/menu_mail.php'); ?>
                    </aside>
                    <footer id="main"><?php echo lang("global_footer") ?></footer>
                </section>
            
        </div>
    </body>
</html>