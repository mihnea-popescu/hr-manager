<?php

namespace App\Observers;

use App\Models\Application;
use App\Models\Process;

class ProcessObserver
{
    /**
     * Handle the Process "created" event.
     */
    public function created(Process $process): void
    {
        $process->generateHash();
    }

    /**
     * Handle the Process "updated" event.
     */
    public function updated(Process $process): void
    {
        if($process->status == Process::FINISHED) {
            $process->applications()
                ->where('status', Application::ACCEPTED_FOR_INTERVIEW)
                ->orWhere('status', Application::PENDING)
                ->update([
                    'status' => Application::REFUSED
                ]);
        }
    }

    /**
     * Handle the Process "deleted" event.
     */
    public function deleted(Process $process): void
    {
        //
    }

    /**
     * Handle the Process "restored" event.
     */
    public function restored(Process $process): void
    {
        //
    }

    /**
     * Handle the Process "force deleted" event.
     */
    public function forceDeleted(Process $process): void
    {
        //
    }
}
