@extends('main')

@section('title', 'Задачи')

@section('content')
    <button>
        <a href="{{route('todo.index')}}" class="back-to-home">
            Вернуться ко всем задачам
        </a>
    </button>
    <h3 class="task-create_edit-title">Создать новую задачу</h3>
    @if ($errors->any())
        <div class="alert">
            @foreach ($errors->all() as $error)
                <div class="alert-error">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{route('todo.store')}}" method="post" class="task-create_edit-form-wrap">
        @csrf
        <section class="task-create_edit-form">
            <div class="task-create_edit-form-title">
                <label for="title">Заголовок:</label>
                <input type="text" name="title"/>
            </div>
            <div class="task-create_edit-form-description">
                <label for="description">Описание:</label>
                <textarea type="text" name="description"> </textarea>
            </div>
        </section>
        <input type="submit" class="task-create_edit-submit" value="Создать">
    </form>
@endsection
