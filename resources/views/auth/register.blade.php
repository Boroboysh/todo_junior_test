@extends('main')

@section('title', 'Регистрация')

@section('guest-content')
    <h3 style="margin-top: 1rem;">Регистрация</h3>

    @if ($errors->any())
        <div class="alert" >
            @foreach ($errors->all() as $error)
                <div class="alert-error">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('auth.register') }}" method="post">
        @csrf
        <div>
            <label for="name">Имя</label>
            <input type="text"
                   name="name"
                   required
                   class="@error('name')is-invalid @enderror"
            />
        </div>
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
