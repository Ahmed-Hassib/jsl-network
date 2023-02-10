
// get mega menu button
var mega_menu_btn = document.querySelectorAll(".main-nav > li");

(function () {
    mega_menu_btn.forEach(el => {
        if (el.childElementCount > 1) {
            el.addEventListener("click", (evt) => { 
                el.classList.toggle('active');
            })
        }
    })
})()