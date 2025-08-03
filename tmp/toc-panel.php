<div id="toc-panel" class="toc-panel">
  <div class="thumbnail-area">
    <?php if(has_post_thumbnail()): ?>
      <?php the_post_thumbnail('full'); ?>
    <?php else: ?>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/sample-thumbnail.JPG" alt="ダミーのサムネイル">
    <?php endif; ?>
  </div>
  <div class="toc-panel-header">
    <p class="header-title">目次</p>
    <button id="toc-close">
      <i class="fa-solid fa-xmark">(目次を閉じる)</i>
    </button>
  </div>
  <div class="toc-panel-content">
    <!-- LuckyWPの目次をここに複製して表示 -->
    <div id="lwptoc-panel"></div>
  </div>
</div>