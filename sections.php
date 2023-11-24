<?php 
include 'connection.php'; // combines 2 different files -> whatever is inside connection.php file is now also available in section.php


// function to insert data
function createSection($section_name){
    $conn = connection(); // convert connection function into a variable - to make it shorter when writing it
    $sql = "INSERT INTO sections(section_name) VALUES('$section_name')"; //the sql code to insert data inside the table
    // validate if the data is inserted inside the table
    
    
    if($conn->query($sql)){ // executing or running your sql code inside phpmyadmin using PHP
        // if the data is added - refresh the page
        header('refresh:0');
    }else{
        // if not inserted, display an error
        die('ERROR: '.$conn->error);
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
// print_r(displaySections());


// function sample($section_name){
//     if(connection()->query( "INSERT INTO sections(section_name) VALUES('$section_name')")){ // executing or running your sql code inside phpmyadmin using PHP
//         // if the data is added - refresh the page
//         header('refresh:0');
//     }
// }

function deleteSection($section_id){
    $conn = connection();
    $sql = "DELETE FROM sections WHERE section_id = $section_id";

    if($conn->query($sql)){
        header('refresh:0');
        exit;
    }else{
        die("ERROR: ".$conn->error);
    }
}

// create a function called 
    // 1. deleteSection
    // 2. create if isset for delete
    // 3. use section_id to delete data from table
    // 4. use createSection as a refernece to finish deleteSection

if(isset($_POST['btn_add'])){
    $section = $_POST['section'];

    createSection($section);

}

if(isset($_POST['btn_delete'])){
    $id = $_POST['btn_delete'];


    deleteSection($id);
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
                <h2 class="fw-light mb-3">
                    Section
                </h2>


                <!-- form -->
                <div class="mb-3">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="section" id="" class="form-control" required autofocus>
                            </div>
                            <div class="col-auto">
                                <button type="submit" name="btn_add" class="btn btn-info w-100 fw-bold">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table">
                    <thead class="table-primary">
                        <td>ID</td>
                        <td>Section Name</td>
                        <td></td>
                    </thead>
                    <tbody>
                        <?php foreach(displaySections() as $section): ?>
                            <tr>
                                <td><?= $section['section_id'] ?></td>
                                <td><?= $section['section_name'] ?></td>
                                <td>
                                    <form action="" method="post">
                                        <button type="submit" name="btn_delete" value="<?= $section['section_id'] ?>" class="btn btn-danger btn-sm">Delete</button>
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