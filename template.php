<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="eng" lang="eng">
<?php global $ki_id; $options=get_option($ki_id . 'utopia_ucp_options'); $KI=new ki_check(); $template_url=plugins_url( '' , __FILE__ ). "/"; ?>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Moskva Yigit [moskvayigit.com]" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title><?php global $page, $paged; wp_title( '|', true, 'right' ); // Add the blog name. bloginfo( 'name' ); ?></title>
    <link rel="stylesheet" media="screen" href="<?php echo $template_url; ?>assets/_css/style.css" type="text/css" />
</head>

<body>
    <aside id="container">
        <div id="stage" class="stage"><div id="clouds" class="stage"></div></div>
        <?php $style="" ; $pic="" ; if ($KI->im_isset_var2($options,$ki_id . 'cartoon')!="") { $pic = $KI->im_isset_var2($options,$ki_id . 'cartoon'); $pic = $template_url . "assets/_images/" . $pic; $style = ' style="background:url('. $pic .')"'; } ?>
        <div id="me" <?php echo $style; ?>></div>
        <div id="land"></div>
    </aside>

    <footer>
        <div id="defaultCountdown"></div>
        <div class="text-area"><?php $message="We are currently under construction! Please, visit again later." ; if ($KI->im_isset_var($options[$ki_id . 'message'])!="") $message = $options[$ki_id . 'message']; echo $message; ?><p><br />Made by love at <a class="ki" href="https://krasotaiskusstva.com" target="_blank"> Krasota Iskusstva</a></div>
    </footer>

    <script src="<?php echo $template_url; ?>assets/_js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo $template_url; ?>assets/_js/countdown.js" type="text/javascript"></script>
    <script src="<?php echo $template_url; ?>assets/_js/spritely.js" type="text/javascript"></script>
    <script type='text/javascript'>
        <?php

		$launch_date  = "2020-01-01";
		if ($KI->im_isset_var($options[$ki_id . 'launch_date'])!="")
		$launch_date = $options[$ki_id . 'launch_date'];
		$launch_date = str_replace('-',',',$launch_date);

        ?>
        /* <![CDATA[ */
        var JSParams = {
            "launch_date": "<?php echo $launch_date; ?>",
            "admin_ajax_url": "<?php echo home_url()  . '/wp-admin/admin-ajax.php'; ?>"
        };
        /* ]]> */
    </script>
    <script src="<?php echo $template_url; ?>assets/_js/functions.js" type="text/javascript"></script>

</body>

</html>