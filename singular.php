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
            <?php if(has_post_thumbnail()): ?>
              <div class="eyecatch-area"><?php the_post_thumbnail(); ?></div>
            <?php endif; ?>
            <!-- スライドショー -->
            <?php get_template_part( 'tmp/slideshow' ) ?>
            <div class="article-content">
              <?php the_content(); ?>
            </div>
            <div class="page-link"><!-- 前後の記事がある場合はリンクを表示 -->
              <?php if( get_previous_post() ): ?>
                <p class="prev-page-link"><?php previous_post_link('%link', '%title'); //関数デフォルトの記号を非表示 ?></p>
              <?php endif; ?>
              <?php if( get_next_post() ): ?>
                <p class="next-page-link"><?php next_post_link('%link', '%title'); //関数デフォルトの記号を非表示 ?></p>
              <?php endif; ?>
            </div>
          </article>
          <?php endwhile; else: ?>
          <?php endif; ?>
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