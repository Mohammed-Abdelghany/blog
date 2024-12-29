<?php require_once 'inc/header.php';
require_once 'inc/connect.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = trim(htmlspecialchars($_POST['title']));
    $body = trim(htmlspecialchars($_POST['body']));
    if (empty($title) || empty($body)) {
      $_SESSION['error']['fields'] = 'Title and body cannot be empty.';
      header("location:edit_post.php?id=$id");
      exit();
    }

    $sql_old = "select image from posts where id=$id";
    $query_old = mysqli_query($conn, $sql_old);
    if (mysqli_num_rows($query_old) == 1) {
      $result_old = mysqli_fetch_assoc($query_old);
      $old_image = $result_old['image'];
      if (file_exists('uploads/' . $old_image)) {
        unlink('uploads/' . $old_image);
      } //checkimage exists and remove it
    } //numrows for old image

    if (isset($_FILES['image'])) {
      $imageName = $_FILES['image']['name'];
      $imageError = $_FILES['image']['error'];
      $file_size = $_FILES['image']['size'];
      $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
      $image_ext = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

      if (in_array($image_ext, $allowed_extensions) && $imageError == 0) {
        $new_name = uniqid() . "." . $image_ext;
        if (move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $new_name)) {

          $sql = "UPDATE posts SET title='$title', body='$body', image='$new_name' WHERE id=$id.";
          $query = mysqli_query($conn, $sql);
          if ($query) {
            $_SESSION['success']['edit_post'] = 'post updated successfully';
            header('location:index.php');
            exit();
          }
        } else {
          $_SESSION['error']['image_update'] = ['please check your image and try again'];
        } //uploades


      } //in array

    } 
    //if (isset($file)_)


  } //request
} else {
  header('location:index.php');
  exit();
}
//get 

?>
<!-- Page Content -->
<div class="page-heading products-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-content">
          <h4>Edit Post</h4>
          <h2>edit your personal post</h2>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container w-50 ">
  <div class="d-flex justify-content-center">
    <h3 class="my-5">edit Post</h3>
  </div>

  <form method="POST" action="editPost.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="">
    </div>
    <div class="mb-3">
      <label for="body" class="form-label">Body</label>
      <textarea class="form-control" id="body" name="body" rows="5"></textarea>
    </div>
    <div class="mb-3">
      <label for="body" class="form-label">image</label>
      <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <!-- <img src="uploads/<?php echo $post['image'] ?>" alt="" width="100px" srcset=""> -->
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </form>
</div>


<?php require_once 'inc/footer.php' ?>