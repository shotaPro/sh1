<?php
session_start();
include "db/db.php";
include "header.php";

if (isset($_POST['submit'])) {

    $cat = $_POST['cat'];
    $brand = $_POST['brand'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $keyword = $_POST['keyword'];

    $picture_name = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_tmp_name = $_FILES['picture']['tmp_name'];
    $picture_size = $_FILES['picture']['size'];

    if($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif"){
        if($picture_size <= 50000000){

            $pic_name = time() . "_" . $picture_name;
            move_uploaded_file($picture_tmp_name, "assets/pro_images/" .$pic_name);
            $sql = "INSERT INTO products (product_cat, product_brand, product_title, product_price, product_desc, product_image, product_keywords) VALUES ('$cat','$brand','$title','$price','$desc','$pic_name','$keyword')";
            mysqli_query($conn, $sql);
            header("location: admin.php");
        }
    }





    $picture_name = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_tmp_name = $_FILES['picture']['tmp_name'];
    $picture_size = $_FILES['picture']['size'];

    if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif") {
        if ($picture_size <= 50000000)

            $pic_name = time() . "_" . $picture_name;
        move_uploaded_file($picture_tmp_name, "../product_images/" . $pic_name);

        mysqli_query($con, "insert into products (product_cat, product_brand,product_title,product_price, product_desc, product_image,product_keywords) values ('$product_type','$brand','$product_name','$price','$details','$pic_name','$tags')") or die("query incorrect");

        header("location: sumit_form.php?success=1");
    }
}

?>
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Add Product</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product_cat</label>
                                        <input type="text" id="cat" name="cat" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product_brand</label>
                                        <input type="text" id="brand" name="brand" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product_title</label>
                                        <input type="text" id="title" name="title" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pricing</label>
                                        <input type="text" id="price" name="price" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product_Desc</label>
                                        <input type="text" id="desc" name="desc" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="">Add Image</label>
                                        <input type="file" name="picture" required class="btn btn-fill btn-success" id="picture">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>product_keyword</label>
                                        <input type="text" id="keyword" name="keyword" required class="form-control">
                                    </div>
                                </div>
                                <button type="submit" name="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
include "footer.php";
?>