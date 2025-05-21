<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
  <meta name="discription" content="<?php echo $page_tagline; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php echo $page_url; ?>tpl/gumba/favicon.ico">
	<link rel="stylesheet" href="<?php echo $page_url; ?>tpl/gumba/fluidbox.min.css">
	<link rel="stylesheet" href="<?php echo $page_url; ?>tpl/gumba/gumba.css">
  <link rel="stylesheet" href="<?php echo $page_url; ?>tpl/gumba/custom.css?<?php echo time(); ?>">
</head>
<body>
<?php if(@$page_antiadblock==true): ?>
 <link rel="stylesheet" href="<?php echo $page_url; ?>tpl/stickyAdBlock.css" type="text/css">
 <tt class="disabledcss">
  Please disable your ad blocker! &mdash;
  Bitte deaktiviere Deinen Werbeblocker! &mdash;
  Veuillez désactiver votre bloqueur de publicité! &mdash;
  Por favor, desactive el bloqueador de anuncios!
 </tt><?php endif; ?>
	<header>
		<div id="logo-container">
			<div id="logo"><a href="<?php echo $page_url; ?>"><?php echo $page_title.$demo; ?></a></div>
			<div id="subtitle"><?php echo $page_tagline; ?></div>
		</div>
 		<nav>
     <form action="<?php echo $page_url; ?>index.php"><?php if(@$page_seekingslot==true): ?>
      <input type="search" name="q" results="7" value="<?php echo @$q; ?>" placeholder="<?php echo $lang['Search']; ?>&hellip;" onfocus="this.value='';"><?php endif; ?>
      <ul>
			 <li><?php echo @$main_navi; ?></li>
		  </ul>
     </form>
		</nav>
	</header>
	<div id="content" style="border-top:2px solid #e85151;padding-top:50px;">
