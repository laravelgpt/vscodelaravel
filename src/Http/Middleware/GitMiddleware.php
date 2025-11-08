<?php

namespace LaravelGpt\Vscode\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use LaravelGpt\Vscode\VscodeLaravelGit;

class GitMiddleware
{
    protected $git;

    public function __construct(VscodeLaravelGit $git)
    {
        $this->git = $git;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Add Git information to the request
        $request->attributes->set('git_branch', $this->git->getCurrentBranch()->stdout);
        $request->attributes->set('git_status', $this->git->getStatus()->stdout);
        
        return $next($request);
    }
}