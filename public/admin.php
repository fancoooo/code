<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">


	<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="../font/css/all.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/admin.css">

	<script src="../script/jquerynew.js"></script>
	<script src="../script/jquery.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<title>Quản lý hệ thống</title>
</head>

<body>
	<?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 'Admin'){
    }else{
        header("Location: ../index.php");
    }
?>
	<div id="main">
		<div id="sidebar" class="classsidebar">
			<div id="sidebar-header">
				<div id="sidebar-header-logo"><img src=""></img></div>
				<div id="toggle-btn" onclick="collapsedManagement()"><i class="fa fa-bars fa-lg"></i></div>
				<span class="sidebar-header-text">Username : <?php echo $_SESSION['name'] ?></span><br>
				<span class="sidebar-header-text">Role : Quản Lý</span><br>
			</div>
			<script src="../script/collapsed.js"></script>
			<!-- -------------------------------------------Sidebar------------------------------------------------------------------ -->
			<div id="list-sidebar-area">
				<div class="sidebar-area-parent">
					<div class="sidebar-area" onclick="display(0)">
						<span class="sidebar-area-label">Quản lý đồ uống</span>
						<span class="sidebar-area-icon-collapse"><i class="fa fa-caret-right"></i></span>
						<span class="sidebar-area-icon-expand"><i class="fa fa-caret-down"></i></span>
						<div class="clr"></div>
					</div>
					<div class="sidebar-area-content">
						<div class="sidebar-area-child" id="list-product" onclick="displayContent(1)"><i
							lass="fa fa-list"></i><span class="li-text">Danh sách đồ uống</span>
						</div>
					</div>
				</div>
				<div class="sidebar-area-parent">
					<div class="sidebar-area" onclick="display(1)">
						<span class="sidebar-area-label">Quản lý thu chi</span>
						<span class="sidebar-area-icon-collapse"><i class="fa fa-caret-right"></i></span>
						<span class="sidebar-area-icon-expand"><i class="fa fa-caret-down"></i></span>
						<div class="clr"></div>
					</div>
					<div class="sidebar-area-content">
						<div class="sidebar-area-child" onclick="displayContent(4)"><i class="fa fa-list"></i><span
								class="li-text">Danh sách thu chi</span></div>
					</div>
				</div>
			</div>
		</div>
		<!-- -------------------------------------------Content------------------------------------------------------------------ -->
		<div id="content" class="classcontent">
			<div id="content-navbar">
				<div class="content-navbar-description"><i class="fa fa-coffee"></i><span> Manage System</span></div>
				<div class="content-navbar-home"><a href="#"><i class="fa fa-home"></i><span
							class="icon-navbar-label">Homepage</span></a></div>
				<div class="content-navbar-profile"><a href="#"><i class="fa fa-user"></i><span
							class="icon-navbar-label">Profile</span></a></div>
				<div class="content-navbar-logout"><a href="logout.php" method="post"><i class="fa fa-times"></i><span
							class="icon-navbar-label">Log Out</span></a></div>
			</div>
			<!-- -------------------------------------------List Product-------------------------------------------- -->
			<div class="content-section" id="first-content-section">
				<div class="container">
					<div class="content-section-title">
						<div class="title-factor-id">ID</div>
						<div class="title-factor-name name-center">Tên sản phẩm</div>
						<div class="title-factor">Đơn Giá</div>
						<div class="title-factor">Loại Sản Phẩm</div>
						<div class="title-factor-icon">Thao Tác</div>
					</div>
					<div class="content-section-list list">

					</div>
				</div>
			</div>
			<!-- -------------------------------------------Add Product-------------------------------------------- -->
			<!-- <div class="content-section" id="second-content-section">
				<div class="content-section-list">
					<form action="" method="post">
						<div id="button-change-info">
							<div id="prop-info">Properties</div>
						</div>
						<div class="clr"></div>
						<input type="hidden" name="typeofsubmit" value="addproduct">
						<div id="add-info-1">
							<div class="input-information">
								<div class="input-information-label">Name</div>
								<div class="input-information-input"><input type="text" id="name" name="productname"></div>
							</div>
							<div class="input-information">
								<div class="input-information-label">Price</div>
								<div class="input-information-input"><input type="text" id="price" name="productprice"></div>
							</div>

							<div class="input-information">
								<div class="input-information-label">Category</div>
								<div class="input-information-input"><input type="text" id="ap-cat-input" name="productcategory"></div>
							</div>

						</div>

						<div class="clr"></div>
						<div id="add-info-4">
							<div class="submit-btn-addproduct"><input type="button" id="submit-btn-addproduct-input" value="CONFIRM">
							</div>
						</div>
						<div id="add-info-3">
							<div class="description-section">
								<div class="description-section-input"><textarea name="productdescription"></textarea></div>
							</div>
						</div>
					</form>
				</div>
			</div> -->
			<!-- -------------------------------------------Update product-------------------------------------------- -->
			<!-- <div class="content-section" id="third-content-section">
				<div class="container">
					<div class="third-section-header">
						<form action="" method="post">
							<div class="third-section-header-1">
								<div class="third-header-1-label">ID Product</div>
								<div class="third-header-1-input"><input type="text" name="third-pid" placeholder="ID"></div>
							</div>
							<input type="hidden" name="typeofsubmit" value="searchproductbyid">
							<div class="third-section-header-2"><button type="submit">SEARCH</button></div>
							<div class="clr"></div>
						</form>
					</div>
					<div class="third-section-body">
						<form>
							<div class="input-information">
								<div class="input-information-label">ID</div>
								<div class="input-information-input"><input type="text" id="a" name="tproductid" value=""></div>
							</div>
							<div class="input-information">
								<div class="input-information-label">Name</div>
								<div class="input-information-input"><input type="text" id="b" name="tproductname" value=""></div>
							</div>
							<div class="input-information">
								<div class="input-information-label">Price</div>
								<div class="input-information-input"><input type="text" id="c" name="tproductprice" value=""></div>
							</div>

							<div class="input-information">
								<div class="input-information-label">Category</div>
								<div class="input-information-input"><input type="text" id="d" name="tproductcategory" value=""></div>
							</div>

							<input type="hidden" name="typeofsubmit" value="updateproduct">
							<div id="submit-update-product-btn"><input type="button" id="submit-update-product" value="CONFIRM"></div>
						</form>
					</div>
				</div>
			</div> -->
			<!-- -------------------------------------------List order-------------------------------------------- -->
			<div class="content-section" id="fifth-content-section">
				<div class="container">
					<div class="content-section-title">
						<div class="title-factor order1">Mã Phiếu</div>
						<div class="title-factor order2">mã Khách Hàng</div>
						<div class="title-factor order3">Tổng Tiền</div>
						<div class="title-factor order4">Thời gian lập phiếu</div>
					</div>
					<div class="content-section-list order">

					</div>
				</div>
			</div>
		</div>
		<div class="clr"></div>
	</div>

	<!-- Begin Modal -->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title text-center">Add Sản Phẩm</h4>
					<button type="button" class="close" data-dismiss="modal">×</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Add</button>
				</div>

			</div>
		</div>
	</div>
	<!-- End Modal -->

	<!-- Begin Modal show order-->
	<div class="modal fade" id="ModalOrder">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title text-center">Chi tiết số lượng order</h4>
					<button type="button" class="close" data-dismiss="modal">×</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<div class="body-header row">
						<div class="body-item col-5">Tên nước order</div>
						<div class="body-item col-2">Số lượng</div>
						<div class="body-item col-3">Đơn giá</div>
						<div class="body-item col-2">Tổng tiền</div>
					</div>
					<div class="body-content row">
					
					</div>
					<div class="body-footer">

					</div>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
				</div>

			</div>
		</div>
	</div>
	<!-- End Modal -->

	<script src=../script/admin.js>> </script> <script src="../script/management.js"></script>
</body>

</html>