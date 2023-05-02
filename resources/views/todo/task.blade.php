@extends('main')

@section('title', 'Просмотр задачи')

@section('content')
    <section class="current-task-wrap">
        <button>
            <a href="{{route('todo.index')}}" class="back-to-home">
                Вернуться ко всем задачам
            </a>
        </button>

        <div class="current-task-wrap-title">
            <span> {{ $task->title  }}  </span>
        </div>

        <div class="current-task-wrap-status">
            <span class="current-task-wrap-status-subtitle">Статус:</span>
            @if($task->status == null)
                <span class="task-status-idle"> В работе... </span>
            @else
                <span class="task-status-done"> Выполнено </span>
            @endif
        </div>

        <div class="current-task-wrap-description">
            <span class="current-task-wrap-description-subtitle"> Описание:</span>
            <span class="current-task-wrap-description-text">{{ $task->description ?? 'Отсутствует'}} </span>
        </div>
    </section>
@endsection
