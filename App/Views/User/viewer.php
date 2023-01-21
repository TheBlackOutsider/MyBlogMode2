
<?php
 require_once "../App/Views/User/includes/header.php";
 ?>

  <main class="viewer_container">

    <section id="container">

      <h2><?= htmlspecialchars($post['title']) ?></h2>
      <iframe src="/ressources/assets/admin_media/files_video/ $post['resume']" frameborder="0">
          <img src="/ressources/assets/admin_media/files_image/ $post['image']" alt="illustration of thread $post['title']">
      </iframe>

      <div class="tuto_describ">

        <?php $txt = explode( '#-#', $post['describ']); foreach ($txt as $k => $v) :?>
          <p><?= htmlspecialchars($post['describ']) ?></p>
        <?php endforeach; ?> 

      </div>

    </section>

  </main>

<?php
 require_once "../App/Views/User/includes/footer.php";
?>


</body>
</html>