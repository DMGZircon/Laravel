@extends('layout')

{{-- @section('title', 'Home') --}}

@section('content')
    {{-- <style>
        .task-done {
            background-color: #8fe3a3;
            border-color: #43c561;
        }
        .task-done span {
            font-weight: bold;
        }
    </style> --}}

    <title>To-Do List</title>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="name" class="form-control d-inline w-50" placeholder="Enter a new Task">
        <button type="submit" class="btn btn-primary">Add Task</button>
    </form>

    <ul class="list-group mt-4">
        @foreach ($tasks as $t)
            <li class="list-group-item d-flex justify-content-between align-items-center 
                @if($t->is_done) task-done @endif">
                <span>{{ $t->name }}</span>
                <div class="d-flex gap-2">
                    <form action="{{ route('tasks.toggle', $t->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-success btn-sm mark-done">✔</button>
                    </form>

                    <button class="btn btn-warning btn-sm edit-task" data-id="{{ $t->id }}" data-name="{{ $t->name }}" data-is_done="{{ $t->is_done }}">✏</button>

                    <form action="{{ route('tasks.destroy', $t->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm delete-task">🗑</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTaskForm">
                        <input type="text" class="form-control" id="taskName" name="name" placeholder="Edit task" required>
                        <div class="mt-3">
                            <label for="is_done" class="form-label">Mark as Done?</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_done" name="is_done">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveTaskChanges">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.edit-task').forEach(button => {
                button.addEventListener('click', function () {
                    const taskId = this.getAttribute('data-id');
                    const taskName = this.getAttribute('data-name');
                    const isDone = this.getAttribute('data-is_done') === '1';

                    document.getElementById('taskName').value = taskName;
                    document.getElementById('is_done').checked = isDone;

                    const modal = new bootstrap.Modal(document.getElementById('editTaskModal'));
                    modal.show();

                    document.getElementById('saveTaskChanges').addEventListener('click', function () {
                        const newName = document.getElementById('taskName').value;
                        const newStatus = document.getElementById('is_done').checked;

                        fetch(`/tasks/${taskId}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                _method: 'PUT',
                                name: newName,
                                is_done: newStatus
                            })
                        }).then(() => location.reload());
                    });
                });
            });

            document.querySelectorAll('.mark-done').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    this.closest('form').submit();
                });
            });
        });
    </script>
@endsection
