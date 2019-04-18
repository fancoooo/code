<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">


  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../font/css/all.css">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/user.css">

  <script src="../script/jquerynew.js"></script>
  <script src="../script/jquery.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.3/axios.min.js"></script>

  <title>Nhân Viên</title>
</head>

<body>
  <?php
    if(isset($_SESSION['user']) && $_SESSION['user'] == 'User'){
        
    }else{
        header("Location: ../index.php");
    }
?>
  <!-- Begin header -->
  <div id="main">
    <div id="sidebar" class="classsidebar">
      <div id="sidebar-header">
        <div id="sidebar-header-logo"><img src=""></img></div>
        <div id="toggle-btn" onclick="collapsedManagement()"><i class="fa fa-bars fa-lg"></i></div>
        <span class="sidebar-header-text">Username : <?php echo $_SESSION['name']?></span><br>
        <span class="sidebar-header-text">Role : Nhân Viên</span><br>
      </div>
      <!--<script src="script/collapsed.js"></script>-->
      <!-- -------------------------------------------Sidebar------------------------------------------------------------------ -->
      <div id="list-sidebar-area">
        <div class="sidebar-area-parent">
          <div class="sidebar-area">
            <span class="sidebar-area-label">Quản lý chỗ ngồi</span>
            <span class="sidebar-area-icon-collapse"><i class="fa fa-caret-right"></i></span>
            <span class="sidebar-area-icon-expand"><i class="fa fa-caret-down"></i></span>
            <div class="clr"></div>
          </div>
        </div>
        <div class="sidebar-area-parent">
          <div class="sidebar-area">
            <span class="sidebar-area-label">Quản lý bán hàng</span>
            <span class="sidebar-area-icon-collapse"><i class="fa fa-caret-right"></i></span>
            <span class="sidebar-area-icon-expand"><i class="fa fa-caret-down"></i></span>
            <div class="clr"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- -------------------------------------------Navbar---------------------------------------------------------->
    <div id="content" class="classcontent">
      <div id="content-navbar">
        <div class="content-navbar-description"><i class="fa fa-coffee"></i><span> Coffee and Music</span></div>
        <div class="content-navbar-home"><a href="#"><i class="fa fa-home"></i><span
              class="icon-navbar-label">Homepage</span></a></div>
        <div class="content-navbar-profile" id="info"><a href="#"><i class="fa fa-user"></i><span
              class="icon-navbar-label">Profile</span></a></div>
        <div class="content-navbar-logout"><a href="logout.php" method="post"><i class="fa fa-times"></i><span
              class="icon-navbar-label">Log Out</span></a></div>
      </div>
      <!-- --------------------------------------------Content-one-section ----------------------------------------------------->
      <div class="content-section" id="one-content-section">
        <div class="modal-header">
          <h4 class="modal-title text-center">Sơ Đồ Bàn Ngồi</h4>
        </div>
        <div class="modal-body">
          <div class="tang">TẦNG 1</div>
          <div class="row tang1">
          </div>
          <hr>
          <div class="tang">TẦNG 2</div>
          <div class="row tang2">
          </div>
          <hr>
          <div class="tang">NGOÀI TRỜI</div>
          <div class="row ngoaitroi">
          </div>
        </div>
      </div>
      <!-- --------------------------------------------Content-two-section ----------------------------------------------------->
      <div class="content-section" id="two-content-section">
        <div class="content-section-one">
          <div class="one-header">
              <div class="pay">
                <span>Đặt Bàn</span>
              </div>
              <div class="datban">
                <select  class="select">
                    
                </select>
                <div class="soluong"><input type="number" id="soluong" min="1"></div>
              </div>
          </div>
          <div class="vien"></div>
          <div class="title row">
              <span class="col-4">SẢN PHẨM</span>
              <span class="col-3">GIÁ</span>
              <span class="col-2">SỐ LƯỢNG</span>
              <span class="col-3">TỔNG</span>
          </div>
          <div class="content-pay">
            
          </div>
          <div class="pay-load">
                <button type='button' class='btn btn-primary' id='luu'><i class="fa fa-save"></i> Lưu</button>
                <button type='button' class='btn btn-warning' id='huy'><i class='fa fa-window-close'></i> Hủy</button>
                <button type='button' class='btn btn-success' id='thanhtoan'><i class="fa fa-check"></i>Thanh Toán</button>
          </div>
        </div>
        <div class="content-section-two">
          <div class="two-header">
            <div class="header borred" data-Man='home'>
              <i class="fa fa-home"></i>
            </div>
            <div class="header" data-Man='trasua'>
              <span>TRÀ SỮA</span>
            </div>
            <div class="header" data-Man='sinhto'>
              <span>SINH TỐ</span>
            </div>
            <div class="header" data-Man='caphe'>
              <span>CÀ PHÊ</span>
            </div>
            <div class="header" data-Man='nuocngot'>
              <span>NƯỚC NGỌT</span>
            </div>
          </div>
          <div class="vien"></div>
          <div class="search-sp">
            <input type="text" id="search-sp" placeholder="Tìm Kiếm Sản Phẩm ... " >
            <i class="fa fa-search"></i>
          </div>
          <div class="content-sp container">
              <div class="content-display isblock">
                <div class="content-sp-home row"> 
                </div>
              </div>
              <div class="content-display">
                <div class="content-sp-trasua row">
                </div>
              </div>
              <div class="content-display">
                <div class="content-sp-sinhto row">
                </div>
              </div>
              <div class="content-display">
                <div class="content-sp-caphe row">
                </div>
              </div>
              <div class="content-display">
                <div class="content-sp-nuocngot row">
                </div>
              </div>
              
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End header -->


  <!-- Begin Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-center">Sơ Đồ Bàn Ngồi</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="tang">Tầng 1</div>
          <div class="row tang1">

          </div>
          <hr>
          <div class="tang">Tầng 2</div>
          <div class="row tang2">
          </div>
          <hr>
          <div class="tang">Ngoài Trời</div>
          <div class="row ngoaitroi">

          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <!-- End Modal -->

  <!-- Begin Modal -->
  <div class="modal fade" id="myModalInfo">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-center">Thông tin nhân viên</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          
        
        <form>
          <div id="editImage" class="form-group">
            <img id="img" src="<?php echo trim($_SESSION['Image']) != '' ? $_SESSION['Image'] : '../img/Default.png'?>" alt="Info" width="100px" height="100px" >
            <input type="file" id="image" class="form-control" name="image" style="display:none;" onchange="changeFile(this.files)">
            <div class="den" id ="d" style="display:none;">Thay Đổi</div>
          </div>
            <div class="form-group">
              <label for="HoTen">Họ và Tên</label>
              <input type="text" class="form-control" id="HoTen" name="HoTen" value="<?php echo $_SESSION['HoTen']?>" readonly>
            </div>
            <div class="form-group">
              <label for="Tuoi">Tuổi</label>
              <input type="text" class="form-control" id="Tuoi" name="Tuoi" value="<?php echo $_SESSION['Tuoi']?>" readonly>
            </div>
            <div class="form-group">
              <label for="GioiTinh">Giới Tính</label>
              <select name="GioiTinh" id="GioiTinh" disabled>
                <option value="nam" <?php echo $_SESSION['GioiTinh'] == 'Nam' ? 'selected' : '' ?> >Nam</option>
                <option value="nu" <?php echo $_SESSION['GioiTinh'] == 'Nu' ? 'selected' : '' ?> >Nữ</option>
              </select>
            </div>
            <div class="form-group">
              <label for="SDT">Số Điện Thoại</label>
              <input type="text" class="form-control" id="SDT" name="SDT" value="<?php echo $_SESSION['SDT']?>" readonly>
            </div>
            <input type="button" class="btn btn-primary" id="editInfo" value="Sửa Thông Tin">
            <input type="button" class="btn btn-primary" id="updateInfo" name="update" value="Cập Nhật Thông Tin">
          </form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal -->
  <script src="../script/user.js"></script>
</body>

</html>