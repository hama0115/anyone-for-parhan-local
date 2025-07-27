<section class="comments">
  <?php
  $comment_form_args = [
    'title_reply' => '口コミを投稿する',
    'label_submit' => '送信する',
    'comment_field' => '<p class="comment-form-comment"><label for="comment">口コミ<span class="required">※</span></label> <textarea id="comment" name="comment" required="required"></textarea></p>',
  ];
  comment_form($comment_form_args);
  if ( have_comments() ):
  ?>
    <ol class="commentlist">
      <?php wp_list_comments(); ?>
    </ol>
    <?php
    $paginate_comments_links_args = [
      'prev_text' => '前のページ',
      'next_text' => '次のページ',
    ];
    paginate_comments_links($paginate_comments_links_args);
  endif;
  ?>
</section>