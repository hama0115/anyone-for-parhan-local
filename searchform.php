<!-- 「wordpressデザインレシピ集」を参考 -->
<form id="searchform" method="GET" action="/" class="form-inline kp-header-searchinput" role="search">
  <div class="input-group">
    <label for="searchword">サイト内検索</label><!-- CSSで非表示 -->
    <input type="text" name="s" class="form-control" id="searchword" placeholder="記事を検索" value="<?php echo get_search_query(); ?>">
    <div class="input-group-append">
      <button class="btn btn-info" type="submit">
        <i class="fas fa-search"></i><span>検索</span>
      </button>
    </div>
  </div>
</form>