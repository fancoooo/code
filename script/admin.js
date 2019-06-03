$(document).ready(function(){


    var inputvalue = {
        codedm : $('#codedm'),        
        namedm : $('#namedm'),
        namesp : $('#namesp'),
        price : $('#price')
    }

    //begin a1
    $.ajax({
        type: "GET",
        url: "../app/productControler.php",
        data: {
          action: 'getListProduct'
        },
        dataType: "json",
        success: function (response) {
            // begin render list sản phẩm 
            for(var key in response){
                $('.list').append(`<div class="content-section-info" data-id="${key}">
                <div class="title-factor-name">${response[key][0]}</div>
                <div class="title-factor">${response[key][2]}</div>
                <div class="title-factor">${response[key][1].toUpperCase()}</div>
                <div class="title-factor-icon">
                    <button type="button" class="update-sp"><i class="fa fa-edit"></i></button>
                    <button type="button" class="delete-sp"><i class="fa fa-trash"></i></button>
                    <button type="button" class="add-sp"><i class="fa fa-plus-square"></i></button>
                </div>
            </div>`);
            }//end 
        }
    });//end a1

    // begin get danh mục
    const getdanhmuc = () => {
        $.ajax({
            type: "GET",
            url: "../app/loainuoc.php",
            data: {
                action: 'getdanhmuc'
            },
            dataType: "json",
            success: function (response) {
                let str1 = '';
                let str2 = '';
                for(let key in response){
                    str1 += `<option value="${key}" >${response[key][0].toUpperCase()}</option>`;
                    str2 += `<div class="content-section-info" data-category="${key}">
                    <div class="title-factor-name">${key}</div>
                    <div class="title-factor">${response[key][0].toUpperCase()}</div>
                    <div class="title-factor-icon">
                    <button type="button" class="delete-category"><i class="fa fa-trash"></i></button>
                    <button type="button" class="add-category"><i class="fa fa-plus-square"></i></button>
                    </div>
                    </div>`;
                }
                $('#loaisp').html(str1);
                $('.category').html(str2);
            }
        });
    }// end

    // begin get list mua hàng
    $.ajax({
        type: "GET",
        url: "../app/orderControler.php",
        data: {
          action: 'getListOder'
        },
        dataType: "json",
        success: function (response) {
            let str = '';
            //begin render list Order
            for(var key in response){
                str += `<div class="content-section-info show-info" data-orderid="${key}">
                <div class="title-factor order1">${response[key][3]}</div>
                <div class="title-factor order2">${response[key][0]}</div>
                <div class="title-factor order3">${response[key][1]} VND</div>
                <div class="title-factor order4">${response[key][2]['date'].substring(0,response[key][2]['date'].length-7)}</div>
            </div>`;
            }//end
            $('.order').html(str);
        }
    });//end

    // action
    getdanhmuc();

    // begin delete sản phẩm
    $(document).on('click','.delete-sp',function (){
        if(confirm("Bạn có chắc chắn muốn xóa sản phẩm")){
            var remove = $(this);
            $.ajax({
                type: "GET",
                url: "../app/productControler.php",
                data: {
                    action: 'deleteProduct',
                    'id': $(this).parent().parent().attr('data-id')
                },
                dataType: "text",
                success: function (response) {
                    if(response.trim() != 'none'){
                        remove.parent().parent().remove();
                        alert('Xóa thành công sản phẩm');
                    }else{
                        alert('Hệ thống lỗi : đợi fix');
                    }
                    
                }
            });
        }
    });//end

    //begin update sản phẩm
    $(document).on('click','.update-sp',function(){
        var price =  prompt("Cập nhật giá Sản phẩm:",$(this).parent().parent().children().eq(1).text());
        var id = $(this);
        if(price){
            $.ajax({
                type: "GET",
                url: "../app/productControler.php",
                data: {
                    action: 'updateProduct',
                    'price': price,
                    'id': id.parent().parent().attr('data-id')
                },
                dataType: "text",
                success: function (response) {
                    id.parent().parent().children().eq(1).text(price);
                    alert('Cập nhật thành công');
                }
            });
        }
    });//end

    //begin xóa danh mục
    $(document).on('click','.delete-category',function (){
        if(confirm("Bạn có chắc chắn muốn xóa danh mục")){
            var remove = $(this);
            $.ajax({
                type: "GET",
                url: "../app/loainuoc.php",
                data: {
                    action: 'deleteCategory',
                    'id': $(this).parent().parent().attr('data-category')
                },
                dataType: "text",
                success: function (response) {
                    if(response.trim() != 'none'){
                        remove.parent().parent().remove();
                        alert('Xóa thành công danh mục');
                    }else{
                        alert('Hệ thống lỗi : đợi fix');
                    }
                    
                }
            });
        }
    });// end 

    //begin modal add sản phẩm
    $(document).on('click','.add-sp',function(){
        $('#myModal').modal();
    });//end

    //begin modal add danh mục
    $(document).on('click','.add-category',function(){
        $('#Modaldm').modal();
    });//end

    

    //begin show chi tiet hóa đơn
    $(document).on('click','.show-info',function(){
        var id = $(this).children().eq(1).text();
        $.ajax({
            type: "GET",
            url: "../app/orderControler.php",
            data: {
                action: 'showOrder',
                id: id
            },
            dataType: "json",
            success: function (response) {
                let str = '';
                $('.body-content').children().remove();
                for(let key in response){
                    if(key !== ""){
                        str += `<div class="body-item col-5">${key}</div>
                        <div class="body-item col-2">${response[key][0]}</div>
                        <div class="body-item col-3">${response[key][2]}</div>
                        <div class="body-item col-2">${response[key][0]*response[key][2]}</div>
                        </div>`;
                    }
                }
                $('.body-content').html(str);
                $('#ModalOrder').modal();
            }
        });
    });//end 


// begin add sản phẩm
    $(document).on('click','#addsp',function(){
        var loaisp = $('#loaisp').children('option:selected');
        if(inputvalue.namesp.val().trim() == '' || inputvalue.price.val().trim() == '' || loaisp.val().trim() == ''){
            alert('Thông tin điền thiếu');
            return ;
        }else{
            $.ajax({
                type: "GET",
                url: "../app/loainuoc.php",
                data: {
                    action: 'addsp',
                    tensp: inputvalue.namesp.val(),
                    loaisp: loaisp.val(),
                    gia: inputvalue.price.val()
                },
                dataType: "text",
                success: function (response) {
                    if(response.trim() == 'done'){
                        $('#myModal').modal('hide');
                        $('.list').append(`<div class="content-section-info">
                        <div class="title-factor-name">${inputvalue.namesp.val()}</div>
                        <div class="title-factor">${inputvalue.price.val()}</div>
                        <div class="title-factor">${loaisp.html()}</div>
                        <div class="title-factor-icon">
                            <button type="button" class="update-sp"><i class="fa fa-edit"></i></button>
                            <button type="button" class="delete-sp"><i class="fa fa-trash"></i></button>
                            <button type="button" class="add-sp"><i class="fa fa-plus-square"></i></button>
                        </div>
                    </div>`);
                    alert("Thêm thành công");
                    }else{
                        alert('Lỗi');
                    }
                }
            });
        }
    });//end

    

    // begin add danh mục 
    $('#adddm').click(function(){
        if(inputvalue.codedm.val().trim() == '' || inputvalue.namedm.val().trim() == ''){
            alert('Thông tin điền thiếu');
            return ;
        }else{
            $.ajax({
                type: "GET",
                url: "../app/loainuoc.php",
                data: {
                    action: 'adddm',
                    codedm: inputvalue.codedm.val(),
                    namedm: inputvalue.namedm.val()
                },
                dataType: "text",
                success: function (response) {
                    if(response.trim() == 'done'){
                        $('#Modaldm').modal('hide');
                        $('.category').append(`<div class="content-section-info" data-category="${inputvalue.codedm.val()}">
                        <div class="title-factor-name">${inputvalue.codedm.val()}</div>
                        <div class="title-factor">${inputvalue.namedm.val()}</div>
                        <div class="title-factor-icon">
                            <button type="button" class="delete-category"><i class="fa fa-trash"></i></button>
                            <button type="button" class="add-category"><i class="fa fa-plus-square"></i></button>
                        </div>
                    </div>`);
                    alert("Thêm thành công");
                    }else{
                        alert('Lỗi');
                    }
                }
            });
        }
    });//end
});//end document