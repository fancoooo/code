<?php
    session_start();

    function updateUser($Hoten,$Tuoi,$GioiTinh,$SDT,$image,$id){
        require __DIR__ . '/connect.php';
        $sql = "UPDATE [User] SET HoTen = ? , Tuoi = ? , GioiTinh = ? , SDT = ? , Image = ? WHERE Email = ?";
        $query = sqlsrv_prepare($conn,$sql,array(&$Hoten,&$Tuoi,&$GioiTinh,&$SDT,&$image,&$id));
        if($query == false){
            die( print_r(sqlsrv_errors(), true));
        }else{
            $Hoten = $Hoten;
            $Tuoi = $Tuoi;
            $GioiTinh = $GioiTinh;
            $SDT = $SDT;
            $id = $id;
            $image = $image;
            if(sqlsrv_execute($query) == false){
                die( print_r(sqlsrv_errors(), true));
            }
        }
        sqlsrv_free_stmt($query);
    }
    function createImage(){
        $target_dir = "../img/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
        createImage();
        updateUser($_POST['HoTen'],(int)$_POST['Tuoi'],(binary)$_POST['GioiTinh'],$_POST['SDT'],'../img/'.$_FILES['image']['name'],$_SESSION['name']);
        
        $_SESSION['HoTen'] = $_POST['HoTen'];
        $_SESSION['Tuoi'] = $_POST['Tuoi'];
        $_SESSION['GioiTinh'] = (int)$_POST['GioiTinh'] ? 'Nam' : 'Nu';
        $_SESSION['SDT'] = $_POST['SDT'];
        $_SESSION['Image'] = '../img/' . $_FILES['image']['name'];
    // print_r($_POST);
    // print_r($_FILES);
?>