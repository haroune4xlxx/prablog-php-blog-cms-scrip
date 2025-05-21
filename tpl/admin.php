
  <form method="post" action="inc/form.php">
   <label id="spinner"><?php echo $lang['Link']; ?>
   <input type="text" id="url" name="url" value="<?php echo @$post_url; ?>"placeholder="http://www.example.com/">
   <?php if(isset($page_urlblogger) && $page_urlblogger == true){echo '<small>'.$lang['Linkinfo'].'</small>';} ?>
   </label><br>
   <span id="hide" style="<?php echo $mode; ?>">
   <label><?php echo $lang['Title']; ?>
   <input type="text" id="title" name="title" value="<?php echo @$post_title; ?>"></label><br>
   <label><?php echo $lang['Content']; ?>
   <script>
   function textAreaAdjust(o){o.style.height="1px";o.style.height=(20+o.scrollHeight)+"px";}
   </script>
   <textarea onfocus="textAreaAdjust(this)" onkeyup="textAreaAdjust(this)" onkeydown="textAreaAdjust(this)" id="content" name="content" style="height:180px" rows="20"><?php echo @$post_content; ?></textarea></label><br>
   <b><?php echo $lang['Tags']; ?></b><br>
   <small>
    [url]http://google.com[/url] &nbsp;
    [img]http://pipsum.com/800x600.jpg[/img] &nbsp;
    [youtube]dk9uNWPP7EA[/youtube] &nbsp;
    [code]#id{color:#9b4dca;}[/code]<br>
   </small>
   <br><?php if(@$page_usecat == true): ?>
   <?php /* github.com/developit/tags-input */ ?>
   <link rel="stylesheet" href="<?php echo $page_url; ?>tpl/tags-input.css">
   <script src="<?php echo $page_url; ?>tpl/tags-input.js"></script>
   <label><?php echo $lang['Categories']; ?>
   <input type="tags" id="categories" name="categories" value="<?php echo @$post_categories; ?>"></label>
   <script>[].forEach.call(document.querySelectorAll('input[type="tags"]'), tagsInput);</script><?php endif; ?><br>
   <label><?php echo $lang['Date']; ?>
   <input type="text" name="date" value="<?php echo @$post_date; ?>"></label>
   <label for="fixed"><input id="fixed" <?php echo (@$post_fixed==1)?'checked':'' ; ?> type="checkbox" name="fixed" value="1"> <?php echo $lang['Fixed']; ?></label>
   <label for="page"><input id="page" <?php echo (@$post_page==1)?'checked':'' ; ?> type="checkbox" name="page" value="1"> <?php echo $lang['Page']; ?></label>
   <input type="hidden" name="new" value="<?php echo $post_new; ?>">
   <input type="hidden" name="id" value="<?php echo @$post_id; ?>">
   <input type="hidden" name="count" value="<?php echo @$post_count; ?>">
   <label for="del" style="float:right"><input id="del" type="checkbox" name="post_delete" value="YES"> <?php echo $lang['Delete?']; ?></label><br>
   <input class="button" type="submit" value="<?php echo $lang['SAVE']; ?>">
   </span>
  </form>
<?php if(isset($page_urlblogger) && $page_urlblogger == true): ?>
  <style>/* https://stephanwagner.me/only-css-loading-spinner */
    @keyframes spinner{to{transform:rotate(360deg)}}
    .spinner:before{content:'';box-sizing:border-box;position:absolute;
    top:43px;left:-20px;width:20px;height:20px;margin-top:-10px;
    margin-left:-10px;border-radius:50%;border:2px solid #ccc;
    border-top-color:#333;animation:spinner .6s linear infinite}
    .spinner{position:relative}</style>
  <script src="//code.jquery.com/jquery-latest.js" type="text/javascript"></script>
  <script type="text/javascript">
  $("#url").bind("change", function(e){
    $('#spinner').addClass('spinner');
    $.getJSON("<?php echo $page_url; ?>inc/ajax.php?url=" + $("#url").val(),
    function(data){
      $.each(data, function(i,item){
        if (item.field == "title") {
          $("#title").val(item.value);
        }else if (item.field == "content") {
          $("#content").val(item.value);
        }else if (item.field == "image") {
          $("#content").val($("#content").val()+"\n[img]"+item.value+"[/img]");
        }
        $("#hide").css('visibility', 'visible');
        $('#spinner').removeClass('spinner');
      });
    });
  });
  </script><?php endif; ?>
