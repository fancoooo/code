$(document).ready(function(){


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
            }

            // begin delete sản phẩm
            $('.delete-sp').click(function (){
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
                
            });
            //end

            //begin update sản phẩm
            $('.update-sp').click(function(){
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
                    
            });
            //end

            //begin modal add sản phẩm
            $('.add-sp').click(function(){
                $('#myModal').modal();
            });
            //end
            //begin modal add danh mục
            $('.add-category').click(function(){
                $('#Modaldm').modal();
            });
            //end
            $('.delete-category').click(function (){
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
            });

            
            
          }
      });

      

      $.ajax({
        type: "GET",
        url: "../app/orderControler.php",
        data: {
          action: 'getListOder'
        },
        dataType: "json",
        success: function (response) {
            console.log(response);
            //begin render list Order
            for(var key in response){
                $('.order').append(`<div class="content-section-info show-info" data-orderid="${key}">
                <div class="title-factor order1">${response[key][3]}</div>
                <div class="title-factor order2">${response[key][0]}</div>
                <div class="title-factor order3">${response[key][1]} VND</div>
                <div class="title-factor order4">${response[key][2]['date'].substring(0,response[key][2]['date'].length-7)}</div>
            </div>`);
            }//end

            //begin show chi tiet hóa đơn
            $('.show-info').click(function(){
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
                        console.log(response);
                        $('.body-content').children().remove();
                        for(var key in response){
                            if(key !== ""){
                                $('.body-content').append(`<div class="body-item col-5">${key}</div>
                                <div class="body-item col-2">${response[key][0]}</div>
                                <div class="body-item col-3">${response[key][2]}</div>
                                <div class="body-item col-2">${response[key][0]*response[key][2]}</div>
                                </div>`)
                            }
                        }
                        $('#ModalOrder').modal();
                    }
                });
            });
            //end
            
          }
      });

      

      $('#submit-btn-addproduct-input').click(function(){
            var id = $('#id').val();
            var name = $("#name").val();
            var price = $("#price").val();
            var category = $("#ap-cat-input").val();
            var json = {
                'id': id,
                'name': name,
                'price':price,
                'category':category
            }
            $.ajax({
                type: "POST",
                url: "../app/update.php",
                data: {
                    action: json
                },
                dataType: "text",
                success: function (response) {
                    console.log(response);
                }
            });
      });

      $('#submit-update-product-btn').click(function(){
        var id = $('#a').val();
        var name = $("#b").val();
        var price = $("#c").val();
        var category = $("#d").val();
        var json = {
            'id': id,
            'name': name,
            'price':price,
            'category':category
        }
        $.ajax({
            type: "POST",
            url: "../app/insert.php",
            data: {
                action: json
            },
            dataType: "text",
            success: function (response) {
                console.log(response);
            }
        });
        
  });

// begin add sản phẩm
$('#addsp').click(function(){
    var namesp = $('#namesp').val();
    var price = $('#price').val();
    var loaisp = $('#loaisp').children('option:selected');
    if(namesp.trim() == '' || price.trim() == '' || loaisp.val().trim() == ''){
        alert('Thông tin điền thiếu');
        return ;
    }else{
        $.ajax({
            type: "GET",
            url: "../app/loainuoc.php",
            data: {
                action: 'addsp',
                tensp: namesp,
                loaisp: loaisp.val(),
                gia: price
            },
            dataType: "text",
            success: function (response) {
                if(response.trim() == 'done'){
                    $('#myModal').modal('hide');
                    $('.list').append(`<div class="content-section-info">
                    <div class="title-factor-name">${namesp}</div>
                    <div class="title-factor">${price}</div>
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
});
//end

const getdanhmuc = () => {
    $.ajax({
        type: "GET",
        url: "../app/loainuoc.php",
        data: {
            action: 'getdanhmuc'
        },
        dataType: "json",
        success: function (response) {
            for(var key in response){
                $('#loaisp').append(`<option value="${key}" >${response[key][0].toUpperCase()}</option>`);
                $('.category').append(`<div class="content-section-info" data-category="${key}">
    <div class="title-factor-name">${key}</div>
    <div class="title-factor">${response[key][0].toUpperCase()}</div>
    <div class="title-factor-icon">
        <button type="button" class="delete-category"><i class="fa fa-trash"></i></button>
        <button type="button" class="add-category"><i class="fa fa-plus-square"></i></button>
    </div>
    </div>`);
                
            }
        }
    });
}

getdanhmuc();

// begin add sản phẩm
$('#adddm').click(function(){
    var codedm = $('#codedm').val();
    var namedm = $('#namedm').val();
    if(codedm.trim() == '' || namedm.trim() == ''){
        alert('Thông tin điền thiếu');
        return ;
    }else{
        $.ajax({
            type: "GET",
            url: "../app/loainuoc.php",
            data: {
                action: 'adddm',
                codedm: codedm,
                namedm: namedm
            },
            dataType: "text",
            success: function (response) {
                if(response.trim() == 'done'){
                    $('#Modaldm').modal('hide');
                    $('.category').append(`<div class="content-section-info">
                    <div class="title-factor-name">${codedm}</div>
                    <div class="title-factor">${namedm}</div>
                    <div class="title-factor-icon">
                        <button type="button" class="update-category"><i class="fa fa-edit"></i></button>
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
});
//end

    

    
});
