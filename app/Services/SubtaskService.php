<?php

namespace App\Services;

use App\Models\SubTask;

class SubtaskService
{
    public function updateOrCreateSubtask($data, $taskId): void
    {
        $data['task_id'] = $taskId;
        if (isset($data['id'])) {
            $subtask = SubTask::find($data['id']);
            $subtask->update(
                $data,
            );
        } else {
            SubTask::create($data);
        }
    }
}
