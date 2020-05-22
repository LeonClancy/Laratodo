@extends('layouts.app')

@section('content')
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
                                    <form action="">
                                        <button class="btn btn-wanring"
                                                type="submit"
                                                name="complete"
                                                value="0">
                                            還原
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
