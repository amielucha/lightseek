<?php
/*
 * Opening and closing of the default template wrapping tags.
 * IMPORTANT: make sure the closing tags match the opening tags.
 */
function lightseek_template_wrapper_start(){
  ?>
    <div id="primary" class="content-area">
      <main id="main" class="site-main container" role="main">
        <div class="container">
  <?php
}

function lightseek_template_wrapper_end(){
  ?>
        </div><!-- .container -->
      </main><!-- .site-main -->
    </div><!-- .content-area -->
  <?php
}
