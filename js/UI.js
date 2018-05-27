/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {

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
                if(!$(this).text().toUpperCase().match(temp)){
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


    /*** dropdown with search ***/
    $('[data-select-search]').on('keyup change', function(){
      var search_val = $(this).val().toLowerCase();
      var $select = '#'+$(this).data('selectSearch');
      
      if(search_val.length >= 2){
          $($select).children().each(function(){
            if(!$(this).text().toLowerCase().match(search_val)){
              $(this).hide();
            }else{
              $(this).show();
            }
          });
      }else{
        
        $($select).children().each(function(){
          $(this).show();
          $($select).attr('size', $($select).children().length)
        });
        
      }
    });

    $('[data-select-search]').focus(function(){
      var $select = '#'+$(this).data('selectSearch');
      $($select).attr('size', $($select).children().length)
      $($select).css('top', $(this).outerHeight());
      $($select).css('z-idnex', '3');
      $(this).css('color', 'inherit');
      
      function reset(){
        var $select = '#'+$('[data-select-search]').data('selectSearch');
        $($select).attr('size', 1)
        $($select).css('top', 0);
        $($select).css('z-idnex', '-1');
        $('[data-select-search]').val($('option:selected').text())
        $('[data-select-search]').css('color', 'transparent');
      }
      
      //close the list
      $('#'+$('[data-select-search]').data('selectSearch')).change(function(){
        reset();
      });
      
      $('[data-select-search]').blur(function(){
        var $select = '#'+$(this).data('selectSearch');
        setTimeout(function(){
          if(!$($select).is(":focus")){
            reset();
          }
        }, 50);
      });
      
    });
    /*** dropdown with search ***/

    $('[data-table-search]').keyup(function(){
      var val  = $(this).val().toLowerCase();
      var listId = $(this).data()['tableSearch'];
      if(val.length >= 2){
        $(listId).children('tbody').children().each(function(){
           if(!$(this).find('td:nth-of-type(1)').text().toLowerCase().match(val) && !$(this).find('td:nth-of-type(2)').text().toLowerCase().match(val)){
              $(this).hide();
            }else if($(this).find('td:nth-of-type(1)').text().toLowerCase().match(val) || $(this).find('td:nth-of-type(2)').text().toLowerCase().match(val)){
              $(this).show();
            }
        });
      }else{
        $(listId).children('tbody').children('tr').each(function(){
          $(this).show();
        });
      }
    });
});