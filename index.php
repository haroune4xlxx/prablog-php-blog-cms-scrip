<?php
/* ⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿ *\
    MAIN (444 Lines ;-)
\* ⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷ */

// SETUP VARs
$echo = ''; $i = 0;

// INCLUDE CONFIG
include 'inc/settings.php';

// SETUP URL
$page_url = 'http'.(!empty($_SERVER['HTTPS'])?'s':'').'://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']).'/';

// .htaccess SLUG
@list($folder,$slug,$tag)=explode('/',trim(str_replace('-',' ',str_replace('.php','',$_SERVER['REQUEST_URI'])),'/'),3);

// IF DEMO
if(isset($DEMO) && $DEMO==true){
  $demo = ' <sup style="background-color:#d9534f;display:inline;padding:.2em .6em .2em;font-size:50%;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:top;border-radius:.25em;">DEMO</sup>'."\n";
}else{
  $demo = '';
}

// PAGINATION
if(isset($_GET['page'])){
    $page_number = (int)$_GET["page"];
    $slug = '';
}else{
    $page_number = 1;
}
$page_position = (($page_number-1) * $posts_per_page);
function paginate($posts_per_page=10, $current_page, $total_records){
  $pagination = '';
  $total_pages = ceil($total_records/$posts_per_page);
  $page_url = 'http'.(!empty($_SERVER['HTTPS'])?'s':'').'://'.
    $_SERVER['SERVER_NAME'].strtok($_SERVER["REQUEST_URI"],'?');
  if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ // verify total pages and current page number
    $pagination .= '<ul class="pagination">';
    $right_links    = $current_page + 3;
    $previous       = $current_page - 3; // previous link
    $next           = $current_page + 1; // next link
    $first_link     = true; // boolean var to decide our first link
    if($current_page > 1){
      $previous_link = $current_page - 1;
      $pagination .= '<li class="first"><a href="'.$page_url.'?page=1" title="First">&lt;&lt;</a></li>'; // first link
      $pagination .= '<li><a href="'.$page_url.'?page='.$previous_link.'" title="Previous">&lt;</a></li>'; // previous link
      for($i = ($current_page-2); $i < $current_page; $i++){ // Create left-hand side links
        if($i > 0){
          $pagination .= '<li><a href="'.$page_url.'?page='.$i.'">'.$i.'</a></li>';
        }
      }
      $first_link = false; // set first link to false
    }
    if($first_link){ // if current active page is first link
      $pagination .= '<li class="first active">'.$current_page.'</li>';
    }elseif($current_page == $total_pages){ // if it's the last active link
      $pagination .= '<li class="last active">'.$current_page.'</li>';
    }else{ // regular current link
      $pagination .= '<li class="active">'.$current_page.'</li>';
    }
    for($i = $current_page+1; $i < $right_links ; $i++){ // create right-hand side links
      if($i<=$total_pages){
        $pagination .= '<li><a href="'.$page_url.'?page='.$i.'">'.$i.'</a></li>';
      }
    }
    if($current_page < $total_pages){
      $next_link = $current_page + 1;
      $next_link = $current_page + 1;
      $pagination .= '<li><a href="'.$page_url.'?page='.$next_link.'" >&gt;</a></li>'; // next link
      $pagination .= '<li class="last"><a href="'.$page_url.'?page='.$total_pages.'" title="Last">&gt;&gt;</a></li>'; // last link
    }
    $pagination .= '</ul><br>';
  }
  return $pagination; // return pagination links
}

// IF SEARCH
if ( isset($_REQUEST['q']) && $_REQUEST['q'] != '' ) {
  $q = str_replace("'", "`", $_REQUEST['q']);
  $q = str_replace('"', "``", $q);
  $q = str_replace("\\", "/", $q);
  $q = str_replace("<", "[", $q);
  $q = str_replace(">", "]", $q);
  $query = "SELECT *,(
  (
    ROUND ( ( LENGTH(title)
    - LENGTH( REPLACE ( LOWER(title), '".mb_strtolower($q)."', '') )
    ) / LENGTH('".mb_strtolower($q) . "') )
  )+(
    ROUND ( ( LENGTH(content)
    - LENGTH( REPLACE ( LOWER(content), '".mb_strtolower($q)."', '') )
    ) / LENGTH('".mb_strtolower($q)."') )
  )
  ) as relevance
  FROM prablo WHERE
    title LIKE '%".$q ."%' OR
    content LIKE '%".$q."%'
  ORDER BY relevance DESC LIMIT 0,10"; // SEARCH
  $echo .= '<h1><em>'.$q.'</em></h1>';
}
elseif ( isset($tag) && $tag != '' ) { // IF CATEGORY
  $tag = str_replace("'", "`", $tag);
  $tag = str_replace('"', "``", $tag);
  $tag = str_replace("\\", "/", $tag);
  $tag = str_replace("<", "[", $tag);
  $tag = str_replace(">", "]", $tag);
  $query = "SELECT * FROM prablo WHERE
  REPLACE(categories, ' ', '') LIKE
  '%".str_replace(' ', '-', $tag) ."%'
  ORDER BY fixed DESC, id DESC LIMIT 0, 10";
  $echo .= '<h1><em>'.$tag.'</em></h1>';
}
elseif ( $slug != '' && $slug != 'index' && !isset($_GET['id']) ) { // IF SEO URL
  $query = "SELECT * FROM prablo WHERE title = '" . $slug . "'";
  if (!preg_match("/".$_SERVER['SERVER_NAME']."/i",@$_SERVER['HTTP_REFERER'])) { // IF EXTERN VISITOR +1
    $update = "UPDATE prablo SET count = count + 1 WHERE title = '" . $slug . "'";
    $result = mysqli_query($mysqli,$update) or die('LINE '.__LINE__.' &mdash; '.mysqli_error($mysqli));
  }
}
else if ( isset($_GET['id']) && is_numeric($_GET['id']) ) { // IF ID
  $query = "SELECT * FROM prablo WHERE id = '" . $_GET['id'] . "'";
}
else { // ALL POSTS
  $query = "SELECT * FROM prablo WHERE page = 0 ORDER BY fixed DESC, id DESC LIMIT $page_position, $posts_per_page";
}

// EXECUTE QUERY
$result = mysqli_query($mysqli,$query) or header('Location: inc/install.php');

// ALL NAVI LINKS
$main_navi = '';
$mysql = "SELECT title FROM prablo WHERE page = 1 ORDER BY title ASC";
$res = mysqli_query($mysqli,$mysql) or die('LINE '.__LINE__.' &mdash; '.mysqli_error($mysqli));
while($mysql_mainnavi = mysqli_fetch_array($res)) {
  $navi = str_replace(' ', '-', $mysql_mainnavi['title']);
  $main_navi .= '    <a href="'.$page_url.$navi.'.php">'.
  $mysql_mainnavi['title'].'</a> | ';
}
$main_navi = rtrim($main_navi,'| ');

// ALL CATEGORIES
if(@$page_sidebar == true && $page_catinsb == true && $page_usecat == true){
  $cat_sidebar = '    <h2 title="&#9207;">'.$lang['Categories'].'</h2>'."\n";
  $mysql = "SELECT categories FROM prablo ORDER BY categories DESC";
  $res = mysqli_query($mysqli,$mysql) or die('LINE '.__LINE__.' &mdash; '.mysqli_error($mysqli));
  while($mysql_catsidebar = mysqli_fetch_array($res)) {
    $cats[] = explode(',', $mysql_catsidebar['categories'].',');
  }
  $objTmp = (object) array('aFlat' => array());
  array_walk_recursive($cats, create_function('&$v, $k, &$t', '$t->aFlat[] = $v;'), $objTmp);
  $objTmp->aFlat = array_unique($objTmp->aFlat); // DEL DUPLICATES
  $objTmp->aFlat = array_filter($objTmp->aFlat); // DEL EMPTY
  natcasesort($objTmp->aFlat);
  foreach($objTmp->aFlat as $cat){
    $cat_sidebar .= '    <a href="'.$page_url.'tag/'.$cat.'.php">'.$cat.'</a><br>'."\n";
  }
  $cat_sidebar .= '    <br>'."\n";
}

// HELPER preg_replace_callback
function prc($matches){
  $content = str_replace('<br/>','',     $matches[1]);
  $content = str_replace('[',    '&lt;', $content);
  $content = str_replace(']',    '&gt;', $content);
  $content = str_replace('``',   '"',    $content);
  $content = str_replace('`',    "'",    $content);
  return '<pre><code>'.$content.'</code></pre>';
}

// POST LOOP
while($mysql_details = mysqli_fetch_array($result)) {

  // PREP DATA
  $post_id         = $mysql_details['id'];
  $post_url        = $mysql_details['url'];
  $post_title      = $mysql_details['title'];
  $post_content    = $mysql_details['content'];
  $post_date       = $mysql_details['date'];
  $post_count      = $mysql_details['count'];
  $post_categories = $mysql_details['categories'];
  $post_fixed      = $mysql_details['fixed'];
  $post_page       = $mysql_details['page'];

  // NO CONTENT FOR new ENTRY
  if (isset($_GET['create']) && $_GET['create'] == 'YES') { break; }

  // CROSSLINK
  foreach($objTmp->aFlat as $cat){
    if(isset($page_crosslink) && $page_crosslink == true && @$_GET['admin'] != 'YES'){
      $post_content = str_replace($cat, '<a href="'.$page_url.'tag/'.$cat.'.php">'.$cat.'</a>', $post_content);
    }
  }

  // BBCODE REPLACEMENT
  $search = array(
    "/\n/",
    '/\[img\](.*?)\[\/img\]/iu',
    '/\[url\](.*?)\[\/url\]/iu',
    '/\[youtube\](.*?)\[\/youtube\]/iu',
  );
  if(@$page_uselightbox==true){
    $image = '<a href="$1" rel="lightbox"><img class="zoom" src="$1" alt="$1" title="$1"></a>';
  }else{
    $image = '<img src="$1" alt="$1" title="$1">';
  }
  $replace = array(
    '<br/>',
    $image,
    '<a rel="nofollow" target="_blank" href="$1">$1</a>',
    '<div class="video"><iframe width="560" height="349" src="https://www.youtube.com/embed/$1?rel=0&amp;controls=0&amp;showinfo=0?ecver=1" frameborder="0" allowfullscreen></iframe></div>'
  );
  $post_content_c = preg_replace($search, $replace, $post_content);
  $post_content_c = preg_replace_callback('/\[code\](.*?)\[\/code\]/isu', 'prc', $post_content_c);


  // DEL BBCODE FOR TRUNCATED CONTENT
  $replace = array(' ', ' ', ' ', ' ');
  $truncate = preg_replace($search, $replace, $post_content);
  $truncate = preg_replace('/\[code\](.*?)\[\/code\]/isu', ' ', $truncate);
  $truncate = strip_tags($truncate, '<br><br/>');

  // PREP ONE POST
  if (( $slug != '' &&
         $slug != 'index' &&
         !isset($_GET['id']) &&
         !isset($_REQUEST['q']) &&
         !isset($tag)
       ) || @$_GET['admin'] == 'YES' )
  {

    // HEADLINE
    $echo .= '    <h2>'.$post_title.'</h2>'."\n";

    // EDIT LINK (http://www.amp-what.com/)
    $modify_post_link = '    <a class="button button-outline dialog" title="EDIT or DELETE POST" href="'.$page_url.'inc/login.php?id='.$post_id.'&admin=YES">&#10000; '.$lang['Edit'].'</a>'."\n";

    // CONTENT
    $echo .= '    <h4>'.$post_content_c.'</h4>'."\n";

    // EXTERN LINK
    if(@$post_url != ''){
      $echo .= '    <a href="'.$page_url.$post_url.'">'.$post_url.'</a>'."\n";
    }

    // DATUM
    $echo .= '    <div class="clearfix"></div>'."\n";
    if(@$page_showdate == true && $post_page != 1){
      $echo .= '    <h5>'.$post_date.'</h5>'."\n";
    }

    // SOCIAL MEDIA
    if(isset($page_socialmedia) && $page_socialmedia == true && $post_page != 1){
      $echo .= '   <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=593fc711552b8b00126974d1&product=inline-share-buttons"></script>'."\n";
      $echo .= '   <div class="sharethis-inline-share-buttons"></div>'."\n";
    }

    // TAGS
    $categories = '    <blockquote>'."\n";
    $tags = explode(',',$post_categories.',');
    $tags = array_filter($tags); // DEL EMPTY VALUES
    natcasesort($tags);
    foreach($tags as $tag){
      $categories .= '     <a href="'.$page_url.'tag/'.$tag.'.php">'.$tag.'</a> &mdash; '."\n";
    }
    $categories = rtrim($categories," &mdash; \n");
    $categories .= "\n".'    </blockquote>'."\n";
    if (count($tags) > 0 && $page_usecat == true) {
      $echo .= $categories;
    }

    // NEXT/PREV NAVI
    if( isset($page_nextprev) &&
        $page_nextprev == true &&
        @$_GET['admin'] != 'YES' &&
        $post_page != 1
      ){
      $next = 'SELECT * FROM prablo WHERE id = (SELECT min(id) FROM prablo WHERE id > '.$post_id.') AND page = 0';
      $result_next = mysqli_query($mysqli,$next) or die('LINE '.__LINE__.' &mdash; '.mysqli_error($mysqli));
      $next_details = mysqli_fetch_array($result_next);
      if(isset($next_details['id'])){
        $link = str_replace(' ', '-', $next_details['title']);
        $next_link = '   <a class="button float-right bordered" href="'.$page_url.$link.'.php">'.$next_details['title'].' &raquo;</a>'."\n";
      }
      $previous = 'SELECT * FROM prablo WHERE id = (SELECT max(id) FROM prablo WHERE id < '.$post_id.') AND page = 0';
      $result_prev = mysqli_query($mysqli,$previous) or die('LINE '.__LINE__.' &mdash; '.mysqli_error($mysqli));
      $prev_details = mysqli_fetch_array($result_prev);
      if(isset($prev_details['id'])){
        $link = str_replace(' ', '-', $prev_details['title']);
        $previous_link = '    <a class="button float-left bordered" href="'.$page_url.$link.'.php">&laquo; '.$prev_details['title'].'</a>'."\n";
      }
    }

    // COMMENTS
    if(isset($page_comments) && $page_comments == true && $post_page != 1){
      $post_link = str_replace(' ', '-', $post_title);
      $echo .= '    <div id="disqus_thread"></div>
    <script>
     var disqus_config = function () {
      this.page.url = "'.$page_url.$post_link.'.php";
      this.page.identifier = '.$post_id.';
     };
     (function() {
      var d = document, s = d.createElement("script");
      s.src = "https://adilbo.disqus.com/embed.js";
      s.setAttribute("data-timestamp", +new Date());
      (d.head || d.body).appendChild(s);
     })();
    </script>'."\n";
    }
  }
  // PREP ALL POSTs WITH TRUNCATED CONTENT
  else {

    // DEBUG ONLY
    if(@$DEBUG==true && @$q != ''){
      $echo .= '<tt style="color:red">'.$mysql_details['relevance'].'</tt>';
    }

    // LINKES HEADLINE
    $post_link = str_replace(' ', '-', $post_title);
    $echo .= '    <h2 class="fixed'.$post_fixed.'"><a href="'.$page_url.$post_link.'.php">'.$post_title.'</a></h2>'."\n";

    // TRUNCATED CONTENT
    if(@$page_truncate > 0){
      $echo .= '    <h4>'.@substr($truncate,0,strrpos(substr($truncate,0,$page_truncate),' ')).'&hellip;</h4>'."\n";
      $echo .= '    <div class="clearfix"></div>'."\n";
    }
  }

  // FOOTER LINE
  $echo .= '    <hr size="1">'."\n";

  // INCREMENT HELPER FOR (TITLE 4 HEADER)
  $i++;

}// END POST LOOP

// PAGINATION https://www.sanwebe.com/2011/05/php-pagination-function
if ( ($slug == '' || $slug == 'index') && (
       !isset($_GET['id']) &&
       !isset($_REQUEST['q']) &&
       !isset($tag)
   ) ) {
  $query = "SELECT COUNT(*) AS total FROM prablo WHERE page = 0";
  $result = mysqli_query($mysqli,$query) or die('LINE '.__LINE__.' &mdash; '.mysqli_error($mysqli));
  $total_rows = mysqli_fetch_array($result);
  $echo .= paginate(2, $page_number, $total_rows['total']);
}

// TITLE 4 HEADER (max. 71 chars)
if($i > 1){
  $title = mb_substr($page_title,0,71);
}else{
  $title = mb_substr(@$post_title,0,71-(strlen($page_title)+3)).' ► '.$page_title;
}

// INCLUDE HEADER
include 'tpl/'.$page_tpl.'/header.php';

// DEBUG ONLY
if(@$DEBUG==true){
  $echo .= '<tt style="color:red">'.$query.'</tt>';
}

// IF NOTHING FOUND AFTER SEARCH
if($i < 1 && @$q != ''){
  $echo .= '<h1>'.$lang['error_head'].'</h1><p><strong>'.$lang['error_text'].'</strong></p>';
}

// OUTPUT ALL
echo $echo;

// IF ADMIN
if (
    @$_GET['admin'] == 'YES' &&
    ((isset($_GET['id']) && is_numeric($_GET['id'])) || $_GET['create'] == 'YES' )
   ) {

  // SETUP VARs
  $post_new = $mode = '';

  // NEW POST
  if (isset($_GET['create']) && $_GET['create'] == 'YES') {
    $post_new = 'YES';
    include 'inc/date.php';
    $post_date = dateFormat();
    $echo .=  '  <h2>'.$lang['NEW ENTRY'].'</h2>';
    if(isset($page_urlblogger) && $page_urlblogger == true && (!isset($DEMO)||$DEMO==false)) {
      $mode  = 'visibility:hidden';
    }
    $mode2 = 'visibility:hidden';
  }

  // INCLUDE ADMIN
  include 'tpl/admin.php';
}

// IF GOOGLE ANALYTICS
if(isset($page_analytics) && !empty($page_analytics) && @$_GET['admin'] != 'YES'){
  $tracking = " <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();
  a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', '".$page_analytics."', 'auto');ga('send', 'pageview');
 </script>\n";
}

// IF SIDEBAR
if(@$page_sidebar == true && @$page_hotlinks == true){
  // HOT POSTS
  $hot_post = '    <h2 title="&#9207;">'.$lang['HOT'].'</h2>'."\n";
  $mysql = "SELECT * FROM prablo WHERE count > 0 ORDER BY count DESC LIMIT 7";
  $res = mysqli_query($mysqli,$mysql) or die('LINE '.__LINE__.' &mdash; '.mysqli_error($mysqli));
  while($mysql_hotpost = mysqli_fetch_array($res)) {
    $link = str_replace(' ', '-', $mysql_hotpost['title']);
    $hot_post .= '    <a href="'.$page_url.$link.'.php">'.$mysql_hotpost['title'].'</a><br>'."\n";
  }
  $hot_post .= '    <br>'."\n";
}

// LINK-ROLL (ADs)
if(@$page_sidebar == true && $page_linkroll == true && file_exists('roll/data.txt')){
  $ads = file('roll/data.txt');
  $add_roll = '    <h2 title="&#9207;">'.$lang['Links'].'</h2>'."\n";
  $count = count($ads);
  shuffle($ads);
  $c = 0;
  foreach($ads as $ad){
    $c++;
    if ($c > $page_linknumber) {
        break;
    }
    $ad = str_replace('{URL-TO-ROLL-FOLDER}',rtrim($page_url,'/'),$ad);
    $add_roll .= '    <div class="link">'.trim($ad).'</div>'."\n";
  }
  $add_roll .= '    <br>'."\n";
  if($count < 1){
    $add_roll = '';
  }
}

// INCLUDE FOOTER
include 'tpl/'.$page_tpl.'/footer.php';
