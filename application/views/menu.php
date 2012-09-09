        
<?php if($this->session->userdata('logged_in')){ 
    /**
     * Menu for logined users
     */
    ?>
<ul id="menu-bar">
 <li class="current"><a href="<?php echo base_url("main") ?>"><?php echo lang("emailmain") ?></a></li>
 <li><a href="<?php echo base_url("settings") ?>"><?php echo lang("settings") ?></a>
   <ul>
   <li><a href="#"><?php echo lang("accounts") ?></a></li>
   <li><a href="#">Services Sub Menu 2</a></li>
   <li><a href="#">Services Sub Menu 3</a></li>
   <li><a href="#">Services Sub Menu 4</a></li>
  </ul></li>
 <li><a href="<?php echo base_url("profile") ?>"><?php echo lang("profile") ?></a></li>
 <li><a href="<?php echo base_url("login/logout") ?>"><?php echo lang("logout") ?></a></li>
</ul>


<?php }else{ 
    /**
     * Menu for Logouted users
     */
    ?>
<ul id="menu-bar">
 <li class="current"><a href="<?php echo base_url("welcome") ?>"><?php echo lang("mainpage") ?></a></li>
 <li><a href="<?php echo base_url("about") ?>"><?php echo lang("about") ?></a>
   <ul>
   <li><a href="#">Services Sub Menu 1</a></li>
   <li><a href="#">Services Sub Menu 2</a></li>
   <li><a href="#">Services Sub Menu 3</a></li>
   <li><a href="#">Services Sub Menu 4</a></li>
  </ul></li>
 <li><a href="<?php echo base_url("contact") ?>"><?php echo lang("contact") ?></a></li>
 <li><a href="<?php echo base_url("login") ?>"><?php echo lang("login") ?></a></li>
 <li><a href="<?php echo base_url("login#toregister") ?>"><?php echo lang("register") ?></a></li>
</ul>

<?php } ?>
