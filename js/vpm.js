$(function() {
  var st = 0, sd = 0, step = 10, z = 10, ajax_url = "call_ajax.php", change_pic = false;
  $('td')
    .each( function(){ refreshImage($(this) , 0);})
    .mousewheel(function(event, delta) {
     // var id, count, bg;
     
     change_pic = true;
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
    .mouseover(function(event){
      init_drag($(this), event);
      preview_refresh($(this));

    })
    .mouseout(function() {
      if(change_pic)save_picid($(this).attr("dir"), $(this).attr("pic"));
      change_pic = false;
    });
    
    window.onunload = function() {
        console.log("save picid")
        $('td').each( function(){ save_picid($(this).attr("dir"), $(this).attr("pic"));});
    }
    
    $( "#filters button" ).click(function() {
      $( "#filters button" ).removeClass("btn-primary").addClass("btn-default");
      
      $("table td").removeClass("blur negative contrast desaturate").toggleClass($(this).attr("filter"));
      
      $(this).addClass("btn-primary");      
    });
    
    function init_drag(obj, event){
      obj.draggable({
        revert: true,
        start: function(event, ui) { $(this).css("z-index", z++); }
      });
      $( "td" ).droppable({
        drop: function( event, ui ) { 
          var draggableId = ui.draggable.attr("id");
          var droppableId = $(this).attr("id");
          var pic = parseInt(ui.draggable.attr("pic"));
          
          var img_source = ui.draggable.find(":nth-child("+(pic+1)+")");
          
          // console.log($(this));
          
          var posting = $.post(ajax_url, { from:img_source.attr("src"), to:$(this).attr("dir") } );
           posting.done(function( data ) {
             img_source.attr("src", data.newurl); // if we move image, we need to change url
           });
              
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

          if (pic_id < 0) pic_id = count-1;
          pic_id = pic_id % count;

          var bg = mt.find(":nth-child("+(pic_id+1)+")").attr("src");
          
          //save_picid(mt.attr("dir"), pic_id);
          
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
         //console.log(data.newurl);
         return data.newurl;
       });

    }
    function save_picid(dir, pic_id){
      var posting = $.post(ajax_url, { dir:dir, pic_id:pic_id } );
      posting.done(function( data ) {
        console.log(data);
      });
    }
    function preview_refresh(mt){
      var src = mt.find(":nth-child("+(parseInt(mt.attr("pic"))+1)+")").attr("src");
      $("#preview img").attr("src",src);
    }
})