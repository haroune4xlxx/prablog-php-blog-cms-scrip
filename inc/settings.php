<?php

/* ⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿ *\
    PRABLO - pragmatic blogging - SETUP
\* ⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷ */

//  SET ONLY true FOR TESTING
    $DEBUG = false;
    $DEMO = TRUE;

//  DB SETTINGS
    $mysqli_hostname = 'localhost'; // REQUIRED
    $mysqli_database = 'test'; // REQUIRED
    $mysqli_username = 'root'; // REQUIRED
    $mysqli_password = 'root'; // REQUIRED

//  LOGIN SETTINGS
    $admin_username  = 'demo'; // MUST CHANGE
    $admin_password  = 'demo'; // MUST CHANGE

//  LAYOUT SETTINGS
    $page_language   = 'english'; // english, german OR custom
    $page_tpl        = 'milligram'; // milligram OR gumba
    $page_title      = 'PRABLO';
    $page_tagline    = 'pragmatic blogging';
    $page_footer     = 'powered by adilbo';
    $page_truncate   = 260; // chars for shortened view on homepage
    $page_analytics  = 'UA-11223344-1'; // Google Analytics Tracking-ID

    $page_uselightbox= true; // true/false (use lightbox)
    $page_usecat     = true; // true/false (use category)
    $page_sidebar    = true; // true/false (show sidebar)
    $page_showdate   = true; // true/false (show date)
    $page_catinsb    = true; // true/false (show cat list)
    $page_nextprev   = true; // true/false (use postnavi)
    $page_pingomatic = true; // true/false (use ping)
    $page_socialmedia= true; // true/false (use share)
    $page_comments   = true; // true/false (use comments)
    $page_urlblogger = true; // true/false (blog per url)
    $page_crosslink  = true; // true/false (cross links)
    $page_antiadblock= true; // true/false (anti adblock)
    $page_hotlinks   = true; // true/false (show hot list)
    $page_seekingslot= true; // true/false (show search)
    $page_linkroll   = true; // true/false (use linkroll)

    $page_linknumber = 1; // number of displayed links
    $posts_per_page  = 2; // number of posts per page

/* ⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿⢿⡿ *\
    HINT - NOTHING SHOULD BE CHANGED AFTER THIS LINE ---------------
\* ⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷⣾⣷ */

    $page_isinstalled= false; // SET FROM install.php

//  CONNECT TO DATABASE
    $mysqli = mysqli_connect(
      $mysqli_hostname,
      $mysqli_username,
      $mysqli_password
    );
    mysqli_select_db( $mysqli, $mysqli_database);

//  START SESSION
    if(session_id() == '') { session_start(); }
    $salt = 'demo';
    $session = md5($_SERVER['SERVER_NAME'].$salt);

//  USE LANGUAGE-file
    require 'lang/'.$page_language.'.php';

/* EOF - END OF FILE */
