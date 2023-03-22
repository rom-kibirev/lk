<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Личный кабинет клиента ООО &laquo;Главстрой-СПб&raquo;</title>
    <link href="/css/bootstrap.css" rel="stylesheet">
    <script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
    <style type="text/css">
	@media print {
        #gen_bill {
            color:rgba(0,98,152,1);
            font-weight:bold;
            cursor:pointer;
            padding-left:40px;
        }
        #gen_bill span {
            white-space:nowrap;
            background-color:rgba(255,181,0,1);
            padding:10px;
        }

        /*gen_bill_comp*/
        #name_comp {
            margin-bottom:15px;
        }
        #bank_details {
            margin-bottom:15px;
        }
        .gb_inf {
            background-image:url(/images/dtbg_blue.png);
            background-repeat:repeat-x;
            background-position:left 20px;
            padding-top:5px;
            padding-bottom: 5px;
            height:30px;
        }
        .gb_inf span {
            background-color:rgba(255,255,255,1);
            padding-left:2px;
            padding-right:2px;
        }
        .gb_right {
            float:right;
        }
		#pay_details {
			float:left;
			margin:0px;
			padding:0px;
		}
	}
    </style>
</head>

<body>

<div id="dog_list" style="margin-top: 0">
            <div id="dog_cl" data-id="">

                <!--generate bill-->
                <div class="gen_bill" style="display: block !important;">
                    <div class="container" id="dog_block" style="display: block !important;">
                        <div id="head_block">
                            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                    <td id="bl_nav_tit">Счет на оплату</td>
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
                                    <div class="lead">Договор № <span id="num_dog">{{session('user.pay_data')
                                    ->id}}</span> от <span
                                                id="date_dog">{{session('user.pay_data')->date}}</span>г.
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5" align="center">
                                    <div>Сумма платежа</div>
                                    <div class="lead">
                                        <span id="gb_purp_pay" class="money">{{session('user.pay_data')->sum}}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        window.print();
    });
</script>
</body>
</html>