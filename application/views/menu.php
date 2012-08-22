        
<?php if($this->session->userdata('logged_in')){ 
    /**
     * Menu for logined users
     */
    ?>
<div id='cssmenu'>
            <ul>
                <li class='has-sub '><a href='<?php echo base_url("overview") ?>'><span><?php echo lang("overview") ?></span></a>
                  <ul>
                     <li><a href='#'><span><?php echo lang("colony") ?></span></a>
                     <li><a href='#'><span><?php echo lang("research") ?></span></a></li>
                  </ul>
               
               <li class='has-sub '><a href='#'><span><?php echo lang("military") ?></span></a>
                  <ul>
                     <li><a href='#'><span><?php echo lang("army") ?></span></a>
                     <li><a href='#'><span><?php echo lang("defense") ?></span></a>
                     <li><a href='#'><span><?php echo lang("expedition") ?></span></a></li>
                  </ul>
               
               <li class='has-sub '><a href='#'><span><?php echo lang("alliance") ?></span></a>
                  <ul>
                     <li><a href='#'><span><?php echo lang("overview") ?></span></a></li>
                     <li><a href='#'><span><?php echo lang("forum") ?></span></a></li>
                  </ul>
               
               <li><a href='#'><span><?php echo lang("map") ?></span></a></li>
               <li class='has-sub '><a href='#'><SpaN><?php echo lang("account") ?></span></a>
                  <ul>
                     <li><a href='#'><span><?php echo lang("profile") ?></span></a></li>
                     <li><a href='<?php echo base_url("login/logout") ?>'><span><?php echo lang("logout") ?>[ <?php echo $this->session->userdata('username'); ?> ]</span></a>
                  </ul>
               
               <li class='has-sub '><a href='#'><span><?php echo lang("about") ?></span></a>
                  <ul>
                     <li><a href='#'><span><?php echo lang("mainpage") ?></span></a></li>
                     <li><a href='#'><span><?php echo lang("forum") ?></span></a>
                     <li><a href='#'><span><?php echo lang("guide") ?></span></a>
                     <li><a href='#'><span><?php echo lang("faq") ?></span></a></li>
                     
                  </ul>
               
            </ul>
            </div>

<?php }else{ 
    /**
     * Menu for Logouted users
     */
    ?>

<div id='cssmenu'>
            <ul>
                <li><a href='<?php echo base_url("welcome") ?>'><span><?php echo lang("mainpage") ?></span></a></li>
                <li><a href='<?php echo base_url("login#toregister") ?>'><span><?php echo lang("register") ?></span></a></li>
                <li><a href='<?php echo base_url("login") ?>'><span><?php echo lang("login") ?></span></a>
                <li class='has-sub '><a href='#'><span><?php echo lang("about") ?></span></a>
                  <ul>
                     <li><a href='#'><span><?php echo lang("forum") ?></span></a>
                     <li><a href='#'><span><?php echo lang("guide") ?></span></a></li>
                     <li><a href='#'><span><?php echo lang("faq") ?></span></a>
                     
                  </ul>
               </li>
            </ul>
            </div>

<?php } ?>
