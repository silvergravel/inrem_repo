<?php
/**
 * DokuWiki Bootstrap3 Template: Navbar
 *
 * @link     http://dokuwiki.org/template:bootstrap3
 * @author   Giuseppe Di Terlizzi <giuseppe.diterlizzi@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

 //fetching global definition of namespace names-----------------------------------------//

 $cwd = getcwd();
 include $cwd.'/var_config.php';

 //--------------------------------------------------------------------------------------//


//--------------------//change_wiki_language_addon-------------------//
 $compatible_languages = array($english,$hindi);

 $directoryURI = $_SERVER['REQUEST_URI'];
 $components = explode('=', $directoryURI);
 $first_part = $components[1];
 $current_language_code = substr($first_part, 0, 2);
 if($current_language_code == "en"){
   $current_language = $english;
 } else if ($current_language_code == "hi"){
   $current_language = $hindi;
 };
 if (!in_array($current_language, $compatible_languages)) {
    $current_language = $english;
}
//-------------------------------------------------------------------//

// must be run from within DokuWiki
if (!defined('DOKU_INC')) die();

global $lang;

$navbar_labels    = bootstrap3_conf('navbarLabels');
$navbar_classes   = array();
$navbar_classes[] = (bootstrap3_conf('fixedTopNavbar') ? 'navbar-fixed-top' : null);
$navbar_classes[] = (bootstrap3_conf('inverseNavbar')  ? 'navbar-inverse'   : 'navbar-default');

//--------------------//change_wiki_language_addon-------------------//

//hyperlink the homelink to a particular language homepage, depending on current language selection

$home_link        = "/".$root_folder."/doku.php?id=".$current_language.":start"; //change_wiki_language_addon

//-------------------------------------------------------------------//

//$home_link        = (bootstrap3_conf('homePageURL') ? bootstrap3_conf('homePageURL') : wl()); //original line in this theme

?>
<nav id="dw__navbar" class="navbar <?php echo trim(implode(' ', $navbar_classes)) ?>" role="navigation">

  <div class="container<?php echo (bootstrap3_is_fluid_navbar() ? '-fluid' : '') ?>">

    <div class="navbar-header">

      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <?php

        // get logo either out of the template images folder or data/media folder
        $logoSize  = array();
        $logo      = tpl_getMediaFile(array(':wiki:logo.png', ':logo.png', 'images/logo.png'), false, $logoSize);
        $title     = $conf['title'];
        $tagline   = ($conf['tagline']) ? '<span id="dw__tagline">'.$conf['tagline'].'</span>' : '';
        $logo_size = 'height="20"';

        if ($tagline) {
          $logo_size = 'height="32" style="margin-top:-5px"';
        }

        // display logo and wiki title in a link to the home page
        tpl_link(
            $home_link,
            '<img src="'.$logo.'" alt="'.$title.'" class="pull-left'.(($tagline) ? ' dw-logo-tagline' : '').'" id="dw__logo" '.$logo_size.' /> <span id="dw__title" '.($tagline ? 'style="margin-top:-5px"': '').'>'. $title . $tagline .'</span>',
            'accesskey="h" title="[H]" class="navbar-brand"'
        );

      ?>

    </div>

    <div class="collapse navbar-collapse">

      <?php if (bootstrap3_conf('showHomePageLink')) :?>
      <ul class="nav navbar-nav">
        <li<?php echo ((wl($ID) == $home_link) ? ' class="active"' : ''); ?>>
          <?php tpl_link($home_link, '<i class="fa fa-fw fa-home"></i> Home') ?>
        </li>
      </ul>
      <?php endif; ?>

      <?php echo bootstrap3_navbar() // Include the navbar for different namespaces ?>
      <?php echo bootstrap3_dropdown_page('dropdownpage') ?>

      <?php if(file_exists(dirname(__FILE__) . '/navbar.html') && bootstrap3_conf('useLegacyNavbar')): ?>
      <ul class="nav navbar-nav">
        <?php tpl_includeFile('navbar.html') ?>
      </ul>
      <?php endif; ?>

      <div class="navbar-right" id="dw__navbar_items">

        <?php bootstrap3_searchform() ?>

        <?php
          // Admin Menu
          include_once(dirname(__FILE__).'/tpl_admin.php');

          // Tools Menu
          include_once(dirname(__FILE__).'/tpl_tools_menu.php');

          // Theme Switcher Menu
          include_once(dirname(__FILE__).'/tpl_theme_switcher.php');

          // Translation Menu
          include_once(dirname(__FILE__).'/tpl_translation.php');

          // Add New Page
          include_once(dirname(__FILE__).'/tpl_new_page.php');
        ?>

        <ul class="nav navbar-nav">

          <?php if (bootstrap3_conf('showEditBtn')): ?>
          <li class="dw-action-icon hidden-xs">
            <?php tpl_actionlink('edit', '<span class="sr-only">', '</span>'); ?>
          </li>
          <?php endif; ?>

          <?php if (bootstrap3_conf('fluidContainerBtn')): ?>
          <li class="hidden-xs <?php echo (bootstrap3_fluid_container_button() ? 'active' : '')?>">
            <a href="#" class="btn-fluid-container" title="<?php echo tpl_getLang('expand_container') ?>"><i class="fa fa-fw fa-arrows-alt"></i><span class="<?php echo (in_array('expand', bootstrap3_conf('navbarLabels')) ? '' : 'hidden-lg hidden-md hidden-sm') ?>"> <?php echo tpl_getLang('expand_container') ?></span></a>
          </li>
          <?php endif; ?>

          <?php if (empty($_SERVER['REMOTE_USER'])): ?>
          <li>
            <span class="dw__actions dw-action-icon">
              <?php

                $register_label = sprintf('<span class="%s">%s</span>', (in_array('register', $navbar_labels) ? null : 'sr-only'), $lang['btn_register']);
                $login_label    = sprintf('<span class="%s">%s</span>', (in_array('login', $navbar_labels) ? null : 'sr-only'), $lang['btn_login']);

                $register_btn = tpl_actionlink('register', null, null, $register_label, true);
                $register_btn = str_replace('action', 'action btn btn-success navbar-btn', $register_btn);
                echo $register_btn;

                if (! bootstrap3_conf('hideLoginLink')) {
                  $login_btn = tpl_actionlink('login', null, null, $login_label, true);
                  $login_btn = str_replace('action', 'action btn btn-default navbar-btn', $login_btn);
                  echo $login_btn;
                }

              ?>
            </span>
          </li>
          <?php endif; ?>

        </ul>

        <?php if (bootstrap3_conf('tocLayout') == 'navbar'): ?>
        <ul class="nav navbar-nav hide" id="dw__toc_menu">
          <li class="dropdown">
            <a href="<?php wl($ID) ?>" class="dropdown-toggle" data-target="#" data-toggle="dropdown" title="<?php echo $lang['toc'] ?>" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-fw fa-th-list"></i> <span class="hidden-lg hidden-md hidden-sm"><?php echo $lang['toc'] ?></span><span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu" style="max-height: 400px; overflow-y: auto">
              <li class="dropdown-header"><i class="fa fa-fw fa-th-list"></i> <?php echo $lang['toc'] ?></li>
            </ul>
          </li>
        </ul>
        <?php endif; ?>

        <?php include_once(dirname(__FILE__).'/tpl_user_menu.php'); ?>



      </div>

    </div>
    <!-- <div style="float:left;"> -->
      <?php
      //@include(dirname(__FILE__).'/show_languages.html')
      ?>
    <!-- </div> -->

    <div style="float:left;"><?php  @include(dirname(__FILE__).'/change_wiki_language.php')?></div>

    <div class="dropdown" style="float:right;">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">+ Contribute Content</button>
      <ul class="dropdown-menu">
        <li><a href="<?php echo "/".$root_folder."/doku.php?id=for_admin:contribute_content_files:how_to_form" ?>">how to...</a></li>
        <li><a href="<?php echo "/".$root_folder."/doku.php?id=for_admin:contribute_content_files:stories_form" ?>">stories from the ground</a></li>
      </ul>
    </div>

  </div>
</nav>
