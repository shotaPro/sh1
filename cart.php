<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.php'; ?>
</head>

<body>
    <div class="navbar navbar-default navbar-fixed-top" id="topnav">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">Amaclone</a>
            </div>


        </div>
    </div>
    <p><br><br></p>
    <p><br><br></p>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12" id="cart_msg"></div>
                </div>
                <div class="panel panel-primary text-center">
                    <div class="panel-heading">Cart Checkout</div>
                    <div class="panel-body"></div>
                    <div class="row">
                        <div class="col-md-2"><b>Action</b></div>
                        <div class="col-md-2"><b>Product Image</b></div>
                        <div class="col-md-2"><b>Product Name</b></div>
                        <div class="col-md-2"><b>Product Price</b></div>
                        <div class="col-md-2"><b>Quantity</b></div>
                        <div class="col-md-2"><b>Price in $</b></div>
                    </div>
                    <br><br>
                    <div id='cartdetail'>
                        <!--<div class="row">
						<div class="col-md-2"><a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
						<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-ok-sign"></span></a>
						</div>
						<div class="col-md-2"><img src="assets/prod_images/tshirt.JPG" width="60px" height="60px"></div>
						<div class="col-md-2">Tshirt</div>
						<div class="col-md-2">$700</div>
						<div class="col-md-2"><input class="form-control" type="text" size="10px" value='1'></div>
						<div class="col-md-2"><input class="form-control" type="text" size="10px" value='700'></div>
					</div>-->
                    </div>
                    <!--<div class="row">
						<div class="col-md-8"></div>
						<div class="col-md-4">
							<b>Total: $500000</b>
						</div>
					</div>-->
                    <div class="panel-footer">

                    </div>
                </div>
                <button class='btn btn-success btn-lg pull-right' id='checkout_btn' data-toggle="modal" data-target="#myModal">Checkout</button>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>