@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        新增 Todo
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('task.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">任務</label>
                                <div class="col-md-6">
                                    <input
                                        name="name"
                                        type="text"
                                        value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            新增
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        任務列表
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <th>&nbsp;</th>
                            <th class="w-50">Todo</th>
                            <th>選項</th>
                            <th>&nbsp;</th>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>
                                        <form action="{{ route('task.complete', $task->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-success" type="submit">
                                                完成
                                            </button>
                                        </form>
                                    </td>
                                    <td class="table-text">
                                        {{ $task->name }}
                                    </td>
                                    <td>
                                        <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                刪除
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('task.edit', $task->id) }}">
                                            <button class='btn btn-warning'>
                                                編輯
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
