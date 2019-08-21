/*https://github.com/Shadman77, https://github.com/Shadman77/HTML-Card-Slider*/
/*
MIT License

Copyright (c) 2018 Shadman Saif Anonno

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

window.onload = function () {

    /*Test via a getter in the options object to see if the passive property is accessed*/
    var supportsPassive = false;
    try {
        var opts = Object.defineProperty({}, 'passive', {
            get: function () {
                supportsPassive = true;
            }
        });
        window.addEventListener("testPassive", null, opts);
        window.removeEventListener("testPassive", null, opts);
    } catch (e) { }



    var pressed = false,
        scrollingAmount = 0;
    var previousTime, timeDifference, timeIntervalMomentumScroll;
    var pixelsDifference, currentScrollObj;
    var previousPosition;
    var containers = document.getElementsByClassName('tileSliderContainer');
    var leftButtons = document.getElementsByClassName('leftArrowButton');
    var rightButtons = document.getElementsByClassName('rightArrowButton');




    /*Adding event listeners*/
    for (var i = 0; i < containers.length; i++) {
        containers[i].addEventListener('mousedown', startSliding, supportsPassive ? { passive: true } : false);
        containers[i].addEventListener('touchstart', startSliding, supportsPassive ? { passive: true } : false);
        containers[i].addEventListener('mousemove', sliding, supportsPassive ? { passive: true } : false);
        containers[i].addEventListener('touchmove', sliding, supportsPassive ? { passive: true } : false);
        containers[i].addEventListener('mouseup', endSliding, supportsPassive ? { passive: true } : false);
        containers[i].addEventListener('touchend', endSliding, supportsPassive ? { passive: true } : false);
    }

    for (var i = 0; i < rightButtons.length; i++) {
        rightButtons[i].addEventListener('click', rightButtonScroll);
    }

    for (var i = 0; i < leftButtons.length; i++) {
        leftButtons[i].addEventListener('click', leftButtonScroll);
    }

    window.addEventListener("resize", getAmountToScroll);




    /*Getting the amount we need to scroll using the buttons*/
    function getAmountToScroll() {
        /*
        There must be at-least two tiles/cards in the first container for this to work.
        We calculate the amount by getting the difference of the first two tiles's horizontal start position.
        Here use the class that is used to style the cards/tiles or else there may be an error
        */
        var x = document.getElementsByClassName('card')[1].offsetLeft - document.getElementsByClassName('card')[0].offsetLeft;
        var y = Math.floor((document.body.clientWidth - document.getElementsByClassName('card')[0].offsetLeft) / x);
        scrollingAmount = x * y;
    }

    getAmountToScroll();


    /*When the user pressed down the mouse button or when touch was initiated*/
    function startSliding(event) {
        /*If the sliding sequence already did not start*/
        if (!pressed) {

            /*To end the momentum scrolling function if it has already not ended*/
            clearInterval(timeIntervalMomentumScroll);

            pixelsDifference = 0;

            /*Getting the current time in milliseconds*/
            var date = new Date();
            previousTime = date.getTime();

            /*To prevent smooth scrolling*/
            event.currentTarget.style.scrollBehavior = "";

            /*Prevent Element Dragging*/
            window.ondragstart = function () { return false; };

            /*If it is a touch event instead of a mouse event*/
            if (event.type == 'touchstart')
                event = event.touches[0];

            /*Getting start of slide position*/
            previousPosition = event.clientX;

            /*The sliding sequence has started*/
            pressed = true;
        }
    }

    /*While the mouse button is pressed down or touch is continuing*/
    function sliding(event) {
        /*If the sliding sequence already started*/
        if (pressed) {

            /*Getting the current time in milliseconds*/
            var date = new Date();
            var timeMs = date.getTime();

            var event2 = event;

            /*If it is a touch event instead of a mouse event*/
            if (event.type == 'touchmove')
                event2 = event.touches[0];

            /*Scrolling the required amount*/
            event.currentTarget.scrollLeft = event.currentTarget.scrollLeft + previousPosition - event2.clientX;

            /*Calculating the difference between the current and previous cursor/touch position*/
            if (event2.clientX != previousPosition) {
                timeDifference = timeMs - previousTime;
                pixelsDifference = event2.clientX - previousPosition;
            }

            /*Storing the current cursor position and current time*/
            previousPosition = event2.clientX;
            previousTime = timeMs;
        }
    }

    /*When the mouse button is released down or touch is discontinued*/
    function endSliding(event) {

        /*Setting draggable to true since we are done sliding */
        window.ondragstart = function () { return true; };

        /*Sliding sequence ended*/
        pressed = false;

        /*We get 16ms from the equation floor function of 1000ms/desired frame rate(60)*/
        /*If there are performance issues related to the momentumScroll function then reducing the frame rate to 30 may help*/
        /*If that does not work then deleting all the code from the next line to the end of this function will help, but there won't be any inertial/momentum scrolling effect
        */

        /*Storing the event generating object*/
        currentScrollObj = event.currentTarget;

        /*Calculating the required pixel difference for the given time interval of 16ms(60 frames per sec)*/
        pixelsDifference = Math.floor(pixelsDifference / timeDifference * 16); //so that pixelDifference is an integer

        /*Setting the momentumScroll function to run at the given time intervals*/
        timeIntervalMomentumScroll = setInterval(momentumScroll, 16);

    }

    /*To allow inertial/momentum scroll effect*/
    function momentumScroll() {
        /*Determining the scroll distance for the current iteration*/
        /*The constant 0.88 determines the rate at which the speed slows down*/
        pixelsDifference *= 0.88;

        /*Check if the scroll distance has reduced to 0 or below*/
        if (pixelsDifference < 1 && pixelsDifference > -1) {
            clearInterval(timeIntervalMomentumScroll);
        } else {
            /*Applying the required scroll to the required container*/
            currentScrollObj.scrollLeft -= pixelsDifference;
        }
    }

    /*When the right arrow button is pressed*/
    function rightButtonScroll(event) {
        /**Clearing previous time intervals to prevent malfunction */
        clearInterval(scrollUtilTimer);

        /*To end the momentum scrolling function if it has already not ended*/
        clearInterval(timeIntervalMomentumScroll);

        var currentScrollAmount, previousScrollAmount = 0;

        /*Getting the required container*/
        var element = event.currentTarget.previousElementSibling;

        /**If IE or Edge */
        if (navigator.userAgent.indexOf('MSIE') !== -1
            || navigator.appVersion.indexOf('Trident/') > -1 || navigator.userAgent.indexOf('Edge') >= 0) {

            scrollUtilTimer = setInterval(function () {

                //Amount to scroll substracted by the amount that is already scrolled
                /**Horizontal scroll distance, vertical scroll distance DOM object, horizontal scroll direction, vertical scroll direction */
                currentScrollAmount = (Math.floor(element.scrollLeft / scrollingAmount) + 1) * scrollingAmount - element.scrollLeft;

                //If we reached full scroll
                if (currentScrollAmount == previousScrollAmount) {
                    clearInterval(scrollUtilTimer);
                }

                scrollUtil(currentScrollAmount, 0, element, 1, 1);

                /**Storing the privious scroll amount */
                previousScrollAmount = currentScrollAmount;
            }, 16);

        } else {//if other browsers

            /*To allow smooth scrolling when button pressed*/
            element.style.scrollBehavior = "smooth";

            /*Scrolling the required amount*/
            element.scrollLeft = (Math.floor(element.scrollLeft / scrollingAmount) + 1) * scrollingAmount;
        }
    }

    /*When the right arrow button is pressed*/
    function leftButtonScroll(event) {
        /**Clearing previous time intervals to prevent malfunction */
        clearInterval(scrollUtilTimer);

        /*To end the momentum scrolling function if it has already not ended*/
        clearInterval(timeIntervalMomentumScroll);

        /*Getting the required container*/
        var element = event.currentTarget.nextElementSibling;

        var currentScrollAmount, previousScrollAmount = 0;

        /**If scrolled amount is a multiple of the required scrolling amount */
        if (element.scrollLeft % scrollingAmount == 0) {
            if (navigator.userAgent.indexOf('MSIE') !== -1
                || navigator.appVersion.indexOf('Trident/') > -1 || navigator.userAgent.indexOf('Edge') >= 0) {

                scrollUtilTimer = setInterval(function () {

                    /**Calculating the required scroll amount */
                    if (element.scrollLeft <= scrollingAmount)
                        currentScrollAmount = element.scrollLeft;
                    else
                        currentScrollAmount = element.scrollLeft - scrollingAmount;

                    //If we reached full scroll
                    if (currentScrollAmount == previousScrollAmount) {
                        clearInterval(scrollUtilTimer);
                    }

                    /**Horizontal scroll distance, vertical scroll distance DOM object, horizontal scroll direction, vertical scroll direction */
                    scrollUtil(currentScrollAmount, 0, element, -1, 1);

                    /**Storing the previous scrolling amount */
                    previousScrollAmount = currentScrollAmount;
                }, 16);
            }
            else {
                /*To allow smooth scrolling when button pressed*/
                element.style.scrollBehavior = "smooth";

                /**Scroll required amount */
                element.scrollLeft -= scrollingAmount;
            }
        }
        else {
            /**If IE or Edge */
            if (navigator.userAgent.indexOf('MSIE') !== -1
                || navigator.appVersion.indexOf('Trident/') > -1 || navigator.userAgent.indexOf('Edge') >= 0) {

                scrollUtilTimer = setInterval(function () {

                    //Amount to scroll substracted by the amount that is already scrolled
                    /**Horizontal scroll distance, vertical scroll distance DOM object, horizontal scroll direction, vertical scroll direction */
                    currentScrollAmount = element.scrollLeft - (Math.floor(element.scrollLeft / scrollingAmount) * scrollingAmount);

                    //If we reached full scroll
                    if (currentScrollAmount == previousScrollAmount) {
                        clearInterval(scrollUtilTimer);
                    }

                    scrollUtil(currentScrollAmount, 0, element, -1, 1);
                    
                    /**Storing the previous scroll amount */
                    previousScrollAmount = currentScrollAmount;
                }, 16);
            }
            else {
                /*To allow smooth scrolling when button pressed*/
                element.style.scrollBehavior = "smooth";

                /**Scroll required amount */
                element.scrollLeft = Math.floor(element.scrollLeft / scrollingAmount) * scrollingAmount;
            }

        }

    }
};

var scrollUtilTimer;//Variable for time intervals for the scrollUtil function

/**x = horizontal scroll amount, y is for vertical, obj = object that needs scrolling, xdir, ydir = 1 for positive direction and -1 for negative direction*/
function scrollUtil(x, y, obj, xDir, yDir) {

    /**So that smooth scrolling works in Internet explorer as well*/
    var xmod = x % 20;
    var ymod = y % 20;
    if (x > xmod && y > ymod) {
        obj.scrollTop = obj.scrollTop + 20 * yDir;
        obj.scrollLeft = obj.scrollLeft + 20 * xDir;
        x = x - 20;
        y = y - 20;
    }
    else if (x > xmod) {
        obj.scrollLeft = obj.scrollLeft + 20 * xDir;
        x = x - 20;
    }
    else if (y > ymod) {
        obj.scrollTop = obj.scrollTop + 20 * yDir;
        y = y - 20;
    }
    else {
        obj.scrollTop = obj.scrollTop + ymod * yDir;
        obj.scrollLeft = obj.scrollLeft + xmod * xDir;
        clearInterval(scrollUtilTimer);
    }
}