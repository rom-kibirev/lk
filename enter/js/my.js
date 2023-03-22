$(document).ready(function() {

//post phone
$('#phonent input').mask('(999) 999-99-99',{completed:function(){
	var phone = parseInt($(this).val().replace(/\D+/g,""));
	
	window.location = 'authorisation.html';
		
	/*var check_phone = $.post('/user/signin/status-phone', {phone: phone, status: 'true'}, 'json');
	check_phone.done (function(data){
		if (data.status == 'false') {
			//phone true, not registred
			var url_info = $.get('/user/signin/get-info', {}, 'json');
			get_url.done (function (data) {
				window.location = data.url;
			});
		} else if (data.status == 'true') {
			//phone true, registred
			var url_info = $.get('/user/signin/get-info', {}, 'json');
			get_url.done (function (data) {
				window.location = data.url;
			});
		} else if (data.status == 'none') { 
			//phone false
			$('.disclaimer').text('Не верно указан номер телефона');
		} else {
			//pin is blocked
			window.location = data.url;
		}
	});*/
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
				$('#passbut').slideDown(500);
				$('#passbut input').on('click', function(){
					//post 'password'
					var check_password = $.post('/user/signin/signup', {password: password}, 'json');
					window.location = 'authpin.html';
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
	window.location = 'banpin.html';
	/*var uspin = $('#pinent input').val();
	//post 'uspin'
	var pinathor = $.post('/user/signin/status-phone', {uspin: uspin, status: 'true'}, 'json');
	pinathor.done (function(data){
		if (data.status == 'true') {
			//pin correct
			$(this).removeClass('falsedata');
			window.location = data.url;
		} else if (data.status == 'false') {
			//pin uncorrcet
			$(this).addClass('falsedata');
			$('.disclaimer').html('Введен неверный ПИН код, осталось попыток <span class="nompop">'+data.colpop+'</span>');			
		} else {
			//pin is blocked
			window.location = data.url;
		}
	});*/
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