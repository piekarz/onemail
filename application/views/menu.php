        
<?php if($this->session->userdata('logged_in')){ 
    /**
     * Menu for logined users
     */
    ?>
<ul id="menu-bar">
 <li class="current"><a href="#">Home</a></li>
 <li><a href="#">Products</a>
  <ul>
   <li><a href="#">Products Sub Menu 1</a></li>
   <li><a href="#">Products Sub Menu 2</a></li>
   <li><a href="#">Products Sub Menu 3</a></li>
   <li><a href="#">Products Sub Menu 4</a></li>
  </ul>
 </li>
 <li><a href="#">Usługi</a>
  <ul>
   <li><a href="#">Services Sub Menu 1</a></li>
   <li><a href="#">Services Sub Menu 2</a></li>
   <li><a href="#">Services Sub Menu 3</a></li>
   <li><a href="#">Services Sub Menu 4</a></li>
  </ul>
 </li>
 <li><a href="#">O nas</a></li>
 <li><a href="#">Kontakt</a></li>
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
 <li><a href="<?php echo base_url("register") ?>"><?php echo lang("register") ?></a></li>
</ul>

<?php } ?>
