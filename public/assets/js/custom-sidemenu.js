'use strict';

function singleMenu(objClass) {
    $(objClass).parent().addClass('active');
    $(objClass).parent().parent().addClass('active');
}

function toggleMenu(objClass, url = '') {
    $(objClass).parent().addClass('active');
    $(objClass).parent().parent().addClass('active');
    $(objClass).parent().click();

    $('.slide-item').each(function() {
        let href = this.href.split(url)[1];

        if(href === '') $(this).addClass('active');
    })
}