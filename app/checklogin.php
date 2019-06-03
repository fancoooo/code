<?php
    session_start();
    require __DIR__ . '/connect.php';

    $email =  $_POST['email'] ;
    $pass =  $_POST['pass'] ;
    $sql = "EXEC dbo.[check_login] @email = ?";
    $procedure_params = array($email);
    $stmt = sqlsrv_query( $conn, $sql, $procedure_params);
    if($stmt) {
        $true = sqlsrv_has_rows($stmt);
        if($true){
            $row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
            $pass1 = $row["Password"];
            if($pass1 == $pass){
                $pq = $row["PhanQuyen"];    
                if($pq == 1){
                    echo ("user");
                    $_SESSION['user'] = 'user';
                }else{
                    echo ("admin");
                    $_SESSION['user'] = 'admin';
                }
                $_SESSION['name'] = $row["Email"];
                $_SESSION['HoTen'] = $row["HoTen"];
                $_SESSION['Tuoi'] = $row["Tuoi"];
                $_SESSION['GioiTinh'] = $row["GioiTinh"] ? 'Nam' : 'Nu';
                $_SESSION['SDT'] = $row["SDT"];
                $_SESSION['Image'] = $row["Image"];
            }
        }else{
            echo 'Fail';
            sqlsrv_free_stmt( $stmt);
        }
    }else{
        echo 'hi';
    }


    // while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
    //     if($email == $row['Email'] && $pass == $row['Password']){
    //         $flag = true;
    //         if($row['PhanQuyen'] == 1){
    //             echo ("user");
    //             $_SESSION['user'] = 'user';
    //         }else{
    //             echo ("admin");
    //             $_SESSION['user'] = 'admin';
    //         }
    //             $_SESSION['name'] = $row['Email'];
    //             $_SESSION['HoTen'] = $row['HoTen'];
    //             $_SESSION['Tuoi'] = $row['Tuoi'];
    //             $_SESSION['GioiTinh'] = $row['GioiTinh'] ? 'Nam' : 'Nu';
    //             $_SESSION['SDT'] = $row['SDT'];
    //             $_SESSION['Image'] = $row['Image'];
    //         break; 
    //     }
    // }
    

?>