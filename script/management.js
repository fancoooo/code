/*Hien thi cac div con trong sidebar*/
function display(n) {
	var cntsection = document.getElementsByClassName("content-section");
	var sideBarAreaContent = document.getElementsByClassName("sidebar-area-content");
	var sideBarArea = document.getElementsByClassName("sidebar-area");
	var sidebarIconCollapse = document.getElementsByClassName("sidebar-area-icon-collapse");
	var sidebarIconExpand = document.getElementsByClassName("sidebar-area-icon-expand");
	for (var i=0;i<sideBarAreaContent.length;i++) {
		sideBarAreaContent[i].style.display="none";
		sidebarIconExpand[i].style.display="none";
		sidebarIconCollapse[i].style.display="block";
	}
	sideBarAreaContent[n].style.display="block";
	sidebarIconExpand[n].style.display="block";
	sidebarIconCollapse[n].style.display="none";
}
/*Hien thi noi dung khi click vao div trong side bar*/
function displayContent(n){
	var cntsection = document.getElementsByClassName("content-section");
	var sideBarAreaChild = document.getElementsByClassName("sidebar-area-child");
	for (var i=0;i<cntsection.length;i++) {
		cntsection[i].style.display="none";
	}
	for (var j=0;j<sideBarAreaChild.length;j++) {
		sideBarAreaChild[j].style.backgroundColor="#575757";
	}
	cntsection[n-1].style.display="block";
	if (n==5) {
		sideBarAreaChild[n].style.backgroundColor="#404040";
	} else {
		sideBarAreaChild[n-1].style.backgroundColor="#404040";
	}
	// document.getElementById("fourth-add-user").style.display="none";
	// document.getElementById("fifth-add-order").style.display="none";
}
function displayContentExtra(n){
	var cntsection = document.getElementsByClassName("content-section");
	var sideBarAreaChild = document.getElementsByClassName("sidebar-area-child");
	var sideBarExtra = document.getElementsByClassName("extra");
	for (var i=0;i<cntsection.length;i++) {
		cntsection[i].style.display="none";
	}
	for (var j=0;j<sideBarAreaChild.length;j++) {
		sideBarAreaChild[j].style.backgroundColor="#575757";
	}
	cntsection[n-1].style.display="block";
	if(n==4) {
		document.getElementById("fourth-add-user").style.display="flex";
		sideBarExtra[0].style.backgroundColor="#404040";
	} else if (n==5) {
		document.getElementById("fifth-add-order").style.display="flex";
		sideBarExtra[1].style.backgroundColor="#404040";
	}
}



/*Hien thi hinh anh	khi add product*/

/* Edit order*/

var editOrderOrigin = document.getElementsByClassName("editorder-origin");
var editOrderPost = document.getElementsByClassName("editorder-post");
for (var i=0;i<editOrderOrigin.length;i++) {
	editOrderOrigin[i].addEventListener("input",function(){
		for (var j=0; j<editOrderOrigin.length;j++) {
			editOrderPost[j].value = editOrderOrigin[j].value;
		}
	});
}