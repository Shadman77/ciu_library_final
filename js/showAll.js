function viewAll(id, bgcolor) {
    /**Getting all sections */
    var sections = document.getElementsByClassName('book-section');

    /**hiding all sections initially */
    for (var i = 0; i < sections.length; i++) {
        sections[i].style.display = 'none';
    }
    id += 'ViewAll';


    /**Checking if the background color needs to be changed */
    if (bgcolor != "") {
        document.body.style.backgroundColor = bgcolor;
    }

    /**Showing the required section after hiding all the others */
    document.getElementById(id).style.display = 'block';

    /**Getting the distance to scroll*/
    var element = document.getElementsByClassName('nav-window')[0];
    var scrollDistance = element.offsetHeight + element.offsetTop;

    /**Scroll to the start of the section*/
    window.scrollTo(0, scrollDistance);
}