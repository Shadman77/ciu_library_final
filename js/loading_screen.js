function hideLoadingScreen() {
    document.getElementById('loading_screen').style.display = 'none';
    document.body.style.overflowY = "scroll";
}

if (window.addEventListener) {
    window.addEventListener("load", hideLoadingScreen, false);
}
else {
    if (window.attachEvent) {
        window.attachEvent("onload", hideLoadingScreen);
    } else {
        if (window.onLoad) {
            window.onload = hideLoadingScreen;
        }
    }
}