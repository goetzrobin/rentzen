function scrollToSection(id){
    // console.log(id);
    $('html, body').animate({
      scrollTop: $("#" + id).offset().top - 20
     }, 1000);
}