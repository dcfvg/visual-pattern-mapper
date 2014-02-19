$(function() {
  var st = 0, sd = 0, step = 30;
  $('td')
    .each( function(){
      var bg;
      
      if($(this).children().length > 0){
        bg = $(this).find(":nth-child(1)").attr("src");
        $(this).css("background-image", "url("+bg+")");
      }
    })
    .mousewheel(function(event, delta) {
      var id, count, bg;
      
      id = parseInt($(this).attr("pic"));
      count = $(this).children().length;
      
      if (delta < 0) {
        st++;
        if (st > step) {
          id++;
          st = 0;
        };
      }else if (delta > 0){
        sd++;
        if (sd > step) {
          id--;
          sd = 0;
        };
      }
      
      if (count > 1){
        if (id < 0) id = count-1;
        id = id % count;
        
        bg = $(this).find(":nth-child("+(id+1)+")").attr("src");

        $(this)
          .css("background-image", "url("+bg+")")
          .attr("pic", id);
      }
    });
})