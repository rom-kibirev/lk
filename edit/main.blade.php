<!DOCTYPE html>
<!-- saved from url=(0047)http://getbootstrap.com/examples/justified-nav/ -->
<html>
<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Личный кабинет клиента ООО &laquo;Главстрой-СПб&raquo;</title>
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/my.css" rel="stylesheet">
    <script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.js"></script>
    <script type="text/javascript" src="./js/plugins.js"></script>
    <script type="text/javascript" src="./js/script.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]>
    <script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./js/ie-emulation-modes-warning.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


<div class="container navbar navbar-default navbar-fixed-top" id="navbar">
    <table id="topmenu" border="0" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <td id="nav_title">&nbsp;</td>
            <td id="colexp_list" class="colexp_list">Остальные договора  <span></span></td>
            <td id="shhi_fav" class="shhi_fav">&nbsp;</td>
        </tr>
    </table>
    <div id="doc_tit_list" class="row">
        @if (isset ($docTypes['flats']) and count ($docTypes['flats']) > 0)
            <div id="dog_list_group_apart">Ваши договоры</div>
            @foreach($docTypes['flats'] as $doc)
                @if ($doc->type == 'flat_booking')
                    <div data-type="{{$doc->id}}" class="dog_cl @if ($doc->id == 1) nav_act @endif" id="flat_booking">Информация по текущим сделкам</div>
                @else
                    <div data-type="{{$doc->id}}" class="dog_cl @if ($doc->id == 1) nav_act @endif" id="{{$doc->type}}">Договор №<span
                                id="doc_id">{{$doc->num_dog}}</span></div>
                @endif
            @endforeach
        @endif

        @foreach ($docs as $doc)
            @if ($doc->type == 'parking_rent' and !isset ($flags['parking_rent']))
                <?php $flags['parking_rent'] = true; ?>
                <div id="dog_list_group_apart">Договора на аренду машиноместа</div>
            @endif
            @if ($doc->type == 'parking_rent')
                <div data-type="{{$doc->id}}" class="dog_cl @if ($doc->id == 1) nav_act @endif" id="parking_rent">График платежей <span
                            id="park_rent_num">{{$doc->park_rent_num}}</span></div>
            @endif

            @if ($doc->type == 'parking_buy' and !isset ($flags['parking_buy'])) <?php $flags['parking_buy'] = true; ?>
            <div id="dog_list_group_apart">Договора на приобретение машиноместа</div> @endif
            @if ($doc->type == 'parking_buy')
                <div data-type="{{$doc->id}}" class="dog_cl @if ($doc->id == 1) nav_act @endif" id="parking_buy">Состояние документов <span
                            id="park_buy_num">{{$doc->park_buy_num}}</span></div>@endif
        @endforeach
    </div>
</div>

<div id="fav_list" class="container"></div>

<div id="dog_list">
    @foreach($docs as $doc)
        @if ($doc->type == 'parking_rent')
            <div id="dog_cl" data-id="{{$doc->id}}">
                <div class="container" id="dog_block">
                    <div id="head_block">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td id="bl_nav_tit">График платежей</td>
                                <td id="nav_but_fav" class="off_fav">&nbsp;</td>
                            </tr>
                        </table>
                    </div>

                    <div id="block_body">

                        <div id="park_rent_num">{{$doc->park_rent_num}}</div>

                        <div class="col-lg-12 col-md-12 col-sm-12"></div>
                        <br>

                        <table border="0" cellspacing="0" cellpadding="5" class="table">
                            <tr>
                                <td colspan="2">План платежей</td>
                                <td colspan="2">Факт поступления платежей</td>
                            </tr>
                            <?php $key = 0; ?>

                            @foreach($doc->plan_park_rent_pays->plan_park_rent_pay as $pay)
                                <tr>
                                    <!--pay plan-->
                                    <td>Платеж № <span id="park_rent_pay_num">{{$pay->park_rent_pay_num}}</span> от
                                        <span id="park_rent_pay_date">{{$pay->park_rent_pay_date}}</span></td>
                                    <td id="park_rent_pay_sum">{{$pay->park_rent_pay_sum}}</td>
                                    @if (isset ($doc->fakt_park_rent_pays->fakt_park_rent_pay[$key]->park_rent_pay_sum_fakt))
                                            <!--pay fact-->
                                    <td>Платеж от <span
                                                id="park_rent_pay_date_fakt">{{$doc->fakt_park_rent_pays->fakt_park_rent_pay[$key]->park_rent_pay_date_fakt}}</span>
                                    </td>
                                    <td id="park_rent_pay_sum_fakt">{{$doc->fakt_park_rent_pays->fakt_park_rent_pay[$key]->park_rent_pay_sum_fakt}}</td>
                                    @endif
                                </tr>
                                <?php $key++; ?>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        @endif
        @if ($doc->type == 'parking_buy')
            <div id="dog_cl" data-id="{{$doc->id}}">
                <div class="container" id="dog_block">
                    <div id="head_block">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td id="bl_nav_tit">Состояние документов</td>
                                <td id="nav_but_fav" class="off_fav">&nbsp;</td>
                            </tr>
                        </table>
                    </div>

                    <div id="block_body">

                        <div id="park_buy_num">{{$doc->park_buy_num}}</div>
                        @if ($doc->park_buy_date_in != 0)
                        <div class="doc_inf">
                            <span>Дата подачи документов в Главстрой-СПб для регистрации договора</span><span
                                    id="park_buy_date_in" class="gb_right doc_date">{{$doc->park_buy_date_in}}</span>
                        </div>
                        @endif
                        @if ($doc->park_buy_date_in_reg != 0)
                        <div class="doc_inf">
                            <span>Дата подачи документов на регистрацию договора в Росреестр</span><span
                                    id="park_buy_date_in_reg"
                                    class="gb_right doc_date">{{$doc->park_buy_date_in_reg}}</span></div>
                        @endif
                        @if ($doc->park_buy_date_reg != 0)
                        <div class="doc_inf"><span>Дата регистрации права собственности</span><span
                                    id="park_buy_date_reg" class="gb_right doc_date">{{$doc->park_buy_date_reg}}</span>
                        </div>
                        @endif
                        @if ($doc->park_buy_sum != 0)
                        <div id="ds_doc_save" class="col-lg-6 col-md-6 col-sm-6">
                            <div class="doc_inf"><span>Стоимость договора</span><span id="park_buy_sum"
                                                                                      class="money prs_right">{{$doc->park_buy_sum}}</span>
                            </div>
                        </div>
                        @endif
                        @if ($doc->park_buy_sum_ost != 0)
                        <div id="ds_doc_save" class="col-lg-6 col-md-6 col-sm-6">
                            <div class="doc_inf"><span>Текущая задолженность</span><span id="park_buy_sum_ost"
                                                                                         class="money prs_right">{{$doc->park_buy_sum_ost}}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        @if ($doc->type == 'flat_booking')
            <div id="dog_cl" data-id="{{$doc->id}}">

                <div class="container" id="dog_block">
                    <div id="head_block">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td id="bl_nav_tit">Информация по текущим сделкам</td>
                                <td id="nav_but_fav" class="off_fav">&nbsp;</td>
                            </tr>
                        </table>
                    </div>

                    <div id="block_body">

                        <div id="managers">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div>Ваш персональный менеджер:</div>
                                <div class="man_photo"><img src="./images/manager.png" width="70"/></div>
                                <div id="reserv_men_fio" class="man_name">{{$doc->reserv_men_fio}}</div>
                                <div class="man_cont"><a href="#"><img src="images/images.png" width="25"/><span> Раб. тел.:</span><span
                                                id="reserv_men_wt" class="ict_right">{{$doc->reserv_men_wt}}</span></a></div>
                                <div class="man_cont"><a href="#"><img src="images/images.png" width="25"/><span> Моб. тел.:</span><span
                                                id="reserv_men_mt" class="ict_right">{{$doc->reserv_men_mt}}</span></a></div>
                                <div class="man_cont"><a href="#"><img src="images/email.png"
                                                                       width="25"/><span> E-mail:</span><span
                                                id="reserv_men_mail" class="ict_right">{{$doc->reserv_men_mail}}</span></a>
                                </div>
                            </div>
                            @if (!empty ($doc->reserv_ip_men_fio))
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div>Ваш персональный менеджер по ипотеке:</div>
                                <div class="man_photo"><img src="./images/manager.png" width="70"/></div>
                                <div id="reserv_ip_men_fio" class="man_name">{{$doc->reserv_ip_men_fio}}</div>
                                <div class="man_cont"><a href="#"><img src="images/images.png" width="25"/><span> Раб. тел.:</span><span
                                                id="reserv_ip_men_wt" class="ict_right">{{$doc->reserv_ip_men_wt}}</span></a>
                                </div>
                                <div class="man_cont"><a href="#"><img src="images/email.png"
                                                                       width="25"/><span> E-mail:</span><span
                                                id="reserv_ip_men_mail" class="ict_right">{{$doc->reserv_ip_men_mail}}</span></a></div>
                            </div>
                            @endif
                        </div>
                        <!-- reserv list -->
                        <table id="ict_res" border="0" cellspacing="0" cellpadding="10"
                               class="col-lg-12 col-md-12 col-sm-12">
                            <tr>
                                <td class="col-lg-8 col-md-8 col-sm-8">Ваша забронированная квартира</td>
                                <td align="center">Бронь будет снята утром</td>
                            </tr>

                            <tr>
                                <td class="col-lg-8 col-md-8 col-sm-8" id="reserv_id">Северная Долина 9 СД 9 оч 3-19
                                    корп №158
                                </td>
                                <td align="center" id="reserv_end_date">26.05.2016</td>
                            </tr>
                            <tr>
                                <td class="col-lg-8 col-md-8 col-sm-8" id="reserv_id">Северная Долина 9 СД 9 оч 3-19
                                    корп №158
                                </td>
                                <td align="center" id="reserv_end_date">26.05.2016</td>
                            </tr>
                        </table>

                        <div id="ict_app" class="row">
                            @foreach($doc->deals as $deal)
                                <?php $deal = $deal->deal; ?>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div>Дата Вашей встречи:</div>
                                <div class="meet_time">
                                    <div id="meet_date">{{$deal->deal_date}}</div>
                                    <div id="meet_date_time">{{$deal->deal_date_time}}</div>
                                </div>
                            </div>
                            @endforeach

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div>Памятка по регистрации договора участия в долевом строительстве</div>
                                <div><a target="_blank" href="/upload/pamytka.pdf"><img src="images/save.png" width="45"/></a></div>
                            </div>

                        </div>

                        <!--<div id="ict_app">
                            <div>Задать вопрос Вашему персональному менеджеру</div>
                            <input type="text" class="form-control" id="exampleInputText"
                                   placeholder="Введите текст обращения">
                            <div id="sai_but" align="center">
                                <button type="submit" class="btn btn-lg btn-primary">Отправить запрос</button>
                            </div>
                        </div>-->

                    </div>
                </div>
            </div>

        @endif

        @if ($doc->type == 'flat_completed' or $doc->type == 'flat_under_construction')
            <div id="dog_cl" data-id="{{$doc->id}}">

                <div class="container" id="dog_block">
                    <div id="head_block">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td id="bl_nav_tit">Информация по договору</td>
                                <td id="nav_but_fav" class="on_fav">&nbsp;</td>
                                <td id="nav_but_colexp" class="bl_col">&nbsp;</td>
                            </tr>
                        </table>
                    </div>

                    <div id="block_body">

                        <div id="subject_dog">{{$doc->subject_dog}}</div>
                        <div>Договор № <span id="doc_id">109/26-14ЮД</span> от <span
                                    id="date_dog">{{$doc->date_dog}}</span>г.
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4" id="bild_compl" align="center">
                            <div>Готовновсть корпуса</div>
                            <div id="readiness">{{$doc->readiness}}</div>
                        </div>


                        <div id="sec_pan" class="col-lg-8 col-md-8 col-sm-8 right_block">

                            <table width="100%" border="0" cellspacing="10" cellpadding="0">
                                <tr>
                                    <td><span>Корпус сдается</span></td>
                                    <td id="plandate" align="right"><span>{{$doc->plandate}}</span></td>
                                </tr>
                                <tr>
                                    <td><span>Форма оплаты</span></td>
                                    <td id="payform_dog" align="right"><span>{{$doc->payform_dog}}</span></td>
                                </tr>
                                <!-- Выводится только при форме оплаты "Ипотека"
                                <tr>
                                  <td><span>Банк</span></td>
                                  <td id="ipot_bank" align="right"><span></span></td>
                                </tr>
                                -->
                            </table>

                            <div class="but_block">
                                
                                <p id="korp_progress" class="rb_but lead" align="center"><a
                                            href="http://yuntolovo-spb.ru/gallery/building-progress/1-ya-ochered/"
                                            target="_blank">Ход строительства</a></p>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="container" id="dog_block">
                    <div id="head_block">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td id="bl_nav_tit">График платежей</td>
                                <td id="nav_but_fav" class="off_fav">&nbsp;</td>
                                <td id="nav_but_colexp" class="bl_col">&nbsp;</td>
                            </tr>
                        </table>
                    </div>

                    <div id="block_body">

                        <div id="planpays">

                            <?php $counter = 0; ?>
                            @foreach($doc->planpays->planpay as $key=>$pay)
                                <?php $counter++; ?>
                                <div id="planpay" class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4">Платеж № <span
                                                id="lanpay_num">{{$pay->planpay_num}}</span> от <span
                                                id="planpay_date">{{$pay->planpay_date}}</span>г.
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12 money"
                                         id="planpay_sum">{{$pay->planpay_sum}}</div>
                                    @if ($counter == count ($doc->planpays->planpay) and count ($doc->planpays->planpay) > 1)
                                        <div class="col-lg-4 col-md-4 col-sm-4" id="gen_bill">
                                            <span>Сформировать счет</span></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        
                        
<div id="sec_pan" class="col-lg-12 col-md-12 col-sm-12 right_block">
	<div class="rb_pl"><span class="rb_left">Сумма договора</span> <span id="sum_dog" class="money rb_right">{{$doc->sum_dog}}</span></div><p></p>
	<div class="rb_pl"><span class="rb_left">Осталось погасить по договору</span> <span id="ost_sum_dog" class="money rb_right">{{$doc->ost_sum_dog}}</span></div>
</div>

                    </div>
                </div>

                <!--generate bill-->
                <div class="gen_bill">
                    <div class="container" id="dog_block">
                        <div id="head_block">
                            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                    <td id="bl_nav_tit">Счет на оплату</td>
                                    <td id="bl_save">&nbsp;</td>
                                    <td id="bl_print">&nbsp;</td>
                                    <td id="bl_close">&nbsp;</td>
                                </tr>
                            </table>
                        </div>

                        <div id="block_body">

                            <div id="name_comp">
                                <div class="gb_inf"><span>Получатель</span><span id="bill_corp" class="gb_right">ООО «Главстрой-СПб»</span>
                                </div>
                                <div class="gb_inf"><span>Банк получателя</span><span id="bill_bank" class="gb_right">Северо-Западный банк «ПАО Сбербанк»</span>
                                </div>
                            </div>

                            <div id="bank_details">
                                <div class="gb_inf"><span>ИНН</span><span id="bill_inn"
                                                                          class="gb_right">7839347260</span></div>
                                <div class="gb_inf"><span>КПП</span><span id="bill_kpp"
                                                                          class="gb_right">783450001</span></div>
								<div class="gb_inf"><span>ОГРН</span><span id="bill_kpp"
                                                                          class="gb_right">1069847534360</span></div>
                                <div class="gb_inf"><span>БИК</span><span id="bill_bik"
                                                                          class="gb_right">044030653</span></div>
                                <div class="gb_inf"><span>Кор. счет</span><span id="bill_korsh" class="gb_right">30101810500000000653</span>
                                </div>
                                <div class="gb_inf"><span>Расчетный счет</span><span id="bill_rassh" class="gb_right">40702810655200001599</span>
                                </div>
                            </div>

                            <div id="pay_details">
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <div>Назначение платежа</div>
                                    <div class="lead">Договор № <span id="num_dog">476/17-20-1003Д/ИА</span> от <span
                                                id="date_dog">24.12.2015</span>г.
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5" align="center">
                                    <div>Сумма платежа</div>
                                    <div class="lead"><span id="gb_purp_pay" class="money"></span></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container" id="dog_block">
                    <div id="head_block">
                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td id="bl_nav_tit">Состояние документов</td>
                                <td id="nav_but_fav" class="off_fav">&nbsp;</td>
                                <td id="nav_but_colexp" class="bl_col">&nbsp;</td>
                            </tr>
                        </table>
                    </div>

                    <div id="block_body">

                        @if ($doc->doc_date_in_frs != 0)
                            <div class="doc_inf">
                                <span>Дата подачи документов в Главстрой-СПб для регистрации договора</span><span
                                        id="doc_date_in_frs"
                                        class="gb_right doc_date">{{$doc->doc_date_in_frs}}</span></div>@endif
                        @if ($doc->doc_date_out_frs != 0)
                            <div class="doc_inf">
                                <span>Дата подачи документов на регистрацию договора в Росреестр</span><span
                                        id="doc_date_out_frs"
                                        class="gb_right doc_date">{{$doc->doc_date_out_frs}}</span></div> @endif
                        @if ($doc->doc_date_reg_comp != 0)
                            <div class="doc_inf"><span>Дата получения документов с регистрации</span><span
                                        id="doc_date_reg_comp"
                                        class="gb_right doc_date">{{$doc->doc_date_reg_comp}}</span>
                            </div>@endif
                        @if ($doc->doc_date_reg != 0)
                            <div class="doc_inf"><span>Дата регистрации</span><span id="doc_date_reg"
                                                                                    class="gb_right doc_date">{{$doc->doc_date_reg}}</span></div>@endif

                                <div id="sec_pan" class="col-lg-12 col-md-12 col-sm-12 right_block">
                                    <div class="col-lg-4 col-md-4 col-sm-4"><p>ЕДИНОВРЕМЕННАЯ ОПЛАТА ИЛИ РАССРОЧКА. КВАРТИРА В СТРОЕЩЕМСЯ ДОМЕ</p>
                                        <p><a target="_blank" href="/upload/pam_100_ras.pdf"><img src="images/ds_save.png" width="45"/></a></p></div>
                                    <div class="col-lg-4 col-md-4 col-sm-4"><p>ВОЕННАЯ ИПОТЕКА. КВАРТИРА В СТРОЯЩЕМСЯ ДОМЕ</p>
                                        <p><a target="_blank" href="/upload/voen.pdf"><img src="images/ds_save.png" width="45"/></a></p></div>
                                    <div class="col-lg-4 col-md-4 col-sm-4"><p>ИПОТЕКА. КВАРТИРА В СТРОЯЩЕМСЯ ДОМЕ</p>
                                        <p><a target="_blank" href="/upload/ipot.pdf"><img src="images/ds_save.png" width="45"/></a></p></div>
                                </div>

                            </div>

                    </div>
                    @if ($doc->type == 'flat_completed')
                        <div class="container" id="dog_block">
                            <div id="head_block">
                                <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                    <tr>
                                        <td id="bl_nav_tit">Информация по передаче квартиры</td>
                                        <td id="nav_but_fav" class="off_fav">&nbsp;</td>
                                        <td id="nav_but_colexp" class="bl_col">&nbsp;</td>
                                    </tr>
                                </table>
                            </div>

                            <div id="block_body">

                                <div id="subject_dog">{{$doc->subject_dog}}</div>

                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <p id="at_kv_inf"><span>Адрес:</span><span id="miladr"
                                                                               class="at_right">{{$doc->miladr}}</span>
                                    </p>
                                    <p id="at_kv_inf"><span>Номер квартиры по ПИБ:</span><span id="num_app_pib"
                                                                                               class="at_right">{{$doc->num_app_pib}}</span>
                                    </p>
                                    <div class="row">
                                        <br>
                                        <div class="col-lg-6 col-md-6 col-sm-6">Результат обмера ПИБ:
                                            <p id="at_kv_inf"><span>Общая площадь</span><span id="area_app_pib" class="at_right">{{$doc->area_app_pib}} м<sup>2</sup></span></p>
                                            <p id="at_kv_inf"><span>Балкон/Лоджия</span><span id="area_terr_pib"
                                                                                              class="at_right">{{$doc->area_terr_pib}} м<sup>2</sup></span></p>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">Проектные размеры:
                                            <p id="at_kv_inf"><span>Общая площадь</span><span id="area_app"
                                                                                              class="at_right">{{$doc->area_app}} м<sup>2</sup></span></p>
                                            <p id="at_kv_inf"><span>Балкон/Лоджия</span><span id="area_terr"
                                                                                              class="at_right">{{$doc->area_terr}} м<sup>2</sup></span></p>
                                        </div>
                                    </div>
                                </div>

                                <div id="sec_pan" class="col-lg-4 col-md-4 col-sm-4 at_res">
                                    <div class="right_block container-fluid">
                                        <div>Общая площадь квартиры <span id="inc_area">увеличена</span><span id="red_area">уменьшена</span> на:</div>
                                        <div id="at_r_area" align="center" class="lead"><span
                                                    id="pib_diff">{{doubleval($doc->pib_diff)}}</span>м<sup>2</sup>
                                        </div>
                                        <div>Сумма <span id="inc_area_sum">доплаты</span><span id="red_area_sum">возврата</span>:</div>
                                        <div id="at_r_area" align="center" class="lead"><span
                                                    id="summ_diff">{{$doc->summ_diff}}</span>
                                        </div>
                                        <!--<div><p>Памятка получения ключей</p>
                                            <p><a href="#"><img src="images/ds_save.png" width="45"/></a></p></div>-->
                                    </div>
                                </div>

                            </div>

                        </div>

                    @endif

                </div>
                @endif
                @endforeach

            </div>

            <div id="test"></div>
            <!-- /container -->
            <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
            <script src="./js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>