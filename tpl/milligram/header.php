<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title><?php echo $title; ?></title>
 <meta name="discription" content="<?php echo $page_tagline; ?>">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="icon" href="<?php echo $page_url; ?>tpl/milligram/icon.png">
 <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
 <link rel="stylesheet" href="<?php echo $page_url; ?>tpl/milligram/milligram.min.css">
 <link rel="stylesheet" href="<?php echo $page_url; ?>tpl/milligram/custom.css?<?php echo time(); ?>">
 <link rel="stylesheet" href="<?php echo $page_url; ?>tpl/milligram/fluidbox.min.css">
</head>
<body style="z-index:10;"><?php if(@$page_antiadblock==true): ?>
 <link rel="stylesheet" href="<?php echo $page_url; ?>tpl/stickyAdBlock.css" type="text/css">
 <tt class="disabledcss">
  Please disable your ad blocker! &mdash;
  Bitte deaktiviere Deinen Werbeblocker! &mdash;
  Veuillez désactiver votre bloqueur de publicité! &mdash;
  Por favor, desactive el bloqueador de anuncios!
 </tt><?php endif; ?>
 <header class="header" id="home">
  <section class="container">
   <h1 class="title"><?php echo $page_title.$demo; ?></h1>
   <a class="button" href="<?php echo $page_url; ?>"><?php echo $lang['Headline']; ?></a>
   <p class="description"><?php echo $page_tagline; ?></p>
   <p><?php echo @$main_navi; ?></p>
  </section>
 </header>
 <form action="<?php echo $page_url; ?>index.php"><?php if(@$page_seekingslot==true): ?>
  <input type="search" name="q" results="7" value="<?php echo @$q; ?>" placeholder="<?php echo $lang['Search']; ?>&hellip;" onfocus="this.value='';"><?php endif; ?>
 </form>
 <section class="container" id="blog">
<?php if(@$page_sidebar==true): ?>
  <div class="row">
   <div class="column column-80">
<?php endif; ?>
