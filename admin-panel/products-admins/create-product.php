<?php

include_once '../../config/config.php';
include_once '../layouts/header.php';

if(!isset($_SESSION['admin_id'])) {
    echo '<script>window.location="' . ADMIN_URL . 'admins/login-admins.php"</script>';
}

try{

    $selectCategories = $conn->query("SELECT * FROM categories");
    $selectCategories->execute();
    $categories = $selectCategories->fetchAll(PDO::FETCH_OBJ);

    if (isset($_POST['submit'])) {

        if (empty($_POST['name']) or
            empty($_POST['description']) or
            empty($_POST['price']) or
            empty($_POST['category_id']) or
            empty($_FILES['image']['name']) or
            empty($_FILES['file']['name'])
        ) {
            echo "<script>alert('one or more inputs are empty');</script>";
        } else {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $image = $_FILES['image']['name'];
            $file = $_FILES['file']['name'];

            $dirImage = dirname(dirname(__DIR__)) . "/images/" . basename($image);
            $dirFile = dirname(dirname(__DIR__)) . "/books/" . basename($file);

            $insert = $conn->prepare("INSERT INTO products 
            (name, image, price, file, description, status, category_id, created_at) VALUES 
            (:name, :image, :price, :file, :description, :status, :category_id, :created_at)");
            $insert->execute([
                ':name' => $name,
                ':image' => $image,
                ':price' => $price,
                ':file' => $file,
                ':description' => $description,
                ':status' => 1,
                ':category_id' => $category_id,
                ':created_at' => date('Y-m-d, H:i:s'),
            ]);

            if (
                move_uploaded_file($_FILES['image']['tmp_name'], $dirImage) &&
                move_uploaded_file($_FILES['file']['tmp_name'], $dirFile)
            ) {
                echo '<script>window.location="' . ADMIN_URL . 'products-admins/show-products.php"</script>';
            }
        }
    }

} catch(PDOException $e) {
    $e->getMessage();
} catch(Exception $e) {
    $e->getMessage();
}

?>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-5 d-inline">Create Products</h5>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <!-- Email input -->
                            <div class="form-outline mb-4 mt-4">
                                <label>Name</label>

                                <input type="text" name="name" id="form2Example1" class="form-control"
                                       placeholder="name"/>
                            </div>

                            <div class="form-outline mb-4 mt-4">
                                <label>Price</label>

                                <input type="text" name="price" id="form2Example1" class="form-control"
                                       placeholder="price"/>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea name="description" placeholder="description" class="form-control"
                                          id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select Category</label>
                                <select name="category_id" class="form-control" id="exampleFormControlSelect1">
                                    <option>--select category--</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-outline mb-4 mt-4">
                                <label>Image</label>

                                <input type="file" name="image" id="form2Example1" class="form-control"
                                       placeholder="image"/>
                            </div>

                            <div class="form-outline mb-4 mt-4">
                                <label>File</label>
                                <input type="file" name="file" id="form2Example1" class="form-control"
                                       placeholder="file"/>
                            </div>


                            <!-- Submit button -->
                            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create
                            </button>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once '../layouts/footer.php'; ?>