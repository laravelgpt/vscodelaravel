<?php

namespace LaravelGpt\Vscode\Console\Commands;

use Illuminate\Console\Command;
use LaravelGpt\Vscode\VscodeLaravelGit;

class GitStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vscode-git:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show Git status';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(VscodeLaravelGit $git)
    {
        $this->info('Getting Git status...');
        
        $result = $git->getStatus();
        
        if ($result->exitCode === 0) {
            $this->line($result->stdout);
        } else {
            $this->error($result->stderr);
        }
        
        return 0;
    }
}