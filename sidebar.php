<!-- 検索フォームエリア -->
<?php get_template_part( 'tmp/searcharea' ) ?>
<!-- 最新の記事エリア -->
<?php get_template_part ( 'tmp/latest-pages' ) ?>
<!-- アーカイブエリア -->
<div class="archive-block">
  <h3>過去のアーカイブ</h3>
  <ul class="yearly-archive">
    <?php wp_get_archives('type=yearly'); ?>
  </ul>
</div>