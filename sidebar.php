<!-- 検索フォームエリア -->
<div class="search-block">
  <h3>記事を検索</h3>
  <?php get_search_form(); ?>
</div>
<!-- アーカイブエリア -->
<div class="archive-block">
  <h3>過去のアーカイブ</h3>
  <ul class="yearly-archive">
    <?php wp_get_archives('type=yearly'); ?>
  </ul>
</div>