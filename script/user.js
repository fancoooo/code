$(document).ready(function () {

  var home = document.getElementsByClassName("content-sp-home")[0];
  var trasua = document.getElementsByClassName("content-sp-trasua")[0];
  var sinhto = document.getElementsByClassName("content-sp-sinhto")[0];
  var caphe = document.getElementsByClassName("content-sp-caphe")[0];
  var nuocngot = document.getElementsByClassName("content-sp-nuocngot")[0];

  $.ajax({
    type: "GET",
    url: "../app/loainuoc.php",
    data: {
      action: 'getlistnuoc'
    },
    dataType: "json",
    success: function (response) {
      for(let i=0;i<response.length;i++){
        var str = response[i].split('-');
        $(`.content-sp-home`).append(`<div class='icon-coffee col-4 search' data-id='${str[0]}' data-gia='${str[3]}' title='${str[1]}'><i class='fa fa-coffee add'></i><span class='tien'>${str[3]} VND</span><span class='tennuoc'>${str[1]}</span></div>`);
        $(`.content-sp-${str[2]}`).append(`<div class='icon-coffee col-4 search' data-id='${str[0]}' data-gia='${str[3]}' title='${str[1]}'><i class='fa fa-coffee add'></i><span class='tien'>${str[3]} VND</span><span class='tennuoc'>${str[1]}</span></div>`);
      }
      
    }
  });
  
  function display(n){
      var click = document.getElementsByClassName('content-section');
      for(let i=0;i<2;i++){
        if(i == n){
          click[i].style.display = "block";
        }else{
          click[i].style.display = "none";
        }
      }
  }
  // begin click select content section
  var content = document.getElementsByClassName('sidebar-area-parent');
  content[0].addEventListener('click', function(event){
    event.preventDefault();
    display(0);
  });
  content[1].addEventListener('click', function(event){
    event.preventDefault();
    display(1);
  //end
  // begin click thêm sản phẩm đặt vào bàn
  var ad = $('.add');
  for(let i=0;i<ad.length;i++){
    ad[i].onclick = function(e){
      e.preventDefault();
      $(`.${$('.select').children("option:selected").val()}`).append(`<div class="sp row" data-man="${$(this).parent().attr('data-id')}">
      <div class='col-4'>${$(this).parent().attr('title')}</div>
      <div class='col-3'>${$(this).parent().attr('data-gia')}</div>
      <div class='col-2'><input type="number" min="1" max="10" value="1"></div>
      <div class='col-3'>${$(this).parent().attr('data-gia')}</div></div>`);
      $("input").bind('keyup mouseup', function () {
        var s = this.parentElement.nextElementSibling;
        s.innerHTML = this.parentElement.previousElementSibling.textContent*this.value;
        
      });
    }
  }
  });
  // end

  

  // begin lấy list bàn render ra html
  $.ajax({
    type: "GET",
    url: "../app/banControler.php",
    data: {
      action: 'getListBan'
    },
    dataType: "json",
    success: function (response) {
      var is = true;
      for(var key in response){
        var s= key.split('-');
        $('.select').append(`<option value='${key}'>${key}</option>`);
        $('.content-pay').append(`<div class='content-pay-display ${key} ${is?'isblock':''}'></div>`);
        is = false;
        if(!response.hasOwnProperty(key)) continue;
        else{
          $(`.${s[0]}`).append(`<div class='icon-coffee col-3' data-chongoi='${response[key][0]}' data-mab='${key}'><i class='fa fa-coffee ${response[key][1] ? 'isred':''}'></i><span class='sochongoi'>${response[key][0]}</span><span class='banso'>${s[1]}</span></div>`);
        }
      }
    }
  });
  // end 

  //begin chọn bàn ngồi 
  $('.select').change(function (e) { 
    e.preventDefault();
    var pay_display = document.getElementsByClassName('content-pay-display');
    for(let i=0;i<pay_display.length;i++){
        pay_display[i].classList.remove('isblock');
    }
    document.getElementsByClassName(`${$(this).children("option:selected").val()}`)[0].classList.add('isblock');
  });
  //end

  


  $("#myBtn").click(function () {
    $("#myModal").modal();
  });

  var header = document.getElementsByClassName('header');
  for(let i=0;i<header.length;i++){
    header[i].onclick = function(e){
      for(let j=0;j<header.length;j++){
          header[j].classList.remove('borred');
          document.getElementsByClassName(`content-sp-${header[j].getAttribute('data-man')}`)[0].parentElement.classList.remove('isblock');
      }
      this.classList.add('borred');
      document.getElementsByClassName(`content-sp-${this.getAttribute('data-man')}`)[0].parentElement.classList.add('isblock');
    }
  };
  // begin nút lưu bàn ngồi 
  $('#luu').click(function(){
    var data = $('.select').children("option:selected").val();
    if(!$(`.${data}`).children().length){
      alert('Bàn Trống Không Có Người Ngồi: Yêu Cầu Đợi Khách');
    }else{
      $(`*[data-maB='${data}']`).addClass('isred');
      alert('Lưu Chỗ ngồi thành công');
    }
  });
  //end nút lưu bàn ngồi 


// begin nút hủy đặt bàn
  $('#huy').click(function(){
    if(confirm("Bạn có chắc chắn muốn hủy bàn")){
      var data = $('.select').children("option:selected").val();
      console.log(data);
      if($(`.${data}`).children().length == 0){
        alert('Bàn Trống');
      }else{
        $(`.${data}`).children().remove();
        $(`*[data-mab='${data}']`).removeClass('isred');
        alert('Hủy Thành Công');
      }
    }
  });
// end nút hủy đặt bàn


  // begin nút thanh toán bàn ngồi
  $('#thanhtoan').click(function(){
    var mab = $('.select').children("option:selected").val();
    if(!$(`.${mab}`).children().length){
      alert('Bàn Trống Không Có Người Ngồi: Yêu Cầu Đợi Khách');
    }else{
      var tongtien = 0;
        var soluong = $(`.${mab}`).children();
        var arr = [];
        for(let i=0;i<soluong.length;i++){
          tongtien += parseInt($(soluong[i]).children().last().html());
          arr.push(new Array($(soluong[i]).attr('data-man'),$(soluong[i]).find('input').val()));
        }
        alert("tổng tiền Cần thanh toán là " + tongtien); 
      var t = confirm("bạn có muốn thanh toán ko");
      if(t){
        // json post lên server php
        var json = {
          'mab': mab,
          'tongtien':tongtien,
          'man': arr,
          'time': new Date()
        }
        $.ajax({
          type: "POST",
          url: "../app/datban.php",
          data: {
            action: json
          },
          dataType: "text",
          success: function (response) {
            $.ajax({
              url: '../app/PDF.php',
              type: 'POST',
              contentType: "application/json; charset=utf-8",
              data: {},
              processData: false,
              dataType: 'html',    
              async: false,
              success: function(html) {
                  //window.location.href = '../PDF/file.pdf';      
              }
          });
          }
        });
        $(`.${mab}`).children().remove();
        $(`*[data-mab='${mab}']`).removeClass('isred');
      
      }
    }
  })
  //end nút thanh toán

  //begin search sản phẩm 
  $('#search-sp').keyup(function(){
    var sp = document.getElementsByClassName('search');
    for(let i=0;i<sp.length;i++){
      if(sp[i].getAttribute('title').toLowerCase().search(this.value.toLowerCase()) == -1){
        sp[i].classList.add('isnone');
      }else{
        sp[i].classList.remove('isnone');
      }
    }
    
  });
  //end

  //begin modal info
  $('#info').click(function(){
    console.log('hello');
    $('#myModalInfo').modal();
  });

  $('#editInfo').click(function(){
    var Hoten = document.getElementById('HoTen');
    var Tuoi = document.getElementById('Tuoi');
    var GioiTinh = document.getElementById('GioiTinh');
    var SDT = document.getElementById('SDT');
    $(Hoten).removeAttr('readonly');
    $(Tuoi).removeAttr('readonly');
    $(GioiTinh).removeAttr('disabled');
    $(SDT).removeAttr('readonly');
    $('#d').attr('style','display:block');
  });

  $("#d").click(function(){
    var img = document.getElementById('image');
    $(img).click();
  });

  $('#updateInfo').click(function(e){
      e.preventDefault();
      var Hoten = document.getElementById('HoTen');
      var Tuoi = document.getElementById('Tuoi');
      var GioiTinh = document.getElementById('GioiTinh');
      var SDT = document.getElementById('SDT');
      var dataImage = new FormData();
      var img = document.getElementById('image');
      dataImage.append('image',img.files[0]);
      dataImage.append('HoTen',Hoten.value);
      dataImage.append('Tuoi',Tuoi.value);
      dataImage.append('GioiTinh',GioiTinh.value == 'nam' ? 1 : 0);
      dataImage.append('SDT',SDT.value);
      //var img = document.getElementById('image');
      //dataImage.append('ImageUser',img.files[0]);
      $.ajax({
        type: "POST",
        url: "../app/UserControler.php",
        data: dataImage,
        contentType: false,
        processData: false,
        dataType: "text",
        success: function (response) {
          window.location.href = window.location.pathname + window.location.search + window.location.hash + "#";
          alert("Cập Nhật Thành Công");
          $('button[data-dismiss="modal"]').click();
        }
    })
  });
});

function changeFile(files){
  const textToBLOB = new Blob(files, { type: 'image/plain' });
  $('#img').attr('src',window.URL.createObjectURL(textToBLOB));
  //$('#d').attr('style','display:none');
}