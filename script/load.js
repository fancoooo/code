var loaded = document.querySelector('.load');
var box = document.querySelector('#main');
var func = () => {
    loaded.style.display = "none";
    box.style.display = "block";
    setTimeout(function () {

        box.style.opacity = 1;
    }, 50);

}
var init = () => {
    setTimeout(func, 3000);
}
init();