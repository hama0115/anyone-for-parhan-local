<?php get_header(); ?>

    <main class="main">    
      <div class="container">
        <div class="main-content">
          <div class="content-inner">
            <?php the_archive_title( '<h1 class="page-title">', '</h1>'); ?>
            <div class="article-list-wrapper">
              <ul class="article-list">
                <?php //メインループ開始
                if( have_posts() ): while( have_posts() ): the_post(); ?>
                <li>
                  <a href="<?php the_permalink(); ?>" >
            
                  <div class="thumbnail-area">
                    <?php
                    if(has_post_thumbnail()):
                      the_post_thumbnail('full');
                    else: ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/sample-thumbnail.JPG" alt="ダミーのサムネイル">
                    <?php endif; ?>
                  </div>
            
                    <div class="text">
                      <time class="entry-date"><?php echo get_the_date(); ?></time>
                      <p class="article-title"><?php the_title(); ?></p>
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
                    </div>
                  </a>
                </li>
                <?php endwhile; else: ?>
                <?php endif; ?>
              </ul>
              <?php //ページネーション
              $args = array(
                'mid_size' => 1, //初期値と同じ
                'prev_text' => '←',
                'next_text' => '→'
              );
              the_posts_pagination($args);
              ?>
            </div>
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