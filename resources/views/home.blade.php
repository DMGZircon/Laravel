        @extends('layout')

        @section('title', 'Home')

        @section('content')
            <div class="text-center">
                <h2>Here are your current task</h2>
                <p>Press the "✔" button to mark tasks as done</p>
                <p>Press the "✏" button to edit the task</p>
                <p>Press the "🗑" button to delete the task</p>

            <form action="{{route('tasks.store')}}" method="POST">
                @csrf
                <input type="text" name="tasks" class="form-control d-inline w-50" placeholder="Enter a new Task" required>
                <button type="submit" class="btn btn-primary">Add Task</button>
            </form>
            
                <ul class="list-group">
                    @foreach ($tasks as $t)
                    <li class="list-group-item d-flex justify-content-start align-items-center">
                        <span>{{$t->name}} (Status: {{$t->is_done ? 'Done' : 'Not Done'}})</span>
                        <div class="d-flex gap-2">
                            <form action="{{route('tasks.toggle', $t->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-primary btn-sm mark-done">✔</button>
                            </form>
                            <button class="btn btn-warning btn-primary btn-sm  edit-task" data-id="{{$t->id}}" data-name="{{$t->name}}">✏</button>
                            <form action="{{route('tasks.destroy', $t->id )}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                            <button class="btn btn-primary btn-danger btn-sm delete-task">🗑</button>
                            </form>
                    </li>
                    @endforeach
                </ul>
                </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.edit-task').forEach(button => {
                        button.addEventListener('click', function() {
                            let taskId = this.getAttribute('data-id');
                            let oldName = this.getAttribute('data-name');
                            let newName = prompt("Edit your task:", oldName);
                                if (newName && newName.trim() !== '') {
                                    fetch(`/tasks/${taskId}`, {
                                        method: 'PUT',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                                        },
                                        body: JSON.stringify({
                                            _method: 'PUT',
                                            name: newName
                                        })
                                    }).then(()=>location.reload());
                                }
                        });
                });
            });
        </script>

        @endsection