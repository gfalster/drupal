		<div class="colcont_top">
			<!--agl:cssobject id="top" type="Column Middle Scale" /-->
			<div class="colboxleft_top"></div>
			<div class="colboxright_top"></div>
			<div class="colboxmiddle_top"></div>
		</div>
		<div class="colcont_mid">
			<!--agl:cssobject id="mid" type="Column Middle Scale" /-->
			<div class="colboxleft_mid"></div>
			<div class="colboxright_mid"></div>
			<div class="colboxmiddle_mid">
				<div class="padbcont_quote">
					<!--agl:cssobject id="quote" type="Padded Box" /-->
					
					
    <?php if ($site_slogan): ?><div id="padbox_quote"><?php print $site_slogan; ?></div><?php endif; ?>
					
					
				</div>
				<div class="navboxcont_header">
					<!--agl:cssobject id="header" type="Left Fixed Box" /-->
					
					
    <?php if ($logo): ?>
	    <div id="logo" class="navboxleft_header">
	    	<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><img src="<?php print $logo; ?>"/></a>
	    </div>
    <?php endif; ?>
					
					
					
					<div class="navboxauto_header">
						<div class="navboxcont_searchbar">
							<!--agl:cssobject id="searchbar" type="Left Fixed Box" /-->
							<div class="navboxleft_searchbar"></div>
							<div class="navboxauto_searchbar">
								<form id="SUBMIT1" action="http://www.ttics.com/cgi-local/search_engine.cgi" method="get" name="SUBMIT1">
									<a href="index.html">Home</a> | <a href="techsupport.html">Technical Support</a> | <a href="events.html">Events</a> <input type="text" name="keywords" size="24" /><input type="submit" value="Search" title="SUBMIT1" id="SUBMIT1" />
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="padbcont_divider">
					<!--agl:cssobject id="divider" type="Padded Box" /-->
					<div class="padbox_divider">
						<img src="../../images/newtti_09.png" alt="" height="20" width="100%" border="0" /></div>
				</div>
				<div class="padbcont_menu">
				
				
				
	<?php
		/* Disable Main menu if unchecked */
		if ($main_menu == TRUE):
	?>
    <nav id="main-menu"  role="navigation">
      <a class="nav-toggle" href="#"><?php print t("Navigation"); ?></a>
      <div class="menu-navigation-container">
        <?php
        /*
        if (module_exists('i18n_menu')) {
			$main_menu_tree = i18n_menu_translated_tree(variable_get('menu_main_links_source', 'main-menu'));
        } else {
			$main_menu_tree = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
        }
			print drupal_render($main_menu_tree);
		*/
		?>
      </div>
      <div class="clear"></div>
    </nav>
	<?php endif;?><!-- end main-menu -->
	
	
	
				</div>
    <?php if ($is_front || theme_get_setting('slideshow_all')): ?>
      <?php if (theme_get_setting('slideshow_display')): ?>				
				<section id="slider">
				<div class="padbcont_flash">
					<!--agl:cssobject id="flash" type="Padded Box" /-->
					<div class="padbox_flash">
 <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="960" height="150">
        <param name="movie" value="ttics1.swf">
        <param name="quality" value="high">
        <embed src="ttics1.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="960" height="150"></embed>
</object>
				</div>
				</div>
				</section>
       <?php endif; ?>
    <?php endif; ?>
    
    				
				<div class="navboxcont_maincontent">
					<!--agl:cssobject id="maincontent" type="Left Fixed Box" /-->

				
    <?php if ($page['sidebar_first']): ?>
      <aside id="sidebar-first" role="complementary">
        <?php print render($page['sidebar_first']); ?>
      </aside>  <!-- /#sidebar-first -->
    <?php endif; ?>		
				
				
				
					<div class="navboxauto_maincontent">
						<div class="navrboxcont_newsandcolab">
							<!--agl:cssobject id="newsandcolab" type="Right Fixed Box" /-->
							<div class="navrboxright_newsandcolab">
	<?php
		/* Disable Main menu if unchecked */
		if ($secondary_menu == TRUE):
	?>
    <nav id="secondary-menu"  role="navigation">
      <a class="nav-toggle" href="#"><?php print t("Navigation"); ?></a>
      <div class="secondary-navigation-container">
        <?php
        /*
        if (module_exists('i18n_menu')) {
			$secondary_menu_tree = i18n_menu_translated_tree(variable_get('menu_secondary_links_source', 'secondary-menu'));
        } else {
			$secondary_menu_tree = menu_tree(variable_get('menu_secondary_links_source', 'secondary-menu'));
        }
			print drupal_render($secondary_menu_tree);
		*/
		?>
      </div>
      <div class="clear"></div>
    </nav>
	<?php endif;?><!-- end main-menu -->
	
							
								<p><br />
								</p>
								<hr align="right" width="97%" />
								<span class="titles">NEW<a href="customers.html">S</a></span><br />
								<hr align="right" width="97%" />
								<font size="-2"> <a href="http://stories.globalatlanta.com/2007stories/015393.html">Plans for African Center</a><br />
									&nbsp;in Fulton County</font>
								<hr align="right" width="97%" />
								<span class="titles"><a href="customers.html">&nbsp;CUSTOMERS</a></span><br />
								<hr align="right" width="97%" />
							</div>
							<div class="navrboxauto_newsandcolab">
								<br />
								<hr align="left" width="97%" />

								
    <div id="content">
      <?php if (theme_get_setting('breadcrumbs')): ?><div id="breadcrumbs"><?php if ($breadcrumb): print $breadcrumb; endif;?></div><?php endif; ?>
      <section id="post-content" role="main">
        <?php print $messages; ?>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?><h1 class="page-title"><?php print $title; ?></h1><?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php if (!empty($tabs['#primary'])): ?><div class="tabs-wrapper"><?php print render($tabs); ?></div><?php endif; ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
        <?php print render($page['content']); ?>
      </section> <!-- /#main -->
    </div>								
								
								
								
								
								
								<p><b></b></p>
								<b><i></i></b>
								<p><b></b></p>
								<p><b></b></p>
								<p><b></b></p>
								<ul>
									<b></b><b></b><b></b>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="padbcont_footer">
					<!--agl:cssobject id="footer" type="Padded Box" /-->
					<div class="padbox_footer"></div>

					
    <div id="copyright">
    <!--Remove  -->
    <?php if (!theme_get_setting('remove_copyright')){ ?>
    <?php if (!theme_get_setting('copyright_override')){?>
      <p class="copyright"><?php print t('Copyright'); ?> &copy; <?php echo date("Y"); ?>, <?php print check_plain(theme_get_setting('copywrite_holder')) ?></p>
    <?php } else {?>
       <?php echo check_plain(theme_get_setting('copyright_override'));?>
    <?php } ?>
    <?php } ?>
    <!--Remove Theme Credit by Setting -->
    <?php if (!theme_get_setting('display_theme_credit')): ?>
      <p class="credits"> <?php print t('Theme Originally Created by'); ?>  <a href="http://www.devsaran.com">Devsaran</a></p>
    <?php endif; ?>
    <div class="clear"></div>
    </div>					
					
					
					
		</div>
		<div class="colcont_bottom">
			<!--agl:cssobject id="bottom" type="Column Middle Scale" /-->
			<div class="colboxleft_bottom"></div>
			<div class="colboxright_bottom"></div>
			<div class="colboxmiddle_bottom"></div>
		</div>