<?php 
include 'connection.php'; // combines 2 different files -> whatever is inside connection.php file is now also available in section.php

 function createProduct($name,$description,$price,$section_id){
    $conn = connection();
    $sql = " INSERT INTO products (name,description,price,section_id) VALUES ('$name','$description','$price','$section_id')";
    if($conn->query($sql)){
        header('refresh:0');
        exit;
    }else{
        die("ERROR: ".$conn->error);
    }
}


function displaySections(){
    $conn = connection();
    $sql = "SELECT * FROM sections";
    if($result = $conn->query($sql)){
        return $result;
    }else{
        die('ERROR: '.$conn->error);
    }
}

if(isset($_POST['btn_add'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $section_id = $_POST['section'];

    createProduct($name,$description,$price,$section_id);
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
        <div class="row justify-content-center">
            <div class="col-3">
                <h3 class="display-5">New Products</h3>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea name="description" id="" cols="5"  class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="price" id="price" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="section" class="form-label">Section</label>
                        <select name="section" id="" class="form-select">
                            <option value="" hidden>Select Section</option>
                            <?php foreach(displaySections() as $section): ?>
                                <option value="<?= $section['section_id'] ?>"><?= $section['section_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <button type="submit" name="btn_add" class="btn btn-primary w-100">Save Product</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>