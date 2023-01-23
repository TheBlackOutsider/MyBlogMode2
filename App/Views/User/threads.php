
  
<?php 
require_once "../App/Views/User/includes/header.php";
?>


<?php if ($_GET["param"] != null ):?>

  <main class="thread_container" >


    <!-- section of retrieve and display all tutos selected from the database -->
    <section>
      <h2>Advices & Cool tips</h2>
      <div class="list_threads grid-box" >
        
        <!-- display each thread which is set as "posted" and -->
        <?php foreach ($threads as $item => $thread) :?>
          <script>
            document.title = "";
          </script>
          <article class="content_box ">
            <h3> <?= htmlspecialchars($thread['title']) ?> </h3>
            <figure class="thread_caption">
              <img src="/ressources/assets/admin_media/files_image/ $thread->image" alt="illustration of thread $thread->title">
              <figcaption>
                <p><?= htmlspecialchars($thread['describ']) ?></p>
              </figcaption>
            </figure>
            <a href="/thread/view">Check more 
            <span >↣</span>
            </a>
          </article>
        <?php endforeach; ?> 
      </div>

    </section>

    <!-- section of retrieve and display all tutos selected from the database -->
    <section>
    <h2>Tutorials</h2>
      <div class="list_tutorials grid-box" >
        
        <!-- display each tutos which is set as "posted" and -->
        <?php foreach ($tutorials as $item => $tuto) :?>
          <article class="content_box ">
            <h3> <?= htmlspecialchars($tuto['title']) ?> </h3>
            <figure class="tuto_caption">
              <img src="/ressources/assets/admin_media/files_image/$tuto['image']" alt="illustration of thread $thread->title">
              <figcaption>
                <p><?= htmlspecialchars($tuto['describ']) ?></p>
              </figcaption>
            </figure>
            <a href="/thread/view">Check more 
              <span >↣</span>
            </a>
          </article>
        <?php endforeach; ?> 

      </div>

    </section>





  </main>
 
<?php else: ?>

<?php
 require_once "/viewer.php"
?>
 
<?php endif;?>

<?php
 require_once "/footer.php"
?>


</body>
</html>