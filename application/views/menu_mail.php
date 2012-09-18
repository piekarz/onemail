<?php
$emails=$this->session->userdata('emails');
    echo'<select class="emaillist">';
    if($emails==null) echo'<option value="none">'.lang('noacc').'</option>';
    else{
      echo'<option value="none">'.lang('chooseacc').'</option>';
      foreach($emails as $email) echo'<option value='.$email.'>'.$email.'</option>';}
    echo'</select>

        <ul class="leftmenu">
                        <li ><a href="'.base_url('main/mailbox').'" >'.lang('mailbox').'</a></li>
                        <li ><a href="'.base_url('main/write').'">'.lang('write').'</a></li>
                </ul>
    ';
