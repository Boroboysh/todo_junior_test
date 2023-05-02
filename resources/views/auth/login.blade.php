@extends('main')

@section('title', 'Логин')

@section('guest-content')
    <h3 style="margin-top: 1rem;">Вход</h3>
    @if ($errors->any())
        <div class="alert" >
            @foreach ($errors->all() as $error)
                <div class="alert-error">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{ route('auth.sign-in') }}" method="post">
        @csrf
        <div>
            <label for="email">E-mail</label>
            <input type="text"
                   name="email"
                   required
                   class="@error('email')is-invalid @enderror"
            />
        </div>
        <div>
            <label for="password">Пароль</label>
            <input name="password"
                   type="password"
                   minlength="6"
                   required
                   class="@error('password')is-invalid @enderror"
            />
        </div>
        <input type="submit" value="Отправить"/>
    </form>
@endsection
