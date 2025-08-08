<div id="toc-panel" class="toc-panel">
  <!-- パーキング情報の一覧マップ -->
  <?php get_template_part( 'tmp/parking-map' ) ?>

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