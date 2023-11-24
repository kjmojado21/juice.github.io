<?php 
include 'connection.php'; // combines 2 different files -> whatever is inside connection.php file is now also available in section.php

function displayProducts(){
    $conn = connection();
    $sql = "SELECT products.id,products.name,products.description, products.price, products.section_id, sections.section_name FROM products INNER JOIN sections ON products.section_id = sections.section_id";

    if($result = $conn->query($sql)){
        return $result;
    }else{
        die('ERROR: '.$conn->error);
    }
}


function deleteProduct($product_id){
    $conn = connection();
    $sql = "DELETE FROM products WHERE id = $product_id";

    if($conn->query($sql)){
        header('refresh:0');
        exit;
    }else{
        die("ERROR: ".$conn->error);
    }
}

if(isset($_POST['btn_delete'])){
    $id = $_POST['btn_delete'];

    deleteProduct($id);
}

?>


<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-10">
                <div class="row mb-3">
                    <div class="col text-start">
                        <h3 class="display-6">Products</h3>
                    </div>
                    <div class="col text-end">
                        <a href="addProducts.php" class="btn btn-success">Add Product</a>
                    </div>
                </div>
                <table class="table">
                    <thead class="table-info">
                        <th>ID</th>
                        <th>NAME</th>
                        <th>DESCRIPTION</th>
                        <th>PRICE</th>
                        <th>SECTION</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php foreach(displayProducts() as $product): ?>
                            <tr>
                                <td><?= $product['id'] ?></td>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['description'] ?></td>
                                <td><?= $product['price'] ?></td>
                                <td><?= $product['section_name'] ?></td>
                                <td>
                                    <a href="editProduct.php?id=<?= $product['id'] ?>" class="btn btn-warning">Edit</a>
                                    <form action="" method="post" class="d-inline mx-1">
                                        <button type="submit" name="btn_delete" value="<?= $product['id'] ?>" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>