/**Temporarily closing this script */
function loadWholePage(page) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //document.body.innerHTML = this.responseText;
            console.log(page);
            //document.open();//works without this
            document.write(this.responseText);
            document.close();
            //worked the last time :P
            console.log(document.title);
        }
    };
    xhttp.open("POST", page, true);
    xhttp.send();
}


function linkAjax(tagName) {
    //var elements = document.getElementsByClassName(className);
    var elements = document.getElementsByTagName(tagName);
    for (var i = 0, length = elements.length; i < length; i++) {
        var element = elements[i];
        element.addEventListener('click', function (event) {
            event.preventDefault();
            var href = this.getAttribute('href');
            console.log(href);
            loadWholePage(href);
        }, true);
    };
}

//linkAjax('nav-link');
//linkAjax('menu-card');
linkAjax('a');


/**Form */
window.addEventListener("load", function () {
    function sendData(form, url) {
        var XHR = new XMLHttpRequest();

        // Bind the FormData object and the form element
        var FD = new FormData(form);

        // Define what happens on successful data submission
        XHR.addEventListener("load", function (event) {
            document.write(event.target.responseText);
            document.close();
            /**Need to add scroll to top here */
        });

        // Define what happens in case of error
        XHR.addEventListener("error", function (event) {
            alert('Oops! Something went wrong.');
        });

        // Set up our request
        XHR.open("POST", url);

        // The data sent is what the user provided in the form
        XHR.send(FD);
    }

    // Access the form element...
    var formSignIn = document.getElementById("sign_in_form");
    var formSignUp = document.getElementById("sign_up_form");
    var adminFormSignUp = document.getElementById("admin_sign_up_form");
    var adminFormSignIn = document.getElementById("admin_sign_in_form");
    console.log("After formSignUp")

    // ...and take over its submit event.
    if (formSignIn) {
        formSignIn.addEventListener("submit", function (event) {
            event.preventDefault();

            sendData(formSignIn, "sign_in.php");
        });
    }
    if (formSignUp) {
        formSignUp.addEventListener("submit", function (event) {
            event.preventDefault();

            sendData(formSignUp, "sign_up.php");
        });
    }
    if (adminFormSignUp) {
        formSignUp.addEventListener("submit", function (event) {
            event.preventDefault();

            sendData(formSignUp, "admin_sign_up.php");
        });
    }
    if (adminFormSignIn) {
        formSignUp.addEventListener("submit", function (event) {
            event.preventDefault();

            sendData(formSignUp, "admin_sign_in.php");
        });
    }
});


