<?php get_header(); ?>

  <main class="main">
    <div class="container">       
      <div class="main-content">
        <div class="content-inner">
          <?php if( have_posts() ): while( have_posts() ) : the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
            <div class="title-area">
              <h1 class="article-title"><?php the_title(); ?></h1>
              <time class="entry-date"><?php echo get_the_date(); ?></time>
              <?php /* カテゴリーをリンクなしで表示 */
              $cats = get_the_category();
              if($cats):
              ?>
                <ul class="category-list">
                <?php foreach($cats as $cat): ?>
                  <li class="article-category"><?php echo $cat->name; ?></li>
                <?php endforeach; ?>
                </ul>
              <?php endif; ?>
              <?php get_template_part( 'tmp/breadcrumb' ); ?>
            </div>
            <!-- スライドショー -->
            <?php get_template_part( 'tmp/slideshow' ) ?>
            <div class="article-content">
              <!-- googlemapマーカー地図 -->
              <?php
              $markers = get_field('googlemap-markers'); //ACFからデータ取得
              ?>
              <div id="map" style="width:100%;height:400px"></div>
              <?php if ($markers): //jsonエンコードしてjsに渡す ?>
                <script>
                  console.log('PHP ACF Data:', <?php echo json_encode($markers, JSON_UNESCAPED_UNICODE); ?>);
                  window.mapSpots = <?php echo json_encode($markers, JSON_UNESCAPED_UNICODE); ?>;
                </script>
              <?php else: ?>
                <script>
                  console.log('No ACF spots data found');
                  window.mapSpots = [];
                </script>
              <?php endif; ?>

              <?php the_content(); ?>
            </div>
            <div class="page-link"><!-- 前後の記事がある場合はリンクを表示 -->
              <?php
              $previous_post = get_previous_post();
              if( $previous_post ):
              ?>
                <a class="prev-page-link" href="<?php the_permalink($previous_post); ?>">前の記事へ</a>
              <?php endif; ?>

              <?php
              $next_post = get_next_post();
              if( $next_post ):
              ?>
                <a class="next-page-link" href="<?php the_permalink($next_post); ?>">次の記事へ</a>
              <?php endif; ?>
            </div>
          </article>
          <?php endwhile; else: ?>
          <?php endif; ?>

          <!-- 目次パネルの開閉ボタン -->
          <button id="toc-toggle-button" class="toc-fixed-button">目次を見る</button>
        </div>
      </div>
      <aside class="sidebar">
        <div class="sidebar-inner">
          <?php get_sidebar(); ?>
        </div>
      </aside>      
    </div>
  </main>
    
<?php get_footer(); ?>