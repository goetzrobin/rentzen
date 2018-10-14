$(function(){
    
    $( ".fa-sync" ).each( function( index, element ){
        var counter = 1;
       $(this).click( () =>  {
           console.log($(this));
           $(this).css("transform","rotate("+counter*360+"deg)");
           counter++;
       });
        
    });

});