<?php include_once '../config/config.php'; ?>
<?php include_once '../includes/header.php'; ?>

<?php

    if(isset($_POST['submit'])) {
        $pro_id = $_POST['pro_id'];
        $pro_name = $_POST['pro_name'];
        $pro_image = $_POST['pro_image'];
        $pro_price = $_POST['pro_price'];
        $pro_amount = $_POST['pro_amount'];
        $pro_file = $_POST['pro_file'];
        $user_id = $_POST['user_id'];

        $insert = $conn->prepare("INSERT INTO cart (pro_id, pro_name, pro_image, pro_price, pro_amount, pro_file, user_id, created_at) VALUES (:pro_id, :pro_name, :pro_image, :pro_price, :pro_amount, :pro_file, :user_id, :created_at)");
        $insert->execute([
                ':pro_id' => $pro_id,
                ':pro_name' => $pro_name,
                ':pro_image' => $pro_image,
                ':pro_price' => $pro_price,
                ':pro_amount' => $pro_amount,
                ':pro_file' => $pro_file,
                ':user_id' => $user_id,
                ':created_at' => date('Y-m-d, H:i:s'),
        ]);
    }

    if(isset($_GET['id'])) {
        $rows = $conn->query("SELECT * FROM products WHERE id = " . $_GET['id']);
        $rows->execute();

        $product = $rows->fetch(PDO::FETCH_OBJ);

        if($rows->rowCount() == 0) {
            echo '404';
            exit;
        }
    } else {
        echo '404';
        exit;
    }
?>

  <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="images p-3">
                                <div class="text-center p-4"> <img id="main-image" src="../images/<?php echo $product->image; ?>" width="250" /> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center"> <a href="#" class="ml-1 btn btn-primary"><i class="fa fa-long-arrow-left"></i> Back</a> </div> <i class="fa fa-shopping-cart text-muted"></i>
                                </div>
                                <div class="mt-4 mb-3"> 
                                    <h5 class="text-uppercase"><?php echo $product->name; ?></h5>
                                    <div class="price d-flex flex-row align-items-center"> <span class="act-price">$<?php echo $product->price; ?></span>
                                    </div>
                                </div>
                                <p class="about"><?php echo $product->description; ?></p>
                                <form id="form-data" method="POST" onsubmit="return false;">
                                    <div class="">
                                        <input type="hidden" name="pro_id" value="<?php echo $product->id; ?>" class="form-control" />
                                    </div>
                                    <div class="">
                                        <input type="hidden" name="pro_name" value="<?php echo $product->name; ?>" class="form-control" />
                                    </div>
                                    <div class="">
                                        <input type="hidden" name="pro_image" value="<?php echo $product->image; ?>" class="form-control" />
                                    </div>
                                    <div class="">
                                        <input type="hidden" name="pro_price" value="<?php echo $product->price; ?>" class="form-control" />
                                    </div>
                                    <div class="">
                                        <input type="text" name="pro_amount" value="1" class="form-control" />
                                    </div>
                                    <div class="">
                                        <input type="hidden" name="pro_file" value="<?php echo $product->file; ?>" class="form-control" />
                                    </div>
                                    <div class="">
                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>" class="form-control" />
                                    </div>
                                    <div class="cart mt-4 align-items-center"> <button id="submit" name="submit" type="submit" class="btn btn-primary text-uppercase mr-2 px-4"><i class="fas fa-shopping-cart"></i> Add to cart</button> </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
    <script>
        $(document).ready(function(){
            $(document).on("submit", function(e){

                if($('#user_id').val() == '') {
                    alert('please log in first');
                } else {
                    e.preventDefault();
                    var formdata = $("#form-data").serialize() + '&submit=submit';

                    $.ajax({
                        type: 'post',
                        url: 'single.php?id=<?php echo $_GET['id']; ?>',
                        data: formdata,

                        success: function() {
                            alert('added to cart successfully');
                            $("#submit").html('<i class="fas fa-shopping-cart"></i> Added to cart').prop("disabled", true);
                            reload();
                        }
                    });
                }
            });
        });

        function reload() {
            $("body").load("single.php?id=<?php echo $_GET['id']; ?>")
        }
    </script>

<?php include_once '../includes/footer.php'; ?>


