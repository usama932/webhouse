(function ($) {
    "use strict";

    /*---------------------------
       Commons Variables
    ------------------------------ */
    var $window = $(window),
        $body = $("body");

    /*-----  Hover Dropdown Navigation Start -----*/
    if (window.innerWidth > 992) {

        document.querySelectorAll('.navbar .nav-item').forEach(function (everyitem) {

            everyitem.addEventListener('mouseover', function (e) {

                let el_link = this.querySelector('a[data-bs-toggle]');

                if (el_link != null) {
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.add('show');
                    nextEl.classList.add('show');
                    nextEl.setAttribute("data-bs-popper", "static");
                }

            });
            everyitem.addEventListener('mouseleave', function (e) {
                let el_link = this.querySelector('a[data-bs-toggle]');

                if (el_link != null) {
                    let nextEl = el_link.nextElementSibling;
                    el_link.classList.remove('show');
                    nextEl.classList.remove('show');
                    nextEl.removeAttribute("data-bs-popper");
                }


            })
        });

    }
    /*-----  Hover Dropdown Navigation End  -----*/

    /*-----  enable Tooltip start -----*/
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    /*-----  enable Tooltip end -----*/

}(jQuery));
