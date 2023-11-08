<?php

include_once '../../config/config.php';
include_once '../layouts/header.php';

if (isset($_GET['id'])) {

    try {
        $select = $conn->prepare("SELECT * FROM categories WHERE id = '" . $_GET['id'] . "'");
        $select->execute();

        $category = $select->fetch(PDO::FETCH_OBJ);

        if (isset($_POST['submit'])) {

            if (empty($_POST['name']) or empty($_POST['description']) or empty($_FILES['image']['name'])) {
                echo "<script>alert('one or more inputs are empty');</script>";
            } else {

                $oldImageFile = dirname(dirname(__DIR__)) . '/categories/images/' . $category->image;
                if(file_exists($oldImageFile)) {
                    unlink($oldImageFile);
                }

                $name = $_POST['name'];
                $description = $_POST['description'];
                $image = $_FILES['image']['name'];

                $dir = dirname(dirname(__DIR__)) . "/categories/images/" . basename($image);

                $update = $conn->prepare("UPDATE categories SET 
                    name=:name,
                    description=:description,
                    image=:image WHERE id='" . $_GET['id'] . "'");

                $update->execute([
                    ':name' => $name,
                    ':description' => $description,
                    ':image' => $image
                ]);

                if (move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
                    echo '<script>window.location="' . ADMIN_URL . 'categories-admins/show-categories.php"</script>';
                }
            }
        }
    } catch (PDOException $e) {
        $e->getMessage();
    } catch (Exception $e) {
        $e->getMessage();
    }

} else {
    echo '<script>window.location="http://localhost:8100/404.php";</script>';
}

?>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-5 d-inline">Update Categories</h5>
                        <form method="POST" action="" enctype="multipart/form-data">

                            <div class="form-outline mb-4 mt-4">
                                <label>Name</label>
                                <input type="text" name="name" value="<?php echo $category->name; ?>" id="form2Example1"
                                       class="form-control" placeholder="name"/>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea name="description" placeholder="description" class="form-control"
                                          id="exampleFormControlTextarea1"
                                          rows="3"><?php echo $category->description; ?></textarea>
                            </div>

                            <div class="form-outline mb-4 mt-4">
                                <label>Image</label></br>
                                <img class="img-thumbnail"
                                     src="<?php echo URL; ?>/categories/images/<?php echo $category->image; ?>"/>
                                <input type="file" name="image" id="form2Example1" class="form-control"
                                       placeholder="image"/>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once '../layouts/footer.php'; ?>