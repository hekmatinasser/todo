<?php

namespace App\Console\Commands;

use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Console\Command;

class TaskCompletion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'completion:tasks {--deadline=2 : Task deadline based on hours}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Completion Task after deadline';

    public function __construct(private readonly TaskRepositoryInterface $taskRepository)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->taskRepository->autoComplete($this->option('deadline'));
    }
}
