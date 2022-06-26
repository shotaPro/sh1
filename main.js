$(document).ready(function () {



	product();
	category();
	brand();

	function product() {
		$.ajax({
			url: "action.php",
			method: "POST",
			data: { getProduct: 1 },
			success: function (data) {
				$('#get_product').html(data);
			}
		})
	}

	function category() {
		$.ajax({
			url: "action.php",
			method: "POST",
			data: { category: 1 },
			success: function (data) {
				$('#get_cat').html(data);
			}
		})
	}

	function brand() {
		$.ajax({
			url: "action.php",
			method: "POST",
			data: { brand: 1 },
			success: function (data) {
				$('#get_brand').html(data);
			}
		})
	}

	

	$('body').delegate('#price_sort', 'click', function (e) {
		e.preventDefault();
		$(this).css('color', 'red');
		$.ajax({
			url: "action.php",
			method: "POST",
			data: { getProduct: 1, price_sorted: 1 },
			success: function (data) {
				$('#get_product').html(data);
			}
		})
	})

	$('body').delegate('.product', 'click', function () {
		var product_id = $(this).attr('pid');
		$.ajax({
			url: "action.php",
			method: "POST",
			data: { addToProduct: 1, proId: product_id },
			success: function (data) {
				$('#cartmsg').html(data);
				cart_count();
			}
		})
	})


	cart_count();

	function cart_count() {
		$.ajax({
			url: 'action.php',
			method: 'POST',
			data: { cartcount: 1 },
			success: function (data) {
				$('.badge').html(data);
			}
		})
	}

	cartDetail();

	function cartDetail() {
		$.ajax({
			url: "action.php",
			method: "POST",
			data: { cartDetail: 1 },
			success: function (data) {
				$('#cartdetail').html(data);
			}
		})
	}


	$("body").delegate(".qty", "keyup", function () {
		var pid = $(this).attr("pid");
		var qty = $("#qty-" + pid).val();
		var price = $("#price-" + pid).val();
		var total = qty * price;
		$("#amt-" + pid).val(total);
	})

	$('body').delegate('.update', 'click', function (e) {
		e.preventDefault();
		var pid = $(this).attr('update_id');
		var qty = $('#qty-' + pid).val();
		var price = $('#price-' + pid).val();
		var total = $('#amt-' + pid).val();
		$.ajax({
			url: 'action.php',
			method: 'POST',
			data: { updateProduct: 1, updateId: pid, qty: qty, price: price, total: total },
			success: function (data) {
				$('#cart_msg').html(data);
				cartDetail();
			}
		})
	})

	$('body').delegate('.update', 'click', function (e) {
		e.preventDefault();
		var pid = $(this).attr('update_id');
		var qty = $('#qty-' + pid).val();
		var price = $('#price-' + pid).val();
		var total = $('#amt-' + pid).val();
		$.ajax({
			url: 'action.php',
			method: 'POST',
			data: { updateProduct: 1, updateId: pid, qty: qty, price: price, total: total },
			success: function (data) {
				$('#cart_msg').html(data);
				cartDetail();
			}
		})
	})

	$('body').delegate('.remove', 'click', function (e) {
		e.preventDefault();
		var $pid = $(this).attr('remove_id');
		$.ajax({
			url: 'action.php',
			method: 'POST',
			data: { removeProduct: 1, removeId: $pid },
			success: function (data) {
				$('#cart_msg').html(data);
				cartDetail();
			}
		})
	})


	$('#search_btn').click(function () {

		var keyword = $('#search').val();

		console.log(keyword);

		if (keyword != "") {
			$.ajax({
				url: "action.php",
				method: "POST",
				data: { search: 1, keyword: keyword },
				success: function (data) {
					$('#get_product').html(data);
				}
			})
		}
	});

	page();
	function page() {
		$.ajax({
			url: 'action.php',
			method: 'POST',
			data: { page: 1 },
			success: function (data) {
				$('#pageno').html(data);
			}
		})
	}

	$('body').delegate('.page','click',function(e){
		e.preventDefault();
		var pno=$(this).attr('page');
		$.ajax({
			url: "action.php",
			method: "POST",
			data: {getProduct:1, setPage:1, pageNumber:pno},
			success: function(data){
				$('#get_product').html(data);
				$('body').animate({scrollTop:0},500);
			}
		})
	})




})




