<?php

namespace LaravelGpt\Vscode\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelGpt\Vscode\VscodeLaravelGit;

class GitController extends Controller
{
    protected $git;

    public function __construct(VscodeLaravelGit $git)
    {
        $this->git = $git;
    }

    public function status()
    {
        $result = $this->git->getStatus();
        return response()->json($result);
    }

    public function commit()
    {
        $message = request()->input('message');
        $files = request()->input('files', []);
        
        if (!empty($files)) {
            $this->git->stageFiles($files);
        }
        
        $result = $this->git->commit($message);
        return response()->json($result);
    }

    public function push()
    {
        $result = $this->git->push();
        return response()->json($result);
    }

    public function pull()
    {
        $result = $this->git->pull();
        return response()->json($result);
    }

    public function branches()
    {
        $result = $this->git->getBranches();
        return response()->json($result);
    }
}