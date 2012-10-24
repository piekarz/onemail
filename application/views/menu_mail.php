<?php
$emails=$this->session->userdata('emails');
    echo'<select class="emaillist">';
    //no email accounts
    if($emails==null) echo'<option value="none">'.lang('noacc').'</option>';
    else{
        //if there are any emails
        if($this->session->userdata('selectedemail')=='') echo'<option value="none">'.lang('chooseacc').'</option>';
        //show all in list
        foreach($emails as $email){ 
          echo'<option class="emaillist" value="'.$email.'"';
          //if one email is selected then we mark it
          if ($email==$this->session->userdata('selectedemail')) echo' selected="selected" ';
          echo'">'.$email.'</option>';}}
    //other menu links
    echo'</select>

        <ul class="leftmenu">
                        <li ><a href="'.base_url('main/mailbox').'" >'.lang('mailbox').'</a></li>
                        <li ><a href="'.base_url('write').'">'.lang('write').'</a></li>
                </ul>
                <div class="leftecho"></div>
    ';
