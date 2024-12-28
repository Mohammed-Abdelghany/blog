<?php
require_once 'inc/header.php';
require_once 'inc/connect.php';
if (isset($_SESSION['login']['id'])) {
  $id = $_SESSION['login']['id'];



  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    if (empty($title) || empty($body)) {
      $_SESSION['errors']['form'] = "All fields are required";
    } else {
      // التأكد من أن الصورة تم رفعها بشكل صحيح
      if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // الحصول على اسم الصورة وامتدادها
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // التأكد من أن نوع الملف مسموح به
        if (in_array($file_ext, $allowed_extensions)) {
          // إنشاء اسم فريد للصورة
          $new_file_name = uniqid() . '.' . $file_ext;
          $target_dir = 'uploads/'; // مسار المجلد المخصص لحفظ الصور
          $target_file = $target_dir . $new_file_name;

          if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // تعيين المتغيرات المطلوبة من النموذج

            $sql = "INSERT INTO posts ( title, body,`image`,users_id) VALUES ('$title', '$body', '$new_file_name', '$id')";
            if (mysqli_query($conn, $sql)) {
              // إعادة التوجيه بعد النجاح
              header('Location: index.php');
              exit();
            } else {
              echo 'Error: ' . mysqli_error($conn);
            }
          } else {
            $_SESSION['errors']['image'] = "Failed to move the uploaded file.";
          }
        } else {
          $_SESSION['errors']['image'] = "File type is not allowed. Allowed types: jpg, jpeg, png, gif.";
        }
      } else {
        $_SESSION['errors']['image'] = "image is required.";
      }
    }
  }
} else {
  header('Location: Login.php');
  exit();
}
?>

<!-- Page Content -->
<div class="page-heading products-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="text-content">
          <h4>new Post</h4>
          <h2>add new personal post</h2>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container w-50 ">
  <div class="d-flex justify-content-center">
    <h3 class="my-5">add new Post</h3>
  </div>
  <form method="POST" action="addPost.php" enctype="multipart/form-data">
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
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    <?php
    if (isset($_SESSION['errors']['form'])) { ?>

    <div class="alert alert-danger" style="height:90px; margin-top:5px; " role="alert">
      <p>
        <?php
          echo $_SESSION['errors']['form'];
          unset($_SESSION['errors']['form']);

          ?>
      </p>
      <?php
    } elseif (isset($_SESSION['errors']['image'])) { ?>

      <div class="alert alert-danger" style="height:90px; margin-top:5px; " role="alert">
        <p>
          <?php
          echo $_SESSION['errors']['image'];
          unset($_SESSION['errors']['image']);
        } ?>
        </p>
  </form>



  <?php
  require_once 'inc/footer.php'
  ?>