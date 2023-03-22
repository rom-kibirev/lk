$(document).ready(function() {
var dinamslide = '500';
$('#userpass_f, #userpass_s, #passbut, #pinent, #pinbut, #recpasw').hide();
$('input [type="password"], input [type="text"]').val('');
		
/*sceene*/

$('#phonent input').mask('(999) 999-99-99',{completed:function(){
	$('#userpass_f, #userpass_s, #passbut, #pinent, #pinbut, #recpasw').hide();
    $('input [type="password"], input [type="text"]').val('');
	
	var phone = parseInt($(this).val().replace(/\D+/g,""));
	
	//post 'phone'
	var check_phone = $.post('/user/signin/status-phone', {phone: phone, status: 'false'}, 'json');// true / false / none
    check_phone.done (function(data){
		if (data.status == 'false') {//number not register
		
			//get
			var autcompUrl = '/user/signin#gotolk';
			var colpop = 3;
			var timeout = 59;
			
			//registration
			$('#disclamer').html('Вам необходимо зарегистрироваться в системе');
			$('#userpass_f, #userpass_s').slideDown(dinamslide);
			$('#userpass_f input').keyup(function(){//valid first input
				var passlength = $(this).val().length;
				$('#errpasw').remove();
				if (passlength<4) {
					$(this).addClass('falsedata');
					$('#userpass_f').before('<div id="errpasw">Пароль должен состоять минимум из 4-х символов</div>');
					$('#recpasw').slideUp(dinamslide);
				} else {
					$(this).removeClass('falsedata');
					$('#errpasw').remove();
				}
			});
			$('#userpass_s input').keyup(function(){//valid second input
				var password = $(this).val();
				var secpass = $('#userpass_f input').val();
				$('#errpasw').remove();
				if (password==secpass) {
					$(this).removeClass('falsedata');
					$('#errpasw').remove();
					$('#passbut').slideDown(dinamslide);
					$('#passbut input').val('Зарегистрироваться').on('click', function(){
						//post 'password'
						var check_password = $.post('/user/signin/signup', {password: password}, 'json');// true / false
						check_password.done (function(data){
							if (data.status == 'true') {//number register, not activaded
								$('#disclamer').html('Здравствуйте,<br>Введите полученный ПИН:');
								$('#userpass_f, #passbut, #phonent, #userpass_s, #recpasw').slideUp(dinamslide);
								$('#pinent, #pinbut').slideDown(dinamslide);
								$('#pinent input').mask('9999');
								$('#pinbut input').on('click', function(){
									var uspin = $('#pinent input').val();
									//post 'uspin'
									var check_pin = $.post('/user/signin/check-pin', {pin: uspin}, 'json');// true / false
									check_pin.done (function(data){
										if (data.status == 'true') {//pin correct, actived number
											window.location = autcompUrl;
										} else {//pin uncorrect
											$('#disclamer').html('Введен неверный ПИН код, осталось попыток <span class="nompop">'+colpop+'</span>');
											$('#pinent input').addClass('falsedata');
										}
									});
								});
							} else {//ban pin
								$('#disclamer').html('Вы превысли количество попыток введения ПИН кода, попробуйте через '+timeout+' мин.');
								$('#userpass_f, #passbut, #userpass_s').slideUp(dinamslide);
								$('#phonent input').prop('disabled', true);
							}
						});
					});
				} else {
					$(this).addClass('falsedata');
					$('#userpass_s').before('<div id="errpasw">Пароли не совпадают</div>');
					$('#recpasw').slideUp(dinamslide);
				}
			});
		} else if (data.status == 'true'){//number register
			var colpop = 0;
			var timeout = 0;
			var autcompUrl = '/my';
			var get_info = $.get('/user/signin/get-info', {}, 'json');// true / false /banpassword /banpin
			get_info.done (function (data) {
				var colpop = data.attempts;
				//var timeout = data.timeout;
				//var autcompUrl = '/user/signin#gotolk';
				console.log ('in ajax:' + colpop);
				//window.colpop = colpop_in;
				return colpop;
			});
			//return colpop;
			$('#t_reg_true').text(colpop);

			console.log (colpop);

			
			$('#userpass_f, #passbut').slideDown(dinamslide);
			$('#disclamer').text('Для авторизации введите пароль');
			$('#passbut input').on('click', function(){
				var password = $('#userpass_f input').val();
				//post 'password'
				var check_password = $.post('/user/signin/check-password', {password: password, status: 'banpassword'}, 'json');// true / false /banpassword /banpin
				check_password.done (function(data){
					if (data.status == 'true') {//password correct
						$('#disclamer').html('Здравствуйте,<br>Введите полученный ПИН:');
						$('#userpass_f, #passbut, #phonent, #userpass_s, #recpasw').slideUp(dinamslide);
						$('#pinent, #pinbut').slideDown(dinamslide);
						$('#pinent input').mask('9999');
						$('#pinbut input').on('click', function(){
							var uspin = $('#pinent input').val();
							//post 'uspin'
							var check_pin = $.post('/user/signin/check-pin', {pin: uspin}, 'json');// true / false
							check_pin.done (function(data){
								if (data.status == 'true') {//pin correct
									window.location = autcompUrl;
								} else {//pin uncorrect
									$('#disclamer').html('Введен неверный ПИН код, осталось попыток <span class="nompop">'+colpop+'</span>');
									$('#pinent input').addClass('falsedata');
								}
							});
						});
					} else if (data.status == 'false') {//password uncorrect
						$('#disclamer').html('Введен неверный пароль, осталось попыток <span class="nompop">'+colpop+'</span>');
						$('#userpass_f input').addClass('falsedata').val('');
					} else if (data.status == 'banpassword') {//ban password
						$('#disclamer').html('Вы превысли количество попыток введения пароля, попробуйте через '+timeout+' мин.');
						$('#userpass_f, #userpass_s, #passbut').slideUp(dinamslide);
						$('#phonent input').prop('disabled', true);
						$('#recpasw').slideDown(dinamslide);
						$('#recpasw input').on('click', function(){
							$('#userpass_f input').val('');
							$('#recpasw').slideUp(dinamslide);
							$('#disclamer').html('Для восстановления пароля, введите полученный ПИН:');
							$('#pinent, #pinbut').slideDown(dinamslide);
							$('#pinent input').mask('9999');
							$('#pinbut input').val('Авторизоваться').on('click', function(){
								var uspin = $('#pinent input').val();
								//post 'uspin'
								var check_pin = $.post('/user/signin/check-pin', {pin: uspin}, 'json');// true / false
								check_pin.done (function(data){
									if (data.status == 'true') {//pin correct
										$('#disclamer').html('Введите новый пароль');
										$('#userpass_f, #userpass_s, #passbut').slideDown(dinamslide);
										$('#pinent, #pinbut').slideUp(dinamslide);
										$('#passbut input').val('Сменить пароль');
										$('#userpass_f input').keyup(function(){//valid first input
											var passlength = $(this).val().length;
											$('#errpasw').remove();
											if (passlength<4) {
												$(this).addClass('falsedata');
												$('#userpass_f').before('<div id="errpasw">Пароль должен состоять минимум из 4-х символов</div>');
												$('#recpasw').slideUp(dinamslide);
											} else {
												$(this).removeClass('falsedata');
												$('#errpasw').remove();
											}
										});
										$('#userpass_s input').keyup(function(){//valid second input
											var password = $(this).val();
											var secpass = $('#userpass_f input').val();
											$('#errpasw').remove();
											if (password==secpass) {
												window.location = autcompUrl;
											} else {
												$(this).addClass('falsedata');
												$('#userpass_s').before('<div id="errpasw">Пароли не совпадают</div>');
												$('#recpasw').slideUp(dinamslide);
											}
										});
									} else {//pin uncorrect
										$('#disclamer').html('Введен неверный ПИН код, осталось попыток <span class="nompop">'+colpop+'</span>');
										$('#pinent input').val('').addClass('falsedata');
									}
								});
							});
						});
					}
				});
			});
		} else {//uncnown phone
			$('#disclamer').html('Не верно указан номер телефона');
		}});
}});

//design
$('input[type="text"]').click(function(){
	$(this).removeClass('falsedata');
});

});