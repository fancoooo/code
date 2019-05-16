<?php
    session_start();
    function khid(){
        require __DIR__ . '/connect.php';
        $sql = "SELECT TOP 1 * FROM [KhachHang] ORDER BY MaKH DESC";
        $stmt = sqlsrv_query( $conn, $sql );
        $kq = null;
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }
        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            $kq = $row['MaKH'];
        }
        return $kq;
        sqlsrv_free_stmt( $stmt);
    }
    function postkh($s){
        require __DIR__ . '/connect.php';
        $sql = "INSERT INTO [KhachHang](SoNguoi) VAlUES($s)";
        $stmt = sqlsrv_query( $conn, $sql );
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        $ex = sqlsrv_execute($stmt);
        sqlsrv_free_stmt( $stmt);
        
    }
    function postchon($id,$s){
        require __DIR__ . '/connect.php';  
        $sql = "INSERT INTO [Chon] VALUES(?,?,?)";
        $stmt = sqlsrv_prepare($conn,$sql,array(&$id,&$mn,&$sl));
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }else{
            foreach ($s as $key) {
                $id = $id;
                $mn = $key[0];
                $sl = $key[1];
                if(sqlsrv_execute($stmt) == false){
                    die(print_r(sqlsrv_errors(),true));
                }
            }
        }
        sqlsrv_free_stmt( $stmt);
    }
        
        
    function postngoi($id,$s){
        require __DIR__ . '/connect.php';
        $sql = "INSERT INTO Coffee.dbo.[Ngoi] VALUES(?,?)";
        $stmt = sqlsrv_prepare($conn,$sql,array(&$id,&$s));
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }else{
            $id = $id;
            $s = $s;
            if(sqlsrv_execute($stmt) == false){
                die(print_r(sqlsrv_errors(),true));
            }
            sqlsrv_free_stmt( $stmt);
        }
    }
        
    function postphieu($id,$s,$t){
        require __DIR__ . '/connect.php';
        $arr = array();
        $sql = "INSERT INTO [PhieuThu](MaKH,Email,TongTien,NgayLap) VALUES(?,?,?,?)";
        $stmt = sqlsrv_prepare($conn,$sql,array(&$id,&$_SESSION['name'],&$s,&$t));
        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }else{
            $id = $id;
            $s = $s;
            $t = $t;
            if(sqlsrv_execute($stmt) == false){
                die(print_r(sqlsrv_errors(),true));
            }
        }
        sqlsrv_free_stmt( $stmt);
    }

    postkh(4);


    if(isset($_POST['action']) && !empty($_POST['action'])){
        $id = khid();
        
        postchon($id,$_POST['action']['man']);
        postngoi($id,$_POST['action']['mab']);
        postphieu($id,(int)$_POST['action']['tongtien'],new DateTime('now',new DateTimeZone('Asia/Ho_Chi_Minh')));
    }else{
        echo json_encode("hello");
    }

    
?>