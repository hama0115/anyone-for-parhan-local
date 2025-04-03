<!-- 検索フォームエリア -->
<div class="search-block">
  <?php get_search_form(); ?>
</div>
<!-- 最新の記事エリア -->
<section class="latest-pages">
  <h3>最新の記事</h3>
  <?php
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
  ?>
</section>
<!-- アーカイブエリア -->
<div class="archive-block">
  <h3>過去のアーカイブ</h3>
  <ul class="yearly-archive">
    <?php wp_get_archives('type=yearly'); ?>
  </ul>
</div>