<?php if($this->session->userdata('logged_in')){ 
    /**
     * Menu for logined users
     */
echo'
<ul id="menu-bar">
 <li class="current"><a href="'.base_url("main").'">'.lang("emailmain").'</a></li>
 <li><a href="#">'.lang("settings").'</a>
   <ul>
   <li><a href="'.base_url("settings").'">'.lang("accounts").'</a></li>
   <li><a href="'.base_url("profile").'">'.lang("profile").'</a></li>
  </ul></li>
 <li><a href="'.base_url("login/logout").'">'.lang("logout").'</a></li>
</ul>';


}else{ 
    /**
     * Menu for Logouted users
     */

echo'<ul id="menu-bar">
 <li class="current"><a href="'.base_url("welcome").'">'.lang("mainpage").'</a></li>
 <li><a href="'.base_url("about").'">'.lang("about").'</a>
   <ul>
   <li><a href="#">Services Sub Menu 1</a></li>
   <li><a href="#">Services Sub Menu 2</a></li>
   <li><a href="#">Services Sub Menu 3</a></li>
   <li><a href="#">Services Sub Menu 4</a></li>
  </ul></li>
 <li><a href="'.base_url("contact").'">'.lang("contact").'</a></li>
 <li><a href="'.base_url("login").'">'.lang("login").'</a></li>
 <li><a href="'.base_url("login#toregister").'">'.lang("register").'</a></li>
</ul>';

} 
