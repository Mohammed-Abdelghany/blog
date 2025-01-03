<?php require_once 'inc/header.php';
require_once 'inc/connect.php';


?>
<!-- Page Content -->
<!-- Banner Starts Here -->

<div class="banner header-text">
  <div class="owl-banner owl-carousel">
    <div class="banner-item-01">
      <div class="text-content">
        <!-- <h4>Best Offer</h4> -->
        <!-- <h2>New Arrivals On Sale</h2> -->
      </div>
    </div>
    <div class="banner-item-02">
      <div class="text-content">
        <!-- <h4>Flash Deals</h4> -->
        <!-- <h2>Get your best products</h2> -->
      </div>
    </div>
    <div class="banner-item-03">
      <div class="text-content">
        <!-- <h4>Last Minute</h4> -->
        <!-- <h2>Grab last minute deals</h2> -->
      </div>

    </div>
  </div>
  <?php
  if (!empty($_SESSION['success']['edit_post'])) { ?>

  <div class="alert alert-success" style="height:50px; position: relative; top:20px; width:30% ;left:530px "
    role="alert">
    <p>
      <?php
        echo $_SESSION['success']['edit_post'];
        unset($_SESSION['success']['edit_post']);
        ?>
  </div><?php } ?>
</div>
<!-- Banner Ends Here -->

<div class="latest-products">
  <div class="container">
    <div class="row">

      <div class="col-md-12">
        <div class="section-heading">
          <h2>ALl Posts</h2>
        </div>
      </div>
      <?php
      if (isset($_GET['page'])) {
        $page = (int)$_GET['page'];
        if ($page < 1) {
          header("Location: index.php");
          exit();
        }
        $limit = 3;
      } else {
        $page = 1;
        $limit = 3;
      }
      $offset = ($page - 1) * $limit;

      $posts = [];
      $id_user =  $_SESSION['login']['id'];
      $sql = "SELECT title, `image`, id, createdat, SUBSTR(body, 1, 70) AS body 
      FROM posts 
      WHERE users_id = $id_user 
      LIMIT $limit OFFSET $offset";

      $numrows = "SELECT count(*) FROM posts where users_id = $id_user";
      $result = mysqli_query($conn, $sql);
      $total_pages = 1;
      if (mysqli_num_rows($result) > 0) {
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $numrows_result = mysqli_query($conn, $numrows);
        if (mysqli_num_rows($numrows_result) == 1) {
          $numrows = mysqli_fetch_assoc($numrows_result);
          $numrows = $numrows['count(*)'];

          $total_pages = ceil($numrows / $limit);

          if ($page > $total_pages) {
            header("Location: index.php");
            exit();
          }
          if (!empty($posts)) {
            foreach ($posts as $post): ?>
      <div class="col-md-4">
        <div class="product-item">
          <a href="viewPost.php?id=<?php echo $post['id'] ?>"><img src="uploads/<?php echo $post['image']; ?>" alt=""
              height="200"></a>
          <div class="down-content">
            <a href="viewPost.php?id=<?php echo $post['id'] ?>">
              <h4><?php echo $post['title']; ?></h4>
            </a>
            <h6><?php echo $post['createdat'];  ?></h6>
            <p> <?php echo $post['body'] . ".........more"; ?></p>

            <div class="d-flex justify-content-end">
              <a href="viewPost.php?id=<?php echo $post['id'] ?>" class="btn btn-info "> view</a>
            </div>

          </div>
        </div>
      </div>

      <?php


            endforeach;
          } else { ?>
      <h2 class="kk" style="position:relative; left:400px">No posts found</h2>
      <?php
          }
        }
      } else { ?>
      <h2 class="kk" style="position:relative; left:400px">No posts found</h2><?php
                                                                              }
                                                                                ?>


    </div>
  </div>
  <?php
  if (!empty($posts)) { ?>
  <nav class="Page navigation">
    <ul class="pagination" style="justify-content: center;">


      <li class="page-item"><a class="page-link" href="index.php?page=<?php
                                                                        if (isset($_GET['page'])) {
                                                                          $page = $_GET['page'];
                                                                          if ($page > 1) {
                                                                            $page = $page - 1;
                                                                          }
                                                                        } else {
                                                                          $page = 1;
                                                                        }


                                                                        echo $page

                                                                        ?>">Previous</a></li>
      <?php for ($i = 1; $i <= $total_pages; $i++) { ?>

      <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i ?>">
          <?php echo $i;
              ?>
        </a></li>
      <?php } ?>



      <li class="page-item"><a class="page-link" href="index.php?page=<?php

                                                                        if (isset($_GET['page'])) {
                                                                          $pages = (int)$_GET['page'];
                                                                          if ($pages > 0 && $pages < $total_pages) {
                                                                            $pages = $pages + 1;
                                                                          }
                                                                        } else {
                                                                          $pages = $total_pages;
                                                                        }

                                                                        echo $pages

                                                                        ?>">Next</a></li>
    </ul>
  </nav>
  <?php } ?>
</div>
</div>
</div>
</div>



<?php require_once 'inc/footer.php'; ?>