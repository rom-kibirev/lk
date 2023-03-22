$(document).ready(function() {
	
var anim_speed = 250;

/* persent */

$('#dog_block #readiness').each(function (){
	var kr_val = parseInt($(this).text());
	if (kr_val>0) {
		$(this).empty();
		$(this).radialProgress('init', {
		  'size': 160,
		  'fill': 30,
		  'text-color': '#000'
		}).radialProgress('to', {'perc': kr_val});
	}
});


/*navigation*/

$('#nav_title').text($('.nav_act').text());
$('#doc_tit_list').slideUp(0);

$('#colexp_list').click(function(){
	$('#doc_tit_list').slideToggle(anim_speed);
	$(this).toggleClass('colexp_list_back');
});
$('#fav_list').hide(0);
$('#shhi_fav').click(function(){
	$(this).toggleClass('shhi_fav_on');
	$('#dog_list').fadeToggle(anim_speed);
	$('#fav_list').fadeToggle(anim_speed);
	$('#fav_list').empty();
	$('#dog_list .on_fav').each(function(){
		var selfav = $(this).parent().parent().parent().parent().parent().html();
		$('#fav_list').append(selfav);
	});
});

$('#dog_list #dog_cl').hide();
$('#navbar .dog_cl').click(function(){
	var num_dog_nav = $(this).data('type');
	$('#dog_list #dog_cl').hide();
	$('[data-id='+num_dog_nav+']').fadeIn(anim_speed);
	$('.nav_act').removeClass('nav_act');
	$(this).addClass('nav_act');
	$('#nav_title').text($('.nav_act').text());
	$('#doc_tit_list').slideUp(anim_speed);
	$('#colexp_list').toggleClass('colexp_list_back');
});
$('[data-id="1"]').show();

/*add favorit block*/
$('#head_block #nav_but_fav').click(function(){
	if ($(this).hasClass('off_fav')) {
		$(this).fadeOut(anim_speed, function(){
			$(this).removeClass().addClass('on_fav').fadeIn(anim_speed);
		});
	} else {
		$(this).fadeOut(anim_speed, function(){
			$(this).removeClass().addClass('off_fav').fadeIn(anim_speed);
		});
	}
});

/* expand / colapse block*/
$('#dog_block #nav_but_colexp').each(function() {
    if ($(this).hasClass('bl_exp')) {
		$(this).parent().parent().parent().parent().parent().find('#block_body').slideUp(0);
	}
});
$('#head_block #nav_but_colexp').click(function(){
	if ($(this).hasClass('bl_col')) {
		$(this).fadeOut(anim_speed, function(){
			$(this).removeClass().addClass('bl_exp').fadeIn(anim_speed);
		});
		$(this).parent().parent().parent().parent().parent().find('#block_body').slideUp(anim_speed*2);
	} else {
		$(this).fadeOut(anim_speed, function(){
			$(this).removeClass().addClass('bl_col').fadeIn(anim_speed);
		});
		$(this).parent().parent().parent().parent().parent().find('#block_body').slideDown(anim_speed*2);
	}
});

/*generate bill*/
$('.gen_bill').hide();
$('#planpay #gen_bill').click(function(){
	var sum_gb = $(this).parent().find('#planpay_sum').text();
	$('#gb_purp_pay').text(sum_gb);
	$('.gen_bill').fadeIn(anim_speed*2);
});

$('#bl_close').click(function(){
	$('.gen_bill').fadeOut(anim_speed*2);
});


/*apartments transfer resize*/
$('#sec_pan #pib_diff').each(function() {
	var at_pib_diff = $(this).text();
	if (at_pib_diff<0) {		
		$(this).text(at_pib_diff.replace(/^\.|[^\d\.]|\.(?=.*\.)|^0+(?=\d)/g, ''));
		$(this).parent().parent().find('#inc_area').remove();
		$(this).parent().parent().find('#inc_area_sum').remove();
	} else {
		$(this).text(at_pib_diff.replace(/^\.|[^\d\.]|\.(?=.*\.)|^0+(?=\d)/g, ''));
		$(this).parent().parent().find('#red_area').remove();
		$(this).parent().parent().find('#red_area_sum').remove();
	}
});

/*aplications complite*/
$('#dog_block #app_inp_compl').each(function(){
	var ap_comp = $(this).text();
if (ap_comp==1) {
	$(this).html('<img src="./images/check.png" width="25" />');
} else {
	$(this).html('');
}
});

/*managers*/
$('#block_body #reserv_men_wt').each(function (){
	var val_data = $(this).text().replace(' ',',');
	$(this).parent().attr('href','tel:'+val_data);
});
$('#block_body #reserv_men_mt').each(function (){
	var val_data = $(this).text().replace(' ',',');
	$(this).parent().attr('href','tel:'+val_data);
});
$('#block_body #reserv_men_mail').each(function (){
	$(this).parent().attr('href','mailto:'+$(this).text());
});

$('#colexp_list span').text($('#doc_tit_list .dog_cl').length);

	$(document).on ('click', '#bl_save', function () {
		var doc_id = $('#num_dog').text();
		var doc_date = $('#date_dog').text();
		var doc_pay_sum = $('#gb_purp_pay').text();

		var save_data = $.post("/my/set-pay-data", {id: doc_id, date: doc_date, sum: doc_pay_sum });

		save_data.done (function (data) {
			window.location = '/my/order-pdf';
		});
	});
   
});