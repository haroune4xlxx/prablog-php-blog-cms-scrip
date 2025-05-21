<?php

if($_SERVER['REQUEST_METHOD'] == 'GET') {
  
  // GET CONTENT
  $fp = @file_get_contents($_GET['url']);
  
  // GET TITLE
  preg_match("/<title>(.*)<\/title>/siU",$fp,$tmatch);
  $title = preg_replace('/\s+/',' ',@$tmatch[1]);
  $title = trim($title);
    
  // GET META-TAGS
  // https://moz.com/blog/meta-data-templates-123
  $c = get_meta_tags2($fp);
  if(isset($c['twitter:image']) && !empty($c['twitter:image'])){$image = $c['twitter:image'];}
  if(isset($c['image']) && !empty($c['image'])){$image = $c['image'];}
  if(isset($c['og:image']) && !empty($c['og:image'])){$image = $c['og:image'];}
  if(empty($image)){
    preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $fp, $imatch);
    $image = @$imatch[1];
  }
  if (substr( $image, 0, 4 ) != "http" && substr( $image, 0, 10 ) != "data:image") {
    $image = rtrim($_GET['url'],'/').'/'.ltrim($image,'/');
  }
  
  // RETURN JSON
  $json = array(
    array('field'=>'title','value'=>$title),
    array('field'=>'content','value'=>@$c['description']),
    array('field'=>'image','value'=>@$image),
  );
  
  // OUTPUT
  echo json_encode($json);
}

// HELPER
function get_meta_tags2($str){
  $pattern = '
  ~<\s*meta\s

  # using lookahead to capture type to $1
    (?=[^>]*?
    \b(?:name|property|itemprop|http-equiv)\s*=\s*
    (?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
    ([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
  )

  # capture content to $2
  [^>]*?\bcontent\s*=\s*
    (?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
    ([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
  [^>]*>

  ~ix';
  if(preg_match_all($pattern, $str, $out))
    return array_combine($out[1], $out[2]);
  return array();
}
