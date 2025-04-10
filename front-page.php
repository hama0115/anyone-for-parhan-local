<?php get_header(); ?>

    <main class="main">    
      <div class="container">
        <div class="archive-content">
          <div class="content-inner">
            <h1 class="page-title">最新の記事</h1>
            <div class="article-list-wrapper">
              <ul class="article-list">
                <?php //最新の投稿を取得するサブループ開始
                $args = array(
                  'post_type' => 'post',
                  'posts_per_page' => 6,
                );
                $new_query = new WP_Query($args);
                if($new_query->have_posts()): while($new_query->have_posts()): $new_query->the_post(); ?>    

                <li>
                  <a href="<?php the_permalink(); ?>" >
                  
                    <div class="thumbnail-area">
                      <?php //アイキャッチ画像があれば表示
                      if(has_post_thumbnail()):
                        the_post_thumbnail('full');

                      else: ?>
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets//img/sample-thumbnail.jpg" alt="ダミーのサムネイル">

                      <?php endif; ?>
                    </div>
                  
                    <div class="text">                      
                      <p class="article-title"><?php the_title(); ?></p>
                      <div class="information">
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
                      </div>
                    </div>
                  </a>
                </li>

                <?php endwhile;
                wp_reset_postdata();
                else: ?>
                  <p>投稿はありません。</p>
                <?php endif; ?>
              </ul>
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