$(document).ready(function() {

//post phone
$('#phonent input').mask('(999) 999-99-99',{completed:function(){
	var phone = parseInt($(this).val().replace(/\D+/g,""));
	$('.js-set-phone').trigger('submit');
}});

//registration
$('#passbut').slideUp(0);
$('#userpass_f input').keyup(function(){
	$('#passbut').slideUp(0);
	var passlength = $(this).val().length;
	$('#errpasw').remove();
	if (passlength<4) {
		$(this).addClass('falsedata');
		$('#userpass_f').before('<div id="errpasw">Пароль должен состоять минимум из 4-х символов</div>');
	} else {
		$(this).removeClass('falsedata');
		$('#errpasw').remove();
		$('#userpass_s input').keyup(function(){
			$('#passbut').slideUp(0);
			var password = $(this).val();
			var secpass = $('#userpass_f input').val();
			$('#errpasw').remove();
			if (password==secpass) {
				$('#errpasw').remove();
				$(this).removeClass('falsedata');
				$('#passbut').stop(true, true).slideDown(500);
				$('#passbut input').on('click', function(){
					$('.js-register-form').trigger('submit');
				});
			} else {
				$(this).addClass('falsedata');
				$('#userpass_s').before('<div id="errpasw">Пароли не совпадают</div>');
			}
		});
	}
});


//authorization pin
$('#pinent input').mask('9999',{completed:function(){
	$('.js-form-need-pin').trigger('submit');
}});

//ban pin
/*var get_time = $.get('/user/signin/get-info', {}, 'json');
get_time.done (function (data) {
	$('#resttime').text(data.time);
});*/

//authorization
$('#reactbut').slideUp(0);
$('#auth input').on('click', function(){	
	/*var password = $('#password input').val();
	var passauthor = $.post('/user/signin/status-phone', {password: password, status: 'true'}, 'json');
	passauthor.done (function(data){
		if (data.status == 'true') {
			window.location = data.url;
		} else if (data.status == 'false') {
			$('#password input').addClass('falsedata');
			$('.disclaimer').html('Введен неверный пароль, осталось попыток <span class="nompop">'+data.colpop+'</span>');
		} else {
			$('.disclaimer').html('Вы превысли количество попыток введения пароля');
			$(this).slideUp(0);
			$('#reactbut').slideDown(500).on('click', function(){
				window.location = data.url;
			});
		}
	});*/
});

});