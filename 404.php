<?php get_header(); ?>

    <main class="main">    
      <div class="container">
        <div class="archive-content">
          <div class="content-inner">
            <h1 class="page-title">404 NOT FOUND</h1>
            <div class="article-content content404">
              <p>お探しのページが見つかりませんでした。</p>
              <p>申し訳ございませんが、<a href="<?php echo home_url('/'); ?>">こちらのリンク</a>からトップページにお戻りください。</p>
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