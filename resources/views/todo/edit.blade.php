@extends('main')

@section('title', 'Редактирование')

@section('content')
    <button xmlns="http://www.w3.org/1999/html">
        <a href="{{route('todo.index')}}" class="back-to-home">
            Вернуться ко всем задачам
        </a>
    </button>

    <h3 class="task-create_edit-title">Редактировать</h3>
    <section>
        @if ($errors->any())
            <div class="alert" >
                @foreach ($errors->all() as $error)
                    <div class="alert-error">{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form action="{{route('todo.update', ['todo' => $task->id])}}" method="post" class="task-create_edit-form-wrap">
            @method('PUT')
            @csrf
            <section class="task-create_edit-form">
                <div class="task-create_edit-form-title">
                    <label for="title">Заголовок:</label>
                    <input type="text" name="title" value="{{$task->title}}"/>
                </div>
                <div class="task-create_edit-form-description">
                    <label for="description">Описание:</label>
                    <textarea name="description">
                        {{$task->description}}
                    </textarea>
                </div>
                <div class="task-create_edit-form-status">
                    <label class="form-label">Статус:</label>
                    <select name="status" id="" class="form-control">
                        <option value="1" @if($task->status==1) selected @endif>Выполнено</option>
                        <option value="0" @if($task->status==0) selected @endif>В работе</option>
                    </select>
                </div>
            </section>
            <input type="submit" class="task-create_edit-submit" value="Сохранить изменения">
        </form>
    </section>
@endsection
