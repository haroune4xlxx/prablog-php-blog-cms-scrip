<?php

// INCLUDE CONFIG
include 'settings.php';

// SETUP URL
$page_url = 'http'.(!empty($_SERVER['HTTPS'])?'s':'').'://'.$_SERVER['SERVER_NAME'].str_replace('/inc','',dirname($_SERVER['SCRIPT_NAME'])).'/';

// TITLE 4 HEADER (max. 71 chars)
$title = mb_substr('Admin ► '.$page_title,0,71);

// IF DEMO
if(isset($DEMO) && $DEMO==true){
  $demo = ' <sup style="background-color:#d9534f;display:inline;padding:.2em .6em .2em;font-size:50%;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:top;border-radius:.25em;">DEMO</sup>'."\n";
}else{
  $demo = '';
}

// INCLUDE HEADER
include '../tpl/'.$page_tpl.'/header.php';

// IF ADMIN
if (isset($_SESSION["$session"]) && $_SESSION["$session"] == true) {

  // PREP DATA
  $data = $_POST['id'].'%%%###@@@&&&'.
          $_POST['url'].'%%%###@@@&&&'.
          $_POST['title'].'%%%###@@@&&&'.
          $_POST['content'].'%%%###@@@&&&'.
          $_POST['date'].'%%%###@@@&&&'.
          $_POST['count'].'%%%###@@@&&&'.
          $_POST['categories'].'%%%###@@@&&&'.
         @$_POST['fixed'].'%%%###@@@&&&'.
         @$_POST['page'];
  $data = str_replace("'", '`', $data);
  $data = str_replace('"', '``', $data);
  $data = str_replace('\\', '/', $data);
  $data = str_replace('<', '[', $data);
  $data = str_replace('>', ']', $data);
  $save = explode('%%%###@@@&&&', $data);

  // SLUGIFY & TAGIFY
  $save[2] = slugify($save[2]); // TITLE
  $save[6] = tagify($save[6]);  // CATEGORIES

  // CHECK IF DEMO
  if ( !isset($DEMO)||$DEMO==false ) {
    // DELETE POST
    if (@$_POST['post_delete'] == 'YES' && @$save[0] != '') {
      mysqli_query($mysqli, "DELETE FROM prablo WHERE id = ".$save[0]) OR die('LINE '.__LINE__.' &mdash; DELETE '.mysqli_error($mysqli));

    }
    // CHECK FOR DUBLICATES
    if ($save[0]=='')$save[0]=0;
    $cfd_query = "SELECT title FROM prablo WHERE title = '".$save[2]."' AND NOT id = ".$save[0];
    $cfd = mysqli_query($mysqli,$cfd_query) or die('LINE '.__LINE__.' &mdash; SELECT '.mysqli_error($mysqli).' '.$cfd_query);
    $cfd = mysqli_fetch_array($cfd);
    if($cfd['title']!='')die('<a href="javascript:history.back(-1);" class="button error">'.$lang['Titleerror'].'</a>');

    // NEW POST
    if (@$_POST['new'] == 'YES') {
      mysqli_query($mysqli, "INSERT INTO prablo (id) VALUES(DEFAULT)") OR die('LINE '.__LINE__.' &mdash; INSERT '.mysqli_error($mysqli));
      $save[0] = 'LAST_INSERT_ID()';
    }else{
      // UPDATE POST
      $save[0] = "'".$save[0]."'";
    }

    // QUERY
    mysqli_query($mysqli, "UPDATE prablo SET
      url        = '" . $save[1] . "',
      title      = '" . $save[2] . "',
      content    = '" . $save[3] . "',
      date       = '" . $save[4] . "',
      count      = '" . $save[5] . "',
      categories = '" . $save[6] . "',
      fixed      = '" . $save[7] . "',
      page       = '" . $save[8] . "'
      WHERE id   = "  . $save[0]) OR
        die('LINE '.__LINE__.' &mdash; UPDATE '.mysqli_error($mysqli));
  } /* END </CHECK IF DEMO> */

  // PINGOMATIC
  if(isset($page_pingomatic) && $page_pingomatic == true && (!isset($DEMO)||$DEMO==false) ){
    include 'ping.php';
    $slug = "http".(!empty($_SERVER['HTTPS'])?"s":"").
    "://".$_SERVER['SERVER_NAME'].
    dirname($_SERVER['REQUEST_URI']).'/'.
    str_replace(' ', '-', $save[2]).'.php';
    pingomatic($save[2],$slug);
  }

  // OK MESSAGE
  echo '<a class="button" href="'.$_SERVER['HTTP_REFERER'].'">'.$lang['UPDATE OK'].'</a>';
} else { // IF WRONG ADMIN
  echo '<a class="button" href="'.$_SERVER['HTTP_REFERER'].'">'.$lang['ERROR'].'</a>';

}

// MESSAGE FOOTER
echo '<meta http-equiv="refresh" content="3;url='.$page_url.'index.php">';

// INCLUDE HEADER
include '../tpl/'.$page_tpl.'/footer.php';

// HELPER
function slugify($string){
  $string = preg_replace("/&#?[a-z0-9]{2,8};/i",'',$string);
  $string = preg_replace('~[^\pL\d]+~u', ' ', $string);
  $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
  $string = preg_replace('~[^ \w]+~', '', $string);
  $string = trim($string, ' ');
  $string = preg_replace('~ +~', ' ', $string);
  if (empty($string)) { $string = time();}
  return $string;
}
function tagify($string){
  $return = '';
  $array = explode(',',$string.',');
  foreach ($array as $string){
    $string = preg_replace("/&#?[a-z0-9]{2,8};/i",'',$string);
    $string = preg_replace('~[^\pL\d]+~u', ' ', $string);
    $string = iconv('utf-8', 'us-ascii//TRANSLIT', $string);
    $string = preg_replace('~[^ \w]+~', '', $string);
    $string = trim($string, ' ');
    $string = preg_replace('~ +~', ' ', $string);
    $string = str_replace(' ', '-', $string);
    $return .= $string.',';
  }
  $return = rtrim($return,',');
  return $return;
}
