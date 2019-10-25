$(document).on('keydown','.input_rep',function(e){
    if(e.keyCode==13 && !e.shiftKey){
        var me = $(this).data('me');
    	var room = $(this).data('room');
    	var type = $(this).data('type');
    	var link = $(this).data('link');
    	var noidung = $(this).html();
        if($(this).text().trim() == ''){
            toastr.error('Vui lòng nhập vào nội dung bình luận!!!');
            return false;
        }
    	input_text = (this);
		data = {
            'me' : me,
            'room' : room,
            'type' : type,
            'link' : link,
            'noidung' : noidung
        };
        $.post('modules/binhluan/gui_binhluan2.php', data, function(res){ eval(res); /* MathJax.Hub.Typeset (); */ });   
    }
});

$(document).on('change',"#selectfile", function(){
    target_elm = $(this).data('target');
    console.log($(this));
    var file    = $(this).files[0];
    
    var reader  = new FileReader();
    reader.addEventListener("load", function () {
        $(target_elm).append('<img src="" />');
        $(target_elm).children('img').src = reader.result;
      }, false);
    
      if (file) {
        reader.readAsDataURL(file);
      }
});

$(document).on('click','.upload-images',function(e){
    e.preventDefault();
    target_elm = $(this).data('target'); 
    $('#selectfile').trigger('click');
    $('#selectfile').attr('data-target',target_elm);
});
$(document).on('click','.rep-comment',function(){
    var id_me = $(this).data('id');
    var room = $(this).data('room');
    var type = $(this).data('type');
    var link = $(this).data('link');
    
    if($(this).parent().parent().parent().find('.rep').find('input').hasClass('input_rep') == false){
        $(this).parent().parent().parent().find('.rep').append('<a href="" class="upload-images" data-target="#input_rep'+id_me+'" ></a><div contenteditable="true" id="input_rep'+id_me+'" data-room="'+room+'" data-type="'+type+'" data-me="'+id_me+'" data-link="'+link+'"  data-text="Nhập vào trả lời bình luận tại đây ... "  class="input_rep" type="text" ></div>');
    }
});
(function( $ ) {
    $.fn.createComment = function(options) {
         var settings = $.extend({
            url_load : 'modules/binhluan/load_binhluan.php',
            user_id  : 0,
            room : 0,
            socket : {},
            type : ''
        }, options );
        $(this).append('<div class="box-binhluan"><div id="binhluan"></div><div><input type="file" id="selectfile" class="hidden" /> '); 
        $('#binhluan').html('<link href="templates/giaodien-v3/css/binhluan.css" rel="stylesheet" /><div id="noidungbl"></div><div class="group_input" style="padding: 15px;right: 0;/*position: absolute;*/bottom: 0;left: 0;"><div style=" margin: 15px 0; color: #000; text-align: center; position: absolute; left: 0; bottom: -40px; width: 100%;font-size: 14px;">Sử dụng hashtag <span style=" color: red; ">#hoidap</span> bình luận để gửi thông báo cho trung tâm</div><div id="typing"></div><div id="input_rep0" data-text="Nhập vào nội dung bình luận tại đây..." data-room="'+settings.room+'" data-type="'+settings.type+'" data-me="0" data-link="'+location.href+'" type="text" class="input_rep form-control" contenteditable="true" ></div></div>');
        $('#noidungbl').html('<img src="../https@bigcoinvietnam.com/theme/frontend/images/loading.gif" />');
        socket.emit('join-room',settings.room);
        $.post(settings.url_load,{'room':settings.room})
           .done(function(data){
                var binhluan = JSON.parse(data);
                $('#noidungbl').html('');                
                try{
                    $.each(binhluan,function(k,v){
                        if(v.me == 0){
                            if(v.avatar != ""){
                                avatar = v.avatar.replace('thanhvien','thanhvien/30x30');
                            }else{
                                avatar = 'userfiles/thanhvien/30x30/0.jpg';
                            }

                            var noidung = '<img src="'+avatar+'" class="blavatar" data-id="'+v.thanhvien+'">';
                            noidung += '<div class="blnoidung"><div class="noidung" data-blid="'+v.id+'"><div class="bao"><span class="blnguoigui">'+v.nguoigui+'</span> '+v.noidung+' '+v.xoa+'</div><div class="div-rep"><a class="rep-comment" data-room="'+settings.room+'" data-type="'+settings.type+'"  data-link="'+location.href+'" data-id="'+v.id+'">Trả lời</a> . <span style=" font-size: 10px; color: #ddd; ">'+v.thoigian+'</span></div></div><div class="rep"></div></div>';
                            
                            $('#noidungbl').append('<div class="div-binhluan" id="div-binhluan-'+v.id+'">'+noidung+'</div>');
                            if(v.total_reply > 0){
                                $.each(v.reply,function(k2,v2){
                                    if(v2.me == v.id){
                                        
                                        noidung2 = '<img src="'+v2.avatar+'" class="blavatar" data-id="'+v2.thanhvien+'">';
                                        noidung2 += '<div class="blnoidung"><div class="noidung"><div class="bao"><span class="blnguoigui">'+v2.nguoigui+'</span> '+v2.noidung+' '+v2.xoa+'</div></div>';
                                        $("[data-blid="+v.id+"]").append('<div class="div-binhluan" id="div-binhluan-'+v2.id+'" >'+noidung2+'</div>');
                                    }
                                })
                            }
                        }
        
                    });
                    $('#noidungbl').scrollTop(9999999999999)
                }catch(err){
                    console.log(err);
                }
           })
        
    };
    
}( jQuery ));
$(document).ready(function (e){  
    socket.on('comment', function(v) {
    if(v.me == 0){
        var id_me = v.id;
        var room = v.room;
        var type = v.type;
        var link = v.link;
        var noidung = '<img src="'+v.avatar+'"  alt="'+v.nguoigui+'" titile="'+v.nguoigui+'"  class="blavatar">';
        noidung += '<div class="blnoidung"><div class="noidung" data-blid="'+v.id+'"><div class="bao"><span class="blnguoigui">'+v.nguoigui+'</span> '+v.noidung+'</div><div class="div-rep"><a class="rep-comment" data-room="'+room+'" data-type="'+type+'" data-me="'+id_me+'" data-link="'+link+'" data-id="'+v.id+'">Trả lời</a> . <span style=" font-size: 10px; color: #ddd; ">'+v.thoigian+'</span></div></div><div class="rep"></div></div>';
        $('#noidungbl').append('<div class="div-binhluan">'+noidung+'</div>');   
        $('#noidungbl').scrollTop(9999999999999);       
    }else{
        noidung = '<img  alt="'+v.nguoigui+'" titile="'+v .nguoigui+'"  src="'+v.avatar+'" class="blavatar">';
        noidung += '<div class="blnoidung"><div class="noidung"><div class="bao"><span class="blnguoigui">'+v.nguoigui+'</span> '+v.noidung+'</div></div>';
        $("[data-blid="+v.me+"]").append('<div class="div-binhluan">'+noidung+'</div>');
         
    }
    
});
})


