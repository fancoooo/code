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
                $('.list').append(`<div class="content-section-info">
                <div class="title-factor-id">${key}</div>
                <div class="title-factor-name">${response[key][0]}</div>
                <div class="title-factor">${response[key][2]}</div>
                <div class="title-factor">${response[key][1]}</div>
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
                    $(this).parent().parent().remove();
                    $.ajax({
                        type: "GET",
                        url: "../app/productControler.php",
                        data: {
                            action: 'deleteProduct',
                            'id': $(this).parent().parent().children().first().html()
                        },
                        dataType: "text",
                        success: function (response) {
                            alert('Xóa thành công sản phẩm');
                        }
                    });
                }
                
            });
            //end

            //begin update sản phẩm
            $('.update-sp').click(function(){
                var price =  prompt("Cập nhật giá Sản phẩm:",$(this).parent().parent().children().eq(2).text());
                if(confirm("Bạn chắc chắn muốn cập nhật sản phẩm")){
                    $(this).parent().parent().children().eq(2).text(price);
                    $.ajax({
                        type: "GET",
                        url: "../app/productControler.php",
                        data: {
                            action: 'updateProduct',
                            'price': price,
                            'id': $(this).parent().parent().children().first().text()
                        },
                        dataType: "text",
                        success: function (response) {
                            alert('Cập nhật thành công');
                        }
                    });
                }
            });
            //end

            //begin add sản phẩm
            $('.add-sp').click(function(){
                $('#myModal').modal();
            });
            //end
            
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
            //begin render list Order
            for(var key in response){
                $('.order').append(`<div class="content-section-info show-info">
                <div class="title-factor order1">${key}</div>
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
                        // $('.body-content').children().remove();
                        // for(var key in response){
                        //     if(key !== ""){
                        //         $('.body-content').append(`<div class="body-item col-5">${key}</div>
                        //         <div class="body-item col-2">${response[key][0]}</div>
                        //         <div class="body-item col-3">${response[key][2]}</div>
                        //         <div class="body-item col-2">${response[key][0]*response[key][2]}</div>
                        //         </div>`)
                        //     }
                        // }
                        // $('#ModalOrder').modal();
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


});
