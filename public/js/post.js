$(document).ready( function () {


	

	$('.btn_curtir').click(function(){

		var id = $(this).attr("id");

		var valor_id = parseInt(id.match(/\d/g).join(''));

		valor_id = valor_id.toString();

		var post_id = valor_id.substring(-1, 1);

		var user_id = valor_id.substring(1, 2);

	


		$('#'+id+'_curtido').css({display:'block'});
		$('#'+id).css({display:'none'});

		Acao(user_id, post_id);
	});

	$('.btn_curtido').click(function(){

		var id = $(this).attr("id");

		var valor_id = parseInt(id.match(/\d/g).join(''));

		valor_id = valor_id.toString();

		var post_id = valor_id.substring(-1, 1);

		var user_id = valor_id.substring(1, 2);

	

		$('#'+id).css({display:'none'});
		$('#btn-curtir'+post_id+user_id).css({display:'block'});

		AcaoDeleteCurtir(user_id, post_id);
	});



     function Acao(user_id, post_id) {

         $.ajax({
             url: '/curtir',
             data: {
                'user_id': user_id,
                'post_id': post_id,
            },
             success: function (data) {
                 
                 if(data)
                 {
                 	return true;
                 }
                 else
                 {
                 	return false;
                 }
             }
         });
    };

    function AcaoDeleteCurtir(user_id, post_id) {

         $.ajax({
             url: '/curtirDelete',
             data: {
                'user_id': user_id,
                'post_id': post_id,
            },
             success: function (data) {
                 
                 if(data)
                 {
                 	return true;
                 }
                 else
                 {
                 	return false;
                 }
             }
         });
    };



    // Fim document
});

$(document).ready(function(){

    $(".enviar-comentario").click(function(){

        var post_id = $(this).data('post');
        var text = $(this).data('input');
        var comentario = $('#'+text).val();
        $('#'+text).val('');

        if(comentario == '')
        {
            $('#'+text).css({'border-color' : 'red'});
        }
        else
        {
            $('#'+text).css({'border-color' : '#ccc'});

            ComentarPost(post_id, comentario);
        }

        

    });

     function ComentarPost(post_id, comentario) {

             $.ajax({
                 url: '/comentar/post',
                 data: {
                    'post_id': post_id,
                    'comentario': comentario,
                },
                 success: function (data) {

                     
                     if(data)
                     {
                        return true;
                     }
                     else
                     {
                        return false;
                     }
                 }
             });
        };

});