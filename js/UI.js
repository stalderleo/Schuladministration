/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
                console.log("awd");

    $('[data-extend]').click(function(){
        $(this).toggleClass('white');
       $('[data-label="Email"]').each(function(){
           $(this).toggleClass('downsize');
       });
    });


    $('.search').keyup(function(){
        var temp = $(this).val().toUpperCase();
        if($(this).val().length > 2){
            $('.class-selection > label').each(function(){
                if(!$(this).text().match(temp)){
                    $(this).hide();
                }
            });
        }else{
            $('.class-selection > label').each(function(){
                if($(this).text() !== temp){
                    $(this).show();
                }
            });
        }
    });
});