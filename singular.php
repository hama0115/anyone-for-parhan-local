<?php get_header(); ?>

    <main class="main">    
      <div class="content-wrapper">
        <div class="content">

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
          
          <section class="latest-pages">
            <h2 class="latest-pages-title">最新の記事</h2>
            <?php
            if ( is_singular() ) {
              $postid = get_the_ID();
              $authorid = get_the_author_meta( 'ID' );

              $args = [
                'posts_per_page' => 5,
                'author' => $authorid,
                'orderby' => 'date',
                'exclude' => $postid,
              ];

              $myposts = get_posts( $args );
              
              if ( $myposts ) :
                echo '<ul>';
                foreach ( $myposts as $post ) :
                  setup_postdata( $post ) ?>
                  <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </li>
                <?php endforeach;
                wp_reset_postdata();
                echo '</ul>';
              else :
                echo '記事はありません。';
              endif ;
            }?>
          </section>
        </div>
      </div>
    </main>
    
<?php get_footer(); ?>