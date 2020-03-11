$(window).scroll(function(){
    var wScroll = $(this).scrollTop();
    if (wScroll > $('.about-area').offset().top - 250) {
        $('.about-area .animasiAbout').addClass('muncul');
    } 

    if (wScroll > $('.kegiatan').offset().top - 250) {
        $('.kegiatan .animasiKegiatan').addClass('muncul');
    } 

    if (wScroll > $('.artikel').offset().top - 250) {
        $('.artikel .animasiArtikel').addClass('muncul');
    } 
});
