<?php

namespace App\Repository;

class CartRepository extends Repository
{
    public function add($user_id, $name, $image, $price, $amount)
    {
        $insert = $this->db->prepare("INSERT INTO cart (user_id, name, image, price, amount, created_at) 
VALUES (:user_id, :name, :image, :price, :amount, :created_at)");
        $insert->execute([
            ':user_id' => $user_id,
            ':name' => $name,
            ':image' => $image,
            ':price' => $price,
            ':amount' => $amount,
            ':created_at' => date('Y-m-d, H:i:s'),
        ]);
    }

    public function showItems()
    {
        $products = $this->db->query("SELECT * FROM cart WHERE user_id = '" . $_SESSION['user_id'] . "'");
        $products->execute();

        $allProducts = $products->fetchAll(\PDO::FETCH_OBJ);

        return $allProducts;
    }

    public function deleteItem($id)
    {
        $update = $this->db->prepare("DELETE FROM cart WHERE id = '" . $id . "'");
        $update->execute();

    }

    public function deleteAllItems()
    {
        $update = $this->db->prepare("DELETE FROM cart WHERE user_id = '" . $_SESSION['user_id'] . "'");
        $update->execute();
    }

    /* TODO update cart amount */
    /*
     * if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $pro_amount = $_POST['pro_amount'];

    $update = $conn->prepare("UPDATE cart SET pro_amount = '" . $pro_amount . "' WHERE pro_id = '" . $id . "'");
    $update->execute();
}
     */
}