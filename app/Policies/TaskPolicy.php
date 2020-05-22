<?php

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    /**
     * 只有當下使用者才能完成該使用者之任務
     */
    public function complete(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

    public function resume(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}
