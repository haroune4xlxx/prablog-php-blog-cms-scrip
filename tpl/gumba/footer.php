<?php if(@$page_nextprev==true): ?>
<?php echo @$previous_link; ?>
<?php echo @$next_link; ?>
<?php endif; ?>

    <section class="row" style="border-top:2px solid #e85151;border-bottom:2px solid #e85151;margin-top:50px;">
     <div class="col">
<?php echo @$hot_post; ?>
<?php echo @$cat_sidebar; ?>
     </div>
     <div class="col">
<?php echo @$add_roll; ?>
     </div>
    </section>

		<section class="row">
			<div class="col-full">
				<p>
					<?php echo @$page_footer; ?>
				</p>
			</div>
		</section>
    <div style="float:right">
<?php echo @$modify_post_link; ?>
<?php if(basename($_SERVER['SCRIPT_FILENAME'])!='login.php'): ?>
    <a class="button button-outline dialog" title="NEW POST" href="<?php echo $page_url; ?>inc/login.php?create=YES&admin=YES">&boxbox; <?php echo $lang['New']; ?></a>
<?php endif; ?>
<?php if(@$_SESSION["$session"]==true): ?>
    <a class="button button-outline dialog" title="LOGOUT" href="<?php echo $page_url; ?>inc/login.php?logout=YES">&times; <?php echo $lang['Exit']; ?></a><?php endif; ?>
     </div>


	</div>
	<script src="<?php echo $page_url; ?>tpl/gumba/js/jquery.1.11.min.js"></script>
	<script src="<?php echo $page_url; ?>tpl/gumba/js/jquery.fluidbox.min.js"></script>
	<script src="<?php echo $page_url; ?>tpl/gumba/js/gumba.js"></script>
	<?php echo @$tracking; ?>
</body>
</html>