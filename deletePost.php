<?php
require_once 'inc/header.php';
require_once 'inc/connect.php';

?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  if (isset($_GET['id']) && isset($_POST['submit'])) {
    $id = $_GET['id'];
    $sql = "delete FROM posts WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    header('location:index.php');
    exit();
  }
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM posts WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) == 1) {
    $post = mysqli_fetch_assoc($result);
  } else {
    header('location:index.php');
  }
} else {
  header('location:index.php');
}


?>

<style>
/* General Styles */
.card-body {
  position: relative;
  left: 10%;
  width: 70%;
}

.delebody {
  margin: 0;
  position: relative;
  padding-bottom: 5px;
}

footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  padding: 1px;
  height: 15vh;
  background-color: #333;
  color: white;
  text-align: center;
  position: fixed;
}

/* Card Styles */
.custom-card {
  width: 80%;
  border: none;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  text-align: center;
}

.custom-title {
  margin-bottom: 20px;
  color: #ffffff;
  background-color: rgb(225, 11, 50);
  position: relative;
  top: 70px;
  font-size: 26px;
  border-radius: 8px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
}

.image-container {
  width: 100%;
  max-height: 200px;
  overflow: hidden;
  margin-bottom: 20px;
  border-radius: 8px;
}

/* Post Image */
.post-image {
  margin-top: 10%;
  margin-bottom: 10%;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.card {
  background-color: antiquewhite;
  position: relative;
  margin: 0 auto;
  max-width: 1000px;
  width: 90%;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  height: fit-content;
  top: 90px;
}

/* Post Title */
.post-title {
  font-size: 24px;
  font-weight: bold;
  position: relative;
  top: 80px;
}

/* Post Date */
.post-date {
  color: gray;
  font-size: 14px;
  margin-bottom: 20px;
}

/* Post Body */
.post-body {
  font-size: 16px;
  line-height: 1.6;
  padding: 0 15px;
  margin-bottom: 20px;
  text-align: center;
}

/* Delete Button */
.btn-danger {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  transition: background-color 0.3s ease;
  margin-top: 20px;
}

.btn-danger:hover {
  background-color: rgb(200, 0, 40);
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
  .card-body {
    width: 90%;
    left: 5%;
  }

  .custom-card {
    width: 100%;
  }

  .post-image {
    width: 100%;
    height: auto;
  }

  .post-title {
    font-size: 20px;
  }

  .post-body {
    font-size: 14px;
  }

  .post-date {
    font-size: 12px;
  }

  footer {
    height: 10vh;
  }
}

@media (max-width: 480px) {
  .custom-title {
    font-size: 22px;
    top: 50px;
  }

  .post-title {
    font-size: 18px;
  }

  .post-body {
    font-size: 12px;
  }

  .btn-danger {
    font-size: 14px;
    padding: 8px 16px;
  }

  footer {
    height: 8vh;
  }
}
</style>

<body class="delebody">






  <form method="post" action="deletePost.php?id=<?php echo $_GET['id']; ?>">
    <div class="card custom-card">

      <h3 class="card-title custom-title">Are you sure you want to delete this post?</h3>
      <h4 class="post-title"><?php echo $post['title']; ?></h4>
      <img style="width:60%; height:350px; position:relative; left:20% " src="uploads/<?php echo $post['image']; ?>"
        alt="Post Image" class="post-image">
      <div class="down-content">
        <h6 class="post-date"><?php echo $post['createdat']; ?></h6>
        <p class="post-body"><?php echo $post['body']; ?></p>
        <button name="submit" class="btn btn-danger">Delete Post</button>
      </div>
    </div>
    </div>
  </form>
</body>



<?php require_once 'inc/footer.php'; ?>