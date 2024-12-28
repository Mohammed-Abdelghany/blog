<?php require_once 'inc/header.php';
require_once 'inc/connect.php';

if (isset(($_GET['id']))) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM posts WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) == 1) {
    $post = mysqli_fetch_assoc($result);
  } else {
    header('location:errors.php');
  }
} else {
  header('location:errors.php');
}



?>

<!-- Page Content -->
<div class="page-heading products-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-content">
          <h4>View Post</h4>
          <h2> View personal post</h2>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="best-features about-features">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-heading">
          <h2>
            <?php

            echo $post['title']; ?>
          </h2>

          </h2>

          </h2>
        </div>
      </div>
      <div class="col-md-6">
        <div class="right-image">
          <img src="uploads/<?php echo $post['image']; ?>" alt="">

        </div>
      </div>
      <div class="col-md-6">
        <div class="left-content">
          <div class="container">
            <h4> <?php echo $post['title']; ?> </h4>
            <h6><?php echo $post['createdat'];  ?></h6>

          </div>

          <p> <?php echo $post['body']; ?>.</p>

          <div class="d-flex justify-content-center">
            <a href="editPost.php?id=<?php echo $post['id']; ?>" class="btn btn-success mr-3 "> edit post</a>

            <a href="deletePost.php?id=<?php echo $post['id']; ?>" class=" btn btn-danger mr-0 "> delete post</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'inc/footer.php' ?>