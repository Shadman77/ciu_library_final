/**Show / Hide Popup Menu */
function setPopupMenu() {
    var element = document.getElementsByClassName('menu-pop-up');
    for (var i = 0; i < element.length; i++) {
        element[i].style.visibility = 'hidden';
    }
}

if (window.addEventListener) {
    window.addEventListener("load", setPopupMenu, false);
}
else {
    if (window.attachEvent) {
        window.attachEvent("onload", setPopupMenu);
    } else {
        if (window.onLoad) {
            window.onload = setPopupMenu;
        }
    }
}

function togglePopupMenu(id) {
    var elem = document.getElementById(id);
    if (elem.style.visibility === 'hidden') {
        elem.style.visibility = 'visible';
    } else {
        elem.style.visibility = 'hidden';
    }
}
/**Show / Hide Popup Menu */

/**Video autoplay */
/*document.getElementById('vid').play();*/

/*Image Preview*/
function readImageURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview_img')
                .attr('src', e.target.result);
                document.getElementById('preview-figure').style.display = 'block';
                document.getElementById('preview_img').style.display = 'inline-block';
        };

        reader.readAsDataURL(input.files[0]);
    }
}