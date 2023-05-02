@extends('main')

@section('title', 'Список задач')

@section('content')
    <div class="new_task">
        <button>
            <a href="{{route('todo.create')}}">Создать новую задачу +</a>
        </button>
    </div>

    <section class="sort-wrap">
        <span class="sort-wrap-title">Сортировать по:</span>
        <div class="sort">
            <div class="sort_created_date">
                <span> <a
                        href="{{ route('todo.index') }}?sortTo=created_at&order=asc">Дате добавления (по возрастанию)</a> </span>
                <span> <a
                        href="{{ route('todo.index') }}?sortTo=created_at&order=desc">Дате добавления (по убыванию)</a> </span>
            </div>
            <div class="sort_update_date">
                <span> <a
                        href="{{ route('todo.index') }}?sortTo=updated_at&order=asc">Дате изменения (по возрастанию)</a> </span>
                <span> <a href="{{ route('todo.index') }}?sortTo=updated_at&order=desc">Дате изменения (по убыванию)</a> </span>
            </div>
        </div>
    </section>
    <section class="tasks-wrap">
        <h3>Список задач:</h3>
        @if(count($tasks) == 0)
            <div class="tasks-idle">Задач пока нет...</div>
        @else
            @foreach($tasks as $task)
                <div class="task">
                    <h4 class="task-title">
                        <a href="{{ route('todo.show', ['todo' => $task->id]) }}">
                            {{ $task->title }}
                        </a>
                    </h4>
                    <div class="task-status">
                        Статус:
                        @if($task->status)
                            <span class="task-status-done">Выполнено</span>
                        @else
                            <span class="task-status-idle">В работе</span>
                        @endif
                    </div>

                    <section class="task-dates">
                        @if($task->created_at != $task->updated_at)
                            <div class="task-update_date"> Последнее изменение: {{ $task->updated_at }}</div>
                        @endif

                        <div class="task-create_date">
                            Создано: {{ $task->created_at }}
                        </div>
                    </section>
                    <div class="task-buttons">
                        <button class="task-buttons-delete">
                            <a href="{{ route('todo.destroy', ['id' => $task->id]) }}">Удалить</a>
                        </button>
                        <button class="task-buttons-edit">
                            <a href="{{ route('todo.edit', ['todo' => $task->id]) }}">Редактировать</a>
                        </button>
                    </div>
                </div>
            @endforeach
        @endif
    </section>

@endsection
