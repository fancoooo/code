function collapsed() {
	var x=document.getElementById("nav-id");
	if(x.className==="nav-ul") {
		x.className+="responsive";
	}
	else {x.className="nav-ul";}
}

function collapsedSearchFilter() {
	var x=document.getElementById("filter-bar");
	if(x.className==="product-filter") {
		x.className+="responsive";
	}
	else {x.className="product-filter";}
}

function collapsedManagement() {
	var x=document.getElementById("sidebar");
	var y=document.getElementById("content");
	if(x.className==="classsidebar") {
		x.className+="responsive";
		y.className+="responsive";
	}
	else {
		x.className="classsidebar";
		y.className="classcontent";
	}
}