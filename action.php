<?php
session_start();
include 'db/db.php';


if (isset($_POST['getProduct'])) {

    $limit = 6;

    if (isset($_POST['setPage'])) {

        $pageno = $_POST['pageNumber'];
        $start = ($pageno * $limit) - $limit;
    } else {

        $start = 0;
    }

    if (isset($_POST['price_sorted'])) {

        $sql = "SELECT * FROM sh1.products ORDER BY product_price";
    } else {

        $sql = "SELECT * FROM sh1.products LIMIT $start,$limit";
    }

    $product_query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($product_query)) {

        while ($row = mysqli_fetch_array($product_query)) {
            $pro_id = $row['product_id'];
            $pro_cat = $row['product_cat'];
            $pro_brand = $row['product_brand'];
            $product_title = $row['product_title'];
            $product_price = $row['product_price'];
            $img = $row['product_image'];

            echo "<div class='col-md-4'>
                <div class='panel panel-info'>
                    <div class='panel-heading'>$product_title</div>
                    <div class='panel-body'>
                    <a href='#' class='imageproduct' pid='$pro_id'>
                        <img src='assets/pro_images/$img' style='width:200px; height:250px;' >
                    </a>
                    </div>
                    <div class='panel-heading'> $product_price
                    <button pid='$pro_id' class='quicklook btn btn-danger btn-xs' style='float:right;'>Quick look</button>&nbsp;
                    <button pid='$pro_id' class='product btn btn-danger btn-xs' style='float:right;'>Add to Cart</button>
                    </div>
                </div></div>";
        }
    }
}

if (isset($_POST['brand'])) {
    $sql = "SELECT * FROM brands";
    $run_query = mysqli_query($conn, $sql);
    echo "<div class='nav nav-pills nav-stacked'>
					<li class='active'><a href='#'><h4>brand</h4></a></li>";
    if (mysqli_num_rows($run_query)) {
        while ($row = mysqli_fetch_array($run_query)) {

            $bid = $row['brand_id'];
            $bnd_name = $row['brand_title'];

            echo "<li><a href='#' class='brand' bid='$bid'>$bnd_name</a></li>";
        }
    }
}


if (isset($_POST['addToProduct'])) {
    if (!(isset($_SESSION['user_id']))) {
        echo "
                <div class='alert alert-danger' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <strong>Hey there!</strong> Sign in to buy stuff!
        </div>
            ";
    } else {
        $pid = $_POST['proId'];
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM cart WHERE p_id = '$pid' AND user_id = '$user_id'";
        $run_query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($run_query);
        if ($count > 0) {
            echo "<div class='alert alert-danger' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <strong>Success!</strong> Already added!
        </div>";
        } else {
            $sql = "SELECT * FROM products WHERE product_id = '$pid'";
            $run_query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($run_query);
            $id = $row["product_id"];
            $pro_title = $row["product_title"];
            $pro_image = $row["product_image"];
            $pro_price = $row["product_price"];


            $sql = "INSERT INTO cart(p_id,ip_add,user_id,product_title,product_image,qty,price,total_amount) VALUES('$pid','0.0.0.0','$user_id','$pro_title','$pro_image','1','$pro_price','$pro_price')";
            $run_query = mysqli_query($conn, $sql);
            if ($run_query) {
                echo "
                <div class='alert alert-success' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <strong>Success!</strong> Product added to cart!
        </div>
            ";
            }
        }
    }
}

if (isset($_POST['cartcount'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "0";
    } else {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
        $run_query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($run_query);
        echo $count;
    }
}

if (isset($_POST['cartDetail'])) {

    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
    $run_query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($run_query);

    if ($count > 0) {

        $total_amt = 0;

        while ($row = mysqli_fetch_array($run_query)) {

            $pid = $row['p_id'];
            $product_image = $row['product_image'];
            $product_title = $row['product_title'];
            $product_price = $row['price'];
            $qty = $row['qty'];
            $total = $row['total_amount'];
            $price_array = array($total);
            $price_total = array_sum($price_array);
            $total_amt += $price_total;

            echo "<div class='row'>
            <div class='col-md-2'><a href='#' remove_id='$pid' class='btn btn-danger remove'><span class='glyphicon glyphicon-trash'>De</span></a>
            <a href='#' update_id='$pid' class='btn btn-success update'><span class='glyphicon glyphicon-ok-sign'>Up</span></a>
            </div>
            <div class='col-md-2'><img src='assets/pro_images/$product_image' width='60px' height='60px'></div>
            <div class='col-md-2'>$product_title</div>
            <div class='col-md-2'><input class='form-control price' type='text' size='10px' pid='$pid' id='price-$pid' value='$product_price' disabled></div>
            <div class='col-md-2'><input class='form-control qty' type='text' size='10px' pid='$pid' id='qty-$pid' value='$qty'></div>
            <div class='col-md-2'><input class='total form-control price' type='text' size='10px' pid='$pid' id='amt-$pid' value='$total' disabled></div>
        </div>
        ";
        }
    }


    if (isset($_POST['cartDetail'])) {
        echo "
			<div class='row'>
						<div class='col-md-8'></div>
						<div class='col-md-4'>
							<b>Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$$total_amt</b>
						</div>
					</div>
		";
    }
}

if (isset($_POST['updateProduct'])) {

    $user_id = $_SESSION['user_id'];
    $pid = $_POST['updateId'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $total = $_POST['total'];
    $sql = "UPDATE cart SET qty='$qty', price='$price', total_amount='$total' WHERE p_id='$pid' AND user_id='$user_id'";
    $run_query = mysqli_query($conn, $sql);

    if ($run_query) {

        echo "
        <div class='alert alert-success' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            <strong>Success!</strong> Item updated!
        </div>
        ";
    }
}

// if(isset($_POST['removeProduct'])){
//     $user_id = $_SESSION['user_id'];
//     $pid = $_POST['removeId'];
//     $sql ="DELETE FROM cart WHERE pid='$pid' AND user_id='$user_id'";
//     $run_query = mysqli_query($conn,$sql);

//     if($run_query){
//         echo "
//         <div class='alert alert-danger' role='alert'>
//               <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
//               <strong>Success!</strong> Item removed from cart!
//         </div>
//     ";
//     }
// }

if (isset($_POST['removeProduct'])) {
    $pid = $_POST['removeId'];
    $user_id = $_SESSION['user_id'];
    $sql = "DELETE FROM cart WHERE p_id = '$pid' AND user_id = '$user_id'";
    $run_query = mysqli_query($conn, $sql);
    if ($run_query) {
        echo "
            <div class='alert alert-danger' role='alert'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                  <strong>Success!</strong> Item removed from cart!
            </div>
        ";
    }
}

if (isset($_POST['search'])) {

    $keyword = $_POST['keyword'];
    $sql = "SELECT * FROM products WHERE product_title LIKE '%$keyword%'";

    $run_query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($run_query)) {
        $pro_id = $row['product_id'];
        $pro_cat = $row['product_cat'];
        $brand = $row['product_brand'];
        $title = $row['product_title'];
        $price = $row['product_price'];
        $img = $row['product_image'];

        echo "<div class='col-md-4'>
                        <div class='panel panel-info'>
                            <div class='panel-heading'>$title</div>
                            <div class='panel-body' class='imageproduct' pid='$pro_id'><img src='assets/pro_images/$img' style='width:200px; height:250px;'></div>
                            <div class='panel-heading'>Rs $price
                            <button pid='$pro_id' class='quicklook btn btn-warning btn-xs' style='float:right;'>Quick look</button>&nbsp;
                            <button pid='$pro_id' class='product btn btn-danger btn-xs' style='float:right;'>Add to Cart</button>
                            
                            </div>
                        </div></div>";
    }
}

if (isset($_POST['page'])) {
    $sql = "SELECT * FROM products";
    $run_query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($run_query);
    $pageno = ceil($count / 6);


    for ($i = 1; $i <= $pageno; $i++) {
        echo "
            <li><a href='#' page='$i' class='page'>$i</a></li>
        ";
    }
}
