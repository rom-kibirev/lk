@extends('login')
@section('content')
    <div class="disclaimer">Вы превысли количество попыток введения пароля, попробуйте через:</div>
    <div id="banpin"><span id="resttime">{{abs (ceil((time() - ($time+3600))/60))}}</span> мин.</div>
    <div id="login_lost"><a href="login/loost">Восстановить пароль</a></div>
@endsection