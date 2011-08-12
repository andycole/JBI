<?php /* Smarty version 2.6.25, created on 2009-11-12 00:36:49
         compiled from tpl_body:22 */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'anchor', 'tpl_body:22', 7, false),array('function', 'cms_selflink', 'tpl_body:22', 18, false),array('function', 'search', 'tpl_body:22', 23, false),array('function', 'news', 'tpl_body:22', 65, false),array('function', 'title', 'tpl_body:22', 84, false),array('function', 'content', 'tpl_body:22', 85, false),array('function', 'menu', 'tpl_body:22', 124, false),array('function', 'global_content', 'tpl_body:22', 134, false),)), $this); ?>
<?php $this->_cache_serials['/homepages/30/d170410374/htdocs/justbuyit/tmp/templates_c/%%76^763^76313DB0%%tpl_body%3A22.inc'] = '0d2d80ac755bd9f6927533a00581a3a4'; ?>
  <body>
    <div id="ncleanblue">
      <div id="pagewrapper" class="core-wrap-960 core-center">
        <ul class="accessibility">
          <li><?php if ($this->caching && !$this->_cache_including): echo '{nocache:0d2d80ac755bd9f6927533a00581a3a4#0}'; endif;echo smarty_cms_function_anchor(array('anchor' => 'menu_vert','title' => 'Skip to navigation','accesskey' => 'n','text' => 'Skip to navigation'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0d2d80ac755bd9f6927533a00581a3a4#0}'; endif;?>
</li>
          <li><?php if ($this->caching && !$this->_cache_including): echo '{nocache:0d2d80ac755bd9f6927533a00581a3a4#1}'; endif;echo smarty_cms_function_anchor(array('anchor' => 'main','title' => 'Skip to content','accesskey' => 's','text' => 'Skip to content'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0d2d80ac755bd9f6927533a00581a3a4#1}'; endif;?>
</li>
        </ul>
        <hr class="accessibility" />

        <div id="header" class="util-clearfix">
          <div id="logo" class="core-float-left">
            <?php if ($this->caching && !$this->_cache_including): echo '{nocache:0d2d80ac755bd9f6927533a00581a3a4#2}'; endif;echo smarty_cms_function_cms_selflink(array('dir' => 'start','text' => ($this->_tpl_vars['sitename'])), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0d2d80ac755bd9f6927533a00581a3a4#2}'; endif;?>

          </div>
          
          <div id="search" class="core-float-right">
            <?php if ($this->caching && !$this->_cache_including): echo '{nocache:0d2d80ac755bd9f6927533a00581a3a4#3}'; endif;echo smarty_cms_function_search(array('search_method' => 'post'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0d2d80ac755bd9f6927533a00581a3a4#3}'; endif;?>

          </div>
          <span class="util-clearb">&nbsp;</span>
          

        </div>

        <div id="content" class="util-clearfix">


          <div id="bar" class="util-clearfix">

            <hr class="accessibility util-clearb" />
          </div>

          <div id="left" class="core-float-left">
            <div class="sbar-top">
              <h2 class="sbar-title">News</h2>
            </div>
            <div class="sbar-main">
              <div id="news">
              <?php if ($this->caching && !$this->_cache_including): echo '{nocache:0d2d80ac755bd9f6927533a00581a3a4#4}'; endif;echo smarty_cms_function_news(array('number' => '3','detailpage' => 'news'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0d2d80ac755bd9f6927533a00581a3a4#4}'; endif;?>

              </div>
 
            </div>
            <span class="sbar-bottom">&nbsp;</span> 
          </div>

          <div id="main"  class="core-float-right">

            <div class="main-top">
              <div class="print core-float-right">
              </div>
            </div> 
            
            <div class="main-main util-clearfix">
              <h1 class="title"><?php if ($this->caching && !$this->_cache_including): echo '{nocache:0d2d80ac755bd9f6927533a00581a3a4#5}'; endif;echo smarty_cms_function_title(array(), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0d2d80ac755bd9f6927533a00581a3a4#5}'; endif;?>
</h1>
            <?php if ($this->caching && !$this->_cache_including): echo '{nocache:0d2d80ac755bd9f6927533a00581a3a4#6}'; endif;echo smarty_cms_function_content(array(), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0d2d80ac755bd9f6927533a00581a3a4#6}'; endif;?>


            </div>
            
            <div class="main-bottom">
              <div class="right49 core-float-right">
              <?php if ($this->caching && !$this->_cache_including): echo '{nocache:0d2d80ac755bd9f6927533a00581a3a4#7}'; endif;echo smarty_cms_function_anchor(array('anchor' => 'main','text' => '^&nbsp;&nbsp;Top'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0d2d80ac755bd9f6927533a00581a3a4#7}'; endif;?>

              </div>
              <div class="left49 core-float-left">
                <span>
                  <?php if ($this->caching && !$this->_cache_including): echo '{nocache:0d2d80ac755bd9f6927533a00581a3a4#8}'; endif;echo smarty_cms_function_cms_selflink(array('dir' => 'previous','label' => "Previous page: "), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0d2d80ac755bd9f6927533a00581a3a4#8}'; endif;?>
&nbsp;
                </span>
                <span>
                  <?php if ($this->caching && !$this->_cache_including): echo '{nocache:0d2d80ac755bd9f6927533a00581a3a4#9}'; endif;echo smarty_cms_function_cms_selflink(array('dir' => 'next'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0d2d80ac755bd9f6927533a00581a3a4#9}'; endif;?>
&nbsp;
                </span>
              </div>

              <hr class="accessibility" />
            </div>

          </div>

        </div>

      </div>
      <span class="util-clearb">&nbsp;</span>
      
      <div id="footer-wrapper">
        <div id="footer" class="core-wrap-960">
          <div class="block core-float-left">
            <?php if ($this->caching && !$this->_cache_including): echo '{nocache:0d2d80ac755bd9f6927533a00581a3a4#10}'; endif;echo smarty_cms_function_menu(array('template' => 'minimal_menu.tpl','number_of_levels' => '1'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0d2d80ac755bd9f6927533a00581a3a4#10}'; endif;?>

          </div>
          
          <div class="block core-float-left">
            <?php if ($this->caching && !$this->_cache_including): echo '{nocache:0d2d80ac755bd9f6927533a00581a3a4#11}'; endif;echo smarty_cms_function_menu(array('template' => 'minimal_menu.tpl','start_level' => '2'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0d2d80ac755bd9f6927533a00581a3a4#11}'; endif;?>

          </div>
          
          <div class="block cms core-float-left">
            <?php if ($this->caching && !$this->_cache_including): echo '{nocache:0d2d80ac755bd9f6927533a00581a3a4#12}'; endif;echo smarty_cms_function_global_content(array('name' => 'footer'), $this);if ($this->caching && !$this->_cache_including): echo '{/nocache:0d2d80ac755bd9f6927533a00581a3a4#12}'; endif;?>

          </div>
          
          <span class="util-clearb">&nbsp;</span>
        </div>
      </div>
    </div>
  </body>
</html>