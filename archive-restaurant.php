<?php get_header(); ?>

    <main class="main">    
      <div class="container">
        <div class="archive-content">
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
                      <p class="article-title"><?php the_title(); ?></p>
                      <div class="excerpt"><?php the_excerpt(); ?></div>
                      <div class="information">
                        <time class="entry-date"><?php echo get_the_date(); ?></time>

                        <!-- タクソノミー「ジャンル」を取得、表示 -->
                        <?php
                        $terms = get_the_terms( get_the_ID(), 'genre');
                        if ( $terms && !is_wp_error ( $terms ) ) {
                          echo '<ul class="category-list">';
                          foreach ( $terms as $term ) {
                            echo '<li class="article-category">' . esc_html ($term->name)  . '</li>';
                          }
                          echo '</ul>';
                        } else {
                          echo '<p>ジャンル未設定</p>';
                        }
                        ?>
                      </div>
                    </div>
                  </a>
                </li>
                <?php endwhile; else: ?>
                <?php endif; ?>
              </ul>
              <!-- プラグイン「wp-paginavi」 -->
              <?php if(function_exists('wp_pagenavi')): ?>
                <div class="pagination">
                  <?php wp_pagenavi(); ?>
                </div>
              <?php endif; ?>
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