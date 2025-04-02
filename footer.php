<footer class="footer">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo"><?php bloginfo('name'); ?></a>

      <?php get_sidebar(); ?>

      <p class="copyright"><?php echo $_SERVER['HTTP_HOST']; ?> all right reserved.</p>
    </footer>

    <?php wp_footer(); ?>

    <!-- JavaScript -->

      <!-- fontawesome(をいちおういれておく) -->
      <script src="https://kit.fontawesome.com/9ab3ae9094.js" crossorigin="anonymous"></script>

    <!--#JS-->
  </body>
</html>