<!-- リンク集エリア -->
<?php get_template_part ( 'tmp/post-it' ) ?>
<!-- アーカイブエリア -->
<?php get_template_part ( 'tmp/archive-area' ) ?>
<!-- 目次エリア(「LuckyWP Table of Contents」使用) -->
<?php
 if ( function_exists('lwptoc') ) {
  echo lwptoc();
 }
?>