jQuery().noConflict

$(window).resize(function() {
var winsize = $(window).width();
if (winsize <= 1030){
	$('#dog_block #readiness').each(function (){
		$(this).hide();
	});
} else {
	$('#dog_block #readiness').each(function (){
		$(this).show();
	});
}
});

$(document).ready(function() {

var $grid = $('.grid').isotope({
	itemSelector: '.grid-item',
	layoutMode: 'packery',
	packery: {gutter: 10}
});
		

$('.carousel-inner').swipe( {
	swipeLeft:function(event, direction, distance, duration, fingerCount) {
		$(this).parent().carousel('next');
		var $grid = $('.grid').isotope({
			itemSelector: '.grid-item',
			layoutMode: 'packery',
			packery: {gutter: 10}
		});
	}, swipeRight: function() {
		$(this).parent().carousel('prev');
		var $grid = $('.grid').isotope({
			itemSelector: '.grid-item',
			layoutMode: 'packery',
			packery: {gutter: 10}
		});
	},threshold:50
});
$('#hn_prev').click(function(){
	$('#body_site').carousel('prev');
	var $grid = $('.grid').isotope({
		itemSelector: '.grid-item',
		layoutMode: 'packery',
		packery: {gutter: 10}
	});
});
$('#hn_next').click(function(){
	$('#body_site').carousel('next');
	var $grid = $('.grid').isotope({
		itemSelector: '.grid-item',
		layoutMode: 'packery',
		packery: {gutter: 10}
	});
});
$('#body_site #doc_id').hide();
$('#body_site').on('slid.bs.carousel',function(){
	var $grid = $('.grid').isotope({
		itemSelector: '.grid-item',
		layoutMode: 'packery',
		packery: {gutter: 10}
	});
	var thisslide = $(this).find('.active').find('#doc_id').text();
	$('.hn_name_dog').text(thisslide);
});

$('.hn_name_dog').text($('#body_site .active').find('#doc_id').text());


$('.hnn_list').hide();
$('#hn_n_dog').text($('#body_site .item').length);
$('#hn_numb').click(function(){
	$(this).after('');
	$('#hnn_list').html('');
	$('#body_site .item').each(function(i) {
		$('#hnn_list').append('<div id="hnnl_item" data-target="#body_site" data-slide-to="'+i+'"><div id="hnnl_num_dog">'+$(this).find('#doc_id').text()+'</div><div id="hnnl_sub_dog">'+$(this).find('#subject_dog').text()+'</div></div>');
    });
	$('.hnn_list').fadeIn(500);
});

$('.hnnl_close').click(function(){
	$('.hnn_list').fadeOut(500,function(){
		$('#hnn_list').delay(500).html('');
	});
});

var winsize = $(window).width();
if (winsize >= 1030){
	$('#dog_block #readiness').each(function (){
		var kr_val = parseInt($(this).text());
		var kr_w = $(this).width();
		if (kr_val>0) {
			$(this).empty();
			$(this).radialProgress('init', {
			  'size': kr_w,
			  'fill': 30,
			  'font-size': 70,
			  'text-color': '#006298'
			}).radialProgress('to', {'perc': kr_val-0.5});
		}
	});
}

$('.grid-item #in_pay').click(function() {
	var pay_dog = $(this).parent().parent().parent().parent().parent().parent().find('#doc_id').text();
    var pay_id = $(this).parent().parent().find('.gi_con_title').text();
	var pay_summ = $(this).parent().parent().find('.doc_money').text();
	$('#pay_dog').text(pay_dog);
	$('#pay_area').text(pay_id);
	$('#pay_summ').text(pay_summ);
	$('#inovpay_form').modal();
});

$('.grid-item #pib_diff').each(function() {
  	var pibdif = $(this).text();
	if (pibdif<0) {
		$(this).text(pibdif.replace(/^\.|[^\d\.]|\.(?=.*\.)|^0+(?=\d)/g, ''));
		$(this).parent().parent().find('#gi_pd_plus').remove();
		$(this).parent().parent().find('#gi_sd_plus').remove();
	} else {
		$(this).parent().parent().find('#gi_pd_minus').remove();
		$(this).parent().parent().find('#gi_sd_minus').remove();
	}
});

$('#body_site #bl_fav').click(function(){
	$(this).toggleClass('fav_active');
	var id_dog_block = $(this).parent().parent().parent().data('dog');
	var save_data = $.post("/my/set-pay-data", {'data-dog': id_dog_block});
});

$('#park_rent #park_rent_pay_date').each(function(index, element) {
	var get_now_date = Date.now();
	var get_pay_date = Date.parse($(this).text().replace(/(\d+).(\d+).(\d+)/, '$3-$2-$1'));
	var now_date = get_now_date/2700000000;
	var pay_date = get_pay_date/2700000000;
	var fut_date = now_date+3;
	var last_date = now_date-1;
	if (pay_date>fut_date) {
		$(this).parent().parent().hide();
	}
	if (pay_date<last_date) {
		$(this).parent().parent().hide();
	}
	if (pay_date<now_date) {
		$(this).parent().parent().find('.gipi_but').hide();
	}
});

$('#park_rent #show_payinf').click(function(){
	var get_title = $(this).parent().parent().find('.bl_title').text();
	$('#park_rent #gi_payinf').each(function(index, element) {
       $('#spe_body').append('<div id="full_pay_list">'+$(this).html()+'</div>');
	   $('#spe_body #full_pay_list').find('.gipi_but').hide();
	   $('#show_pay_el .modal-title').text(get_title);
	   $('#show_pay_el').modal();
    });
});

$('#park_rent_fakt #park_rent_pay_date_fakt').each(function(index, element) {
	if ($('#park_rent_fakt #park_rent_pay_date_fakt').length>4){
		var get_now_date = Date.now();
		var get_pay_date = Date.parse($(this).text().replace(/(\d+).(\d+).(\d+)/, '$3-$2-$1'));
		var now_date = get_now_date/2700000000;
		var pay_date = get_pay_date/2700000000;
		var fut_date = now_date+3;
		var last_date = now_date-3;
		if (pay_date>fut_date) {
			$(this).parent().parent().hide();
		}
		if (pay_date<last_date) {
			$(this).parent().parent().hide();
		}
		if (pay_date<now_date) {
			$(this).parent().parent().find('.gipi_but').hide();
		}
	}
});

$('#park_rent_fakt #show_payinf').click(function(){
	var get_title = $(this).parent().parent().find('.bl_title').text();
	$('#park_rent_fakt #gi_payinf').each(function(index, element) {
       $('#spe_body').append('<div id="full_pay_list">'+$(this).html()+'</div>');
	   $('#spe_body #full_pay_list').find('.gipi_but').hide();
	   $('#show_pay_el .modal-title').text(get_title);
	   $('#show_pay_el').modal();
    });
});

$('#show_pay_el .close').click(function(){
	$('#spe_body').html('');
});


});