$(function() {
  
  var st = 0, sd = 0, step = 1;
  $('td')
    .each( function(){
      $(this).css("background-image", "url("+$(this).find(":nth-child(1)").attr("src")+")")
    })
    .mousewheel(function(event, delta) {
      var id = parseInt($(this).attr("pic")),
          count = parseInt($(this).attr("count")),
          bg;
    
      // if (delta < 0) {
      //   st++;
      //   if (st > step) {
      //     id++;
      //     st = 0;
      //   };
      // }else if (delta > 0){
      //   sd++;
      //   if (sd > step) {
      //     id--;
      //     sd = 0;
      //   };
      // }
      
      // 
      if (delta < 0) id++;
      else if (delta > 0) id--;
    
      if(count > 1){
        
        if (id < 0) id = count;
        id = id % count;
        
        bg = $(this).find(":nth-child("+(id+1)+")").attr("src");

        $(this)
          .css("background-image", "url("+bg+")")
          .attr("pic", id);
      }
    });
})