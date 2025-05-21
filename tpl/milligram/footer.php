<?php if(@$page_nextprev==true): ?>
<?php echo @$previous_link; ?>
<?php echo @$next_link; ?>
<?php endif; ?>
<?php if(@$page_sidebar==true): ?>
   </div>
   <div class="column column-20">
<?php echo @$hot_post; ?>
<?php echo @$cat_sidebar; ?>
<?php echo @$add_roll; ?>
   </div>
  </div>
<?php endif; ?>
  <h6 style="text-align:center">
   <div class="float-left">
    <?php echo @$page_footer; ?>
   </div>
   <div class="float-right">
<?php echo @$modify_post_link; ?>
<?php if(basename($_SERVER['SCRIPT_FILENAME'])!='login.php'): ?>
    <a class="button button-outline dialog" title="NEW POST" href="<?php echo $page_url; ?>inc/login.php?create=YES&admin=YES">&boxbox; <?php echo $lang['New']; ?></a>
<?php endif; ?>
<?php if(@$_SESSION["$session"]==true): ?>
    <a class="button button-outline dialog" title="LOGOUT" href="<?php echo $page_url; ?>inc/login.php?logout=YES">&times; <?php echo $lang['Exit']; ?></a><?php endif; ?>
   </div>
  </h6>
 </section>
<script src="<?php echo $page_url; ?>tpl/milligram/js/jquery.1.11.min.js"></script>
<script src="<?php echo $page_url; ?>tpl/milligram/js/jquery.fluidbox.min.js"></script>
<script src="<?php echo $page_url; ?>tpl/milligram/js/milligram.js"></script>
<?php echo @$tracking; ?>
</body>
</html>