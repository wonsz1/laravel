<?php

namespace App\Repositories;

use App\User;
use App\Task;

class TaskRepository
{
    /**
     * @param User $user
     * @return Collection
     */
    public function getUserTask(User $user)
    {
        return Task::where('user_id', $user->id)
            ->orderby('created_at', 'desc')
            ->get();
    }
}