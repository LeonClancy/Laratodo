@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        編輯 Todo
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('task.update', $task->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">任務</label>
                                <div class="col-md-6">
                                    <input
                                        name="name"
                                        type="text"
                                        class="form-control"
                                        value="{{ $task->name }}">
                                </div>
                            </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-warning">
                                            編輯
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
@endsection
