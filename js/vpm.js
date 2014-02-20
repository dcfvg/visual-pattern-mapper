$(function() {
  var st = 0, sd = 0, step = 10, z = 10, ajax_url = "call_ajax.php";
  $('td')
    .each( function(){ refreshImage($(this) , 0);})
    .mousewheel(function(event, delta) {
     // var id, count, bg;
      if (delta < 0) {
        st++;
        if (st > step) {
          refreshImage($(this), 1)
          st = 0;
        };
      }else if (delta > 0){
        sd++;
        if (sd > step) {
          refreshImage($(this), -1);
          sd = 0;
        };
      }
      
    
      
    })
    .hover(function(event){
      init_drag($(this), event);
      preview_refresh($(this));
    });
    function init_drag(obj, event){
      obj.draggable({
        revert: "valid",
        start: function(event, ui) { $(this).css("z-index", z++); }
      });
      $( "td" ).droppable({
        drop: function( event, ui ) { 
          var draggableId = ui.draggable.attr("id");
          var droppableId = $(this).attr("id");
          var pic = parseInt(ui.draggable.attr("pic"));
          
          var img_source = ui.draggable.find(":nth-child("+(pic+1)+")");
          
          console.log($(this));
          
          moveFile(img_source.attr("src"), $(this).attr("dir"));
          
          $(this)
            .prepend(img_source)
            .attr("pic", 0);
          refreshImage($(this),0);
          refreshImage(ui.draggable,0);
          
        }
      });
    }
    function refreshImage(mt , inc){
        var count = mt.children().length;
        if(count > 0){
          var pic_id = parseInt(mt.attr("pic")) + inc;

          if (pic_id < 0) pic = count-1;
          pic_id = pic_id % count;

          var bg = mt.find(":nth-child("+(pic_id+1)+")").attr("src");        
          mt.css("background-image", "url("+bg+")").attr("pic", pic_id)
            .removeClass('danger')
            .addClass('success');
        }else{
          mt
            .removeAttr('style')
            .removeClass('success')
            .addClass('danger');
        }
        preview_refresh(mt);
    }
    function moveFile( from , to ){
       var posting = $.post(ajax_url, { from:from, to:to } );
       posting.done(function( data ) {
         console.log(data);
       });
    }
    function save_picid(dir, pic){
      var posting = $.post(ajax_url, { dir:dir, pic:pic } );
      posting.done(function( data ) {
        console.log(data);
      });
    }
    function preview_refresh(mt){
      var src = mt.find(":nth-child("+(parseInt(mt.attr("pic"))+1)+")").attr("src");
      $("#preview img").attr("src",src);
    }
})