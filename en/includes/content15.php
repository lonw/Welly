<div class="col-md-12">
  <section class="main-content">
    <?php

    $query = mysql_query("SELECT * FROM pageabout where lang = 1");
      $data = mysql_fetch_array($query);

      echo $data['deskripsi'];
    ?>
        </section>

</div>
