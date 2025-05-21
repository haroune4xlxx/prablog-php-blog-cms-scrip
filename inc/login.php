<?php

// INCLUDE CONFIG
include 'settings.php';

// SETUP URL
$page_url = 'http'.(!empty($_SERVER['HTTPS'])?'s':'').'://'.$_SERVER['SERVER_NAME'].str_replace('/inc','',dirname($_SERVER['SCRIPT_NAME'])).'/';

// IF DEMO
if(isset($DEMO) && $DEMO==true){
  $demo = ' <sup style="background-color:#d9534f;display:inline;padding:.2em .6em .2em;font-size:50%;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:top;border-radius:.25em;">DEMO</sup>'."\n";
}else{
  $demo = '';
}

// INI VARs
$error = $create = $id = '';

// LOGOUT
if(@$_REQUEST['logout'] == 'YES') {
  $_SESSION["$session"] = '';
  session_destroy();
  die(header('Location: '.$page_url));
}

// LOGIN
if( @$_SESSION["$session"] == true ||
  ( @$_REQUEST['n'] == $admin_username &&
    @$_REQUEST['p'] == $admin_password ) ) {
    $_SESSION["$session"] = true;
    if(!empty(@$_REQUEST['id'])){
      $id = 'id='.$_REQUEST['id'];
    }
    if(!empty(@$_REQUEST['create'])){
      $create = '&create='.$_REQUEST['create'];
    }
    die(header('Location: '.$page_url.'?'.$id.$create.'&admin=YES'
    ));
}

// ERROR
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $error = '<b class="button">'.$lang['Loginerror'].'</b>';
}

// TITLE 4 HEADER (max. 71 chars)
$title = mb_substr($lang['Login'].' ► '.$page_title,0,71);

// INCLUDE HEADER
include '../tpl/'.$page_tpl.'/header.php';

// FORM
echo $error.'
<form method="post">
<input type="hidden" name="id" value="'.@$_REQUEST['id'].'">
<input type="hidden" name="create" value="'.@$_REQUEST['create'].'">
<label>'.$lang['Login'].'</label><br>
<input type="text" placeholder="'.$lang['Username'].'" name="n" style="width:200px;"><br>
<input type="password" placeholder="'.$lang['Password'].'" name="p" style="width:200px;"><br>
<input class="button-primary" type="submit">
</form>
';

// INCLUDE HEADER
include '../tpl/'.$page_tpl.'/footer.php';
