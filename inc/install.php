<?PHP

/* ⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿ *\
    INSTALL - (422 Lines ;-)
\* ⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷ */

function message($content, $type = 'error') {
  $icon = 'bookmark';
  if ($type == 'ok') {
    $toast = 'success';
    $icon = 'check';
  }
  if ($type=='error') {
    $toast = 'error';
    $icon = 'stop';
  }
  echo '<style>#spinner{display:none}</style>
  <div class="toast toast-'.$toast.'" style="width:300px;margin:auto;">
  <a href="javascript:history.back();" class="btn btn-clear float-right"></a>
  <b><i class="icon icon-'.$icon.'"></i></b>
  &mdash; '.$content.'</div><br>
  ';
}
print '
  <!DOCTYPE html>
  <html>
  <head>
  <meta charset="utf-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>INSTALL</title>
  <link rel="stylesheet" href="./spectre.min.css">
  <link rel="stylesheet" href="./spectre-icons.min.css">
  </head>
  <body>
  <div class="empty">
  <div class="empty-icon" style="font-size:4rem;">
  <i class="icon icon-message"></i> PRABLO
  </div>
  ';
if (!function_exists('mysqli_connect') ) {
  die(message('No mySQLi installed!'));
}
if (version_compare(phpversion(), '5.3', '<') ) {
  die(message('PHP Version isn\'t high enough! You run PHP '.phpversion(). ' but need 5.3 or >'));
}
@include_once 'settings.php';
if ( !isset($_POST['Submit']) ) {
  $i18n = '';
  foreach(glob('lang/*.php') as $file){
    $i18n .= '<option>'.substr($file,5,-4).'</option>';
  }
  $templates = '';
  foreach(glob('../tpl/*',GLOB_ONLYDIR) as $folder){
    $templates .= '<option>'.substr($folder,7).'</option>';
  }
  print '
  <h4 class="empty-title">
  <label class="form-label">
  Please install <br>
  Bitte installiere <br>
  S\'il vous plaît installer <br>
  Por favor, instale
  </label>
  </h4>
  </div>
  <br>
  <form action="" method="post" autocomplete="off">
  <div style="border:1px solid black;width:300px;margin:auto;padding:12px;">
  <strong>Database Settings</strong><br>
  <br>
  <label for="mysqli_hostname">db Host</label>
  <input style="width:270px;" value="'.$mysqli_hostname.'" name="mysqli_hostname" id="mysqli_hostname" placeholder="localhost" class="form-input centered" type="text" required="required">
  <label for="mysqli_database">db Name</label>
  <input style="width:270px;" value="'.$mysqli_database.'" name="mysqli_database" id="mysqli_database" placeholder="PRABLO" class="form-input centered" type="text" required="required">
  <label for="mysqli_username">db User</label>
  <input style="width:270px;" value="'.$mysqli_username.'" name="mysqli_username" id="mysqli_username" placeholder="root" class="form-input centered" type="text" required="required">
  <label for="mysqli_password">db Password</label>';
  if(!isset($DEMO)||$DEMO==false)echo
  '<input style="width:270px;" value="'.$mysqli_password.'" name="mysqli_password" id="mysqli_password" placeholder="password" class="form-input centered" type="text">';else echo '<input style="width:270px;" value="DEMO_'.substr(md5(time()),0,12).'" id="mysqli_password" class="form-input centered" type="text">';
  print '
  </div>
  <br>
  <div style="border:1px solid black;width:300px;margin:auto;padding:12px;">
  <strong>Admin Account Settings</strong><br>
  <br>
  <label for="admin_username">Admin User</label>
  <input style="width:270px;" value="'.$admin_username.'" name="admin_username" id="admin_username" placeholder="username" class="form-input centered" type="text" required="required">
  <label for="admin_password">Admin Password</label>';
  if(!isset($DEMO)||$DEMO==false)echo
  '<div style="display:none;"><input type="password" name="admin_password"></div>
  <input style="width:270px;" value="'.$admin_password.'" name="admin_password" id="admin_password" placeholder="password" class="form-input centered" type="text" autocorrect="off" autocapitalize="off" autocomplete="off" required="required">';
  else echo '<input style="width:270px;" value="demo" id="admin_password" placeholder="password" class="form-input centered" type="password">';
  print '
  </div>
  <br>
  <div style="border:1px solid black;width:300px;margin:auto;padding:12px;">
  <strong>Script Settings</strong><br>
  <br>
  <label for="page_language">Language</label>
  <select style="width:270px;" name="page_language" id="page_language" class="form-select centered" required="required">
  <option>'.$page_language.'</option>
  <optgroup label="Select">'.$i18n.'</optgroup>
  </select>
  <label for="page_tpl">Template</label>
  <select style="width:270px;" name="page_tpl" id="page_tpl" class="form-select centered" required="required">
  <option>'.$page_tpl.'</option>
  <optgroup label="Select">'.$templates.'</optgroup>
  </select>
  <br>
  <label for="page_title">Title</label>
  <input style="width:270px;" value="'.$page_title.'" name="page_title" id="page_title" placeholder="PRABLO" class="form-input centered" type="text" required="required">
  <label for="page_tagline">Sub-Title</label>
  <input style="width:270px;" value="'.$page_tagline.'" name="page_tagline" id="page_tagline" placeholder="pragmatic blogging" class="form-input centered" type="text">
  <label for="page_footer">Footer</label>
  <input style="width:270px;" value="'.$page_footer.'" name="page_footer" id="page_footer" placeholder="powered by adilbo" class="form-input centered" type="text">
  <br>
  <label for="page_truncate">Truncate Value</label>
  <input style="width:270px;" value="'.$page_truncate.'" name="page_truncate" id="page_truncate" placeholder="260" min="0" max="1000" step="10" class="form-input centered" type="number" required="required">
  <label for="page_analytics">Google Analytics Tracking ID</label>
  <input style="width:270px;" value="'.$page_analytics.'" name="page_analytics" id="page_analytics" placeholder="UA-XXXXX-Y" class="form-input centered" type="text">
  <label for="page_truncate">Posts per Page</label>
  <input style="width:270px;" value="'.$posts_per_page.'" name="posts_per_page" id="posts_per_page" placeholder="10" min="2" max="20" step="1" class="form-input centered" type="number" required="required">
  <br>
  <label for="page_uselightbox">Use Lightbox?</label>
  <select style="width:270px;" name="page_uselightbox" id="page_uselightbox" class="form-select centered">
  <option value="'.$page_uselightbox.'">'.($page_uselightbox==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_usecat">Use Categories?</label>
  <select style="width:270px;" name="page_usecat" id="page_usecat" class="form-select centered">
  <option value="'.$page_usecat.'">'.($page_usecat==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_sidebar">Show Sidebar?</label>
  <select style="width:270px;" name="page_sidebar" id="page_sidebar" class="form-select centered">
  <option value="'.$page_sidebar.'">'.($page_sidebar==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_showdate">Show Post-Date?</label>
  <select style="width:270px;" name="page_showdate" id="page_showdate" class="form-select centered">
  <option value="'.$page_showdate.'">'.($page_showdate==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_catinsb">Show Categories in Sidebar?</label>
  <select style="width:270px;" name="page_catinsb" id="page_catinsb" class="form-select centered">
  <option value="'.$page_catinsb.'">'.($page_catinsb==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_nextprev">Show Next and Previous Link after Post?</label>
  <select style="width:270px;" name="page_nextprev" id="page_nextprev" class="form-select centered">
  <option value="'.$page_nextprev.'">'.($page_nextprev==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_pingomatic">Use Ping-O-Matic?</label>
  <select style="width:270px;" name="page_pingomatic" id="page_pingomatic" class="form-select centered">
  <option value="'.$page_pingomatic.'">'.($page_pingomatic==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_socialmedia">Show Social-Media Share Buttons?</label>
  <select style="width:270px;" name="page_socialmedia" id="page_socialmedia" class="form-select centered">
  <option value="'.$page_socialmedia.'">'.($page_socialmedia==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_comments">Show Post Comments?</label>
  <select style="width:270px;" name="page_comments" id="page_comments" class="form-select centered">
  <option value="'.$page_comments.'">'.($page_comments==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_urlblogger">Use PRAGMATIC-BLOGGIN Feature?</label>
  <select style="width:270px;" name="page_urlblogger" id="page_urlblogger" class="form-select centered">
  <option value="'.$page_urlblogger.'">'.($page_urlblogger==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_crosslink">Auto Link the Categories in the Post Content?</label>
  <select style="width:270px;" name="page_crosslink" id="page_crosslink" class="form-select centered">
  <option value="'.$page_crosslink.'">'.($page_crosslink==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_antiadblock">Use Anti-Adblock Tool?</label>
  <select style="width:270px;" name="page_antiadblock" id="page_antiadblock" class="form-select centered">
  <option value="'.$page_antiadblock.'">'.($page_antiadblock==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_hotlinks">Show "Best Posts" Links in Sidebar?</label>
  <select style="width:270px;" name="page_hotlinks" id="page_hotlinks" class="form-select centered">
  <option value="'.$page_hotlinks.'">'.($page_hotlinks==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_seekingslot">Show Seeking-Slot?</label>
  <select style="width:270px;" name="page_seekingslot" id="page_seekingslot" class="form-select centered">
  <option value="'.$page_seekingslot.'">'.($page_seekingslot==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_linkroll">Show Link-Roll?</label>
  <select style="width:270px;" name="page_linkroll" id="page_linkroll" class="form-select centered">
  <option value="'.$page_linkroll.'">'.($page_linkroll==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  <label for="page_linknumber">Number of Links in Link-Roll</label>
  <input style="width:270px;" value="'.$page_linknumber.'" name="page_linknumber" id="page_linknumber" placeholder="3" min="1" max="12" step="1" class="form-input centered" type="number" required="required">
  <br>
  <label for="DEBUG">Run Script in DEBUG Mode?</label>
  <select style="width:270px;" name="DEBUG" id="DEBUG" class="form-select centered">
  <option value="'.$DEBUG.'">'.($DEBUG==true?'YES':'NO').'</option>
  <optgroup label="Select"><option value="true">Yes</option><option value="false">No</option></optgroup>
  </select>
  </div>
  <br>
  <div style="text-align:center;width:300px;margin:auto;padding-top:30px;">
  ';
if (!isset($page_isinstalled) || $page_isinstalled==false) {
  echo '  <input class="btn btn-primary" type="submit" name="Submit" value="Go! Start the Installation">'."\n";
}else{
  message('Script is already installed!<br>Take a look at the <a href="../docu/">manual</a>!','error');
}
die('<br></div></form></body></html>');
}
print '</div></body></html>';
$filename = 'database.sql';
$mysqli_hostname = $_POST['mysqli_hostname'];
$mysqli_database = $_POST['mysqli_database'];
$mysqli_username = $_POST['mysqli_username'];
$mysqli_password = $_POST['mysqli_password'];
if($_POST['page_uselightbox']==1){$_POST['page_uselightbox']='true';}else{$_POST['page_uselightbox']='false';}
if($_POST['page_usecat']==1){$_POST['page_usecat']='true';}else{$_POST['page_usecat']='false';}
if($_POST['page_sidebar']==1){$_POST['page_sidebar']='true';}else{$_POST['page_sidebar']='false';}
if($_POST['page_showdate']==1){$_POST['page_showdate']='true';}else{$_POST['page_showdate']='false';}
if($_POST['page_catinsb']==1){$_POST['page_catinsb']='true';}else{$_POST['page_catinsb']='false';}
if($_POST['page_nextprev']==1){$_POST['page_nextprev']='true';}else{$_POST['page_nextprev']='false';}
if($_POST['page_pingomatic']==1){$_POST['page_pingomatic']='true';}else{$_POST['page_pingomatic']='false';}
if($_POST['page_socialmedia']==1){$_POST['page_socialmedia']='true';}else{$_POST['page_socialmedia']='false';}
if($_POST['page_comments']==1){$_POST['page_comments']='true';}else{$_POST['page_comments']='false';}
if($_POST['page_urlblogger']==1){$_POST['page_urlblogger']='true';}else{$_POST['page_urlblogger']='false';}
if($_POST['page_crosslink']==1){$_POST['page_crosslink']='true';}else{$_POST['page_crosslink']='false';}
if($_POST['page_antiadblock']==1){$_POST['page_antiadblock']='true';}else{$_POST['page_antiadblock']='false';}
if($_POST['page_hotlinks']==1){$_POST['page_hotlinks']='true';}else{$_POST['page_hotlinks']='false';}
if($_POST['page_seekingslot']==1){$_POST['page_seekingslot']='true';}else{$_POST['page_seekingslot']='false';}
if($_POST['page_linkroll']==1){$_POST['page_linkroll']='true';}else{$_POST['page_linkroll']='false';}
$maxRuntime = 2; // less then your max script execution limit
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$deadline         = time() + $maxRuntime;
$progressFilename = $filename.'_pointer.txt';  // tmp file for progress
$errorFilename    = $filename.'_errorlog.txt'; // tmp file for errors
print '
<html><head><meta charset="UTF-8"><title>INSTALL</title>
<body style="font-family:Consolas,\'Liberation Mono\',Menlo,Courier,monospace;">
<!--    ←↖↑↗→↘↓↙    ▁▃▄▅▆▇█▇▆▅▄▃▁      ▉▊▋▌▍▎▏▎▍▌▋▊▉       ┤┘┴└├┌┬┐
◢◣◤◥    ◐◓◑◒        |/-\\             .oO@*               ⣾⣽⣻⢿⡿⣟⣯⣷
⠁⠂⠄⡀⢀⠠⠐⠈            +x               v<^>                 -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>var duration = 600, element, step, frames = "◐◓◑◒".split("");
step = function (timestamp) {
  var frame = Math.floor(timestamp*frames.length/duration) % frames.length;
  if (!element) { element = window.document.getElementById("spinner");};
  element.innerHTML = frames[frame];
  return window.requestAnimationFrame(step);
}window.requestAnimationFrame(step);</script>
<center><br><div id="spinner">Please wait&hellip;</div></center>
';
if (ob_get_level() == 0) { ob_start(); } # OUT
$connect = mysqli_connect($mysqli_hostname, $mysqli_username, $mysqli_password) OR
  die(message('Can\'t connect to MySQL Server: '.mysqli_connect_error()));
mysqli_select_db($connect,$mysqli_database) OR
  die(message('Can\'t select MySQL Database: '.mysqli_error($connect)));
($fp = fopen($filename, 'r')) OR
  die(message('Can\'t open File: '.$filename));
if( file_exists($errorFilename) ) {
  die(message('View and Delete Error-Log File</b>: '.$errorFilename));
}
$filePosition = 0;
if ( file_exists($progressFilename) ) {
  $filePosition = file_get_contents($progressFilename);
  fseek($fp, $filePosition);
}
$queryCount = 0;
$query = '';
$exists = false;
while ( $deadline>time() AND ($line=fgets($fp, 1024000)) ) {
  if ( substr($line,0,3)=='/*!' OR
       substr($line,0,2)=='--'  OR
       trim($line)==''
     ) {
    continue;
  }
  $query .= $line;
  if ( substr(trim($query),-1)==';' ) {
    if ( !@mysqli_query($query) && !mysqli_error($connect) ) {
      message('Table allready exists!');
      $exists = true;
    }
    if ( mysqli_error($connect) ) {
      $error = 'Error performing Query: ' ."\n\n".$query. "\n\n".
      mysqli_error($connect);
      file_put_contents($errorFilename, $error."\n");
      die(message('Can\'t perform Query: '.mysqli_error($connect)));
    }
		ob_flush(); # OUT
    flush(); # OUT
		print "\n"; # OUT
    $query = '';
    file_put_contents($progressFilename, ftell($fp));
    $queryCount++;
  }
}
if ( feof($fp) ) {
  if ($exists == false) {
    message('Dump imported successfully!','ok');
  }
	if ( file_exists($progressFilename) ) {
		unlink($progressFilename);
	}
	message('Memory Peak '.(memory_get_peak_usage(true)/1024/1024).' MB','info');
  $config = "<?php

/* ⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿ *\
    PRABLO - pragmatic blogging - SETUP
\* ⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷ */

//  SET ONLY true FOR TESTING
    \$DEBUG = false;

//  DB SETTINGS
    \$mysqli_hostname = '{$_POST['mysqli_hostname']}'; // REQUIRED
    \$mysqli_database = '{$_POST['mysqli_database']}'; // REQUIRED
    \$mysqli_username = '{$_POST['mysqli_username']}'; // REQUIRED
    \$mysqli_password = '{$_POST['mysqli_password']}'; // REQUIRED

//  LOGIN SETTINGS
    \$admin_username  = '{$_POST['admin_username']}'; // MUST CHANGE
    \$admin_password  = '{$_POST['admin_password']}'; // MUST CHANGE

//  LAYOUT SETTINGS
    \$page_language   = '{$_POST['page_language']}'; // english, german OR custom
    \$page_tpl        = '{$_POST['page_tpl']}'; // milligram OR gumba
    \$page_title      = '{$_POST['page_title']}';
    \$page_tagline    = '{$_POST['page_tagline']}';
    \$page_footer     = '{$_POST['page_footer']}';
    \$page_truncate   = {$_POST['page_truncate']}; // chars for shortened view on homepage
    \$page_analytics  = '{$_POST['page_analytics']}'; // Google Analytics Tracking-ID

    \$page_uselightbox= {$_POST['page_uselightbox']}; // true/false (use lightbox)
    \$page_usecat     = {$_POST['page_usecat']}; // true/false (use category)
    \$page_sidebar    = {$_POST['page_sidebar']}; // true/false (show sidebar)
    \$page_showdate   = {$_POST['page_showdate']}; // true/false (show date)
    \$page_catinsb    = {$_POST['page_showdate']}; // true/false (show cat list)
    \$page_nextprev   = {$_POST['page_nextprev']}; // true/false (use postnavi)
    \$page_pingomatic = {$_POST['page_pingomatic']}; // true/false (use ping)
    \$page_socialmedia= {$_POST['page_socialmedia']}; // true/false (use share)
    \$page_comments   = {$_POST['page_comments']}; // true/false (use comments)
    \$page_urlblogger = {$_POST['page_urlblogger']}; // true/false (blog per url)
    \$page_crosslink  = {$_POST['page_crosslink']}; // true/false (cross links)
    \$page_antiadblock= {$_POST['page_antiadblock']}; // true/false (anti adblock)
    \$page_hotlinks   = {$_POST['page_hotlinks']}; // true/false (show hot list)
    \$page_seekingslot= {$_POST['page_seekingslot']}; // true/false (show search)
    \$page_linkroll   = {$_POST['page_linkroll']}; // true/false (use linkroll)

    \$page_linknumber = {$_POST['page_linknumber']}; // number of displayed links
    \$posts_per_page  = {$_POST['posts_per_page']}; // number of posts per page

/* ⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿ *\
    HINT - NOTHING SHOULD BE CHANGED AFTER THIS LINE ---------------
\* ⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷ */

    \$page_isinstalled= true; // SET FROM install.php

//  CONNECT TO DATABASE
    \$mysqli = mysqli_connect(
      \$mysqli_hostname,
      \$mysqli_username,
      \$mysqli_password
    );
    mysqli_select_db( \$mysqli, \$mysqli_database);

//  START SESSION
    if(session_id() == '') { session_start(); }
    \$salt = '$admin_password';
    \$session = md5(\$_SERVER['SERVER_NAME'].\$salt);

//  USE LANGUAGE-file
    require 'lang/'.\$page_language.'.php';

/* EOF - END OF FILE */";
  $folder = str_replace('/inc','',dirname($_SERVER['SCRIPT_NAME']));
  $htaccess  = "<IfModule mod_rewrite.c>\n";
  $htaccess .= "RewriteEngine On\n";
  $htaccess .= "RewriteBase ".$folder."/\n";
  $htaccess .= "RewriteRule ^index\\.php\$ – [L]\n";
  $htaccess .= "RewriteCond %{REQUEST_FILENAME} !-f\n";
  $htaccess .= "RewriteCond %{REQUEST_FILENAME} !-d\n";
  $htaccess .= "RewriteRule ^(.+)\$ ".$folder."/index.php/\$1 [L,QSA]\n";
  $htaccess .= "</IfModule>\n";
  if (!isset($page_isinstalled) || $page_isinstalled==false) {
    if ( !file_exists('settings.php') ) {
      file_put_contents('settings.php', $config);
    }
    if ( !is_writable('settings.php') ) {
      chmod('settings.php', 0644);
    }
    if ( file_put_contents('settings.php', $config) ) {
      message('File "settings.php" written successfully!','ok');
    }
    if ( !file_exists('../.htaccess') ) {
      file_put_contents('.htaccess', $htaccess);
    }
    if ( !is_writable('../.htaccess') ) {
      chmod('.htaccess', 0644);
    }
    if ( file_put_contents('../.htaccess', $htaccess) ) {
      message('File ".htaccess" written successfully!','ok');
    }
  }
} else {
  print '<meta http-equiv="refresh" content="'.($maxRuntime + 2).'">';
  print '<p>'.$queryCount.' Queries processed.</p>';
  print (round(ftell($fp) / filesize($filename), 2) * 100).'% done!</p>';
  print '<p>Please wait for automatic Browser Refresh.';
}
ob_end_flush(); # OUT

/* EOF - END OF FILE */
