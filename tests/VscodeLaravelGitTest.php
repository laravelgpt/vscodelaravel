<?php

namespace LaravelGpt\Vscode\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase as BaseTestCase;

class VscodeLaravelGitTest extends BaseTestCase
{
    #[Test]
    public function it_can_instantiate_the_main_class()
    {
        $git = new \LaravelGpt\Vscode\VscodeLaravelGit();
        $this->assertInstanceOf(\LaravelGpt\Vscode\VscodeLaravelGit::class, $git);
    }

    #[Test]
    public function it_can_get_the_current_branch()
    {
        $git = new \LaravelGpt\Vscode\VscodeLaravelGit();
        
        // We can't assert specific output since it depends on the environment
        // We're testing that the method returns a GitResult object
        try {
            $result = $git->getCurrentBranch();
            $this->assertInstanceOf(\LaravelGpt\Vscode\DataTransferObjects\GitResult::class, $result);
            $this->assertIsNumeric($result->exitCode);
            $this->assertIsString($result->stdout);
            $this->assertIsString($result->stderr);
        } catch (\LaravelGpt\Vscode\Exceptions\GitException $e) {
            // This is expected if we're not in a Git repository
            $this->assertStringContainsString('Git command failed', $e->getMessage());
        }
    }

    #[Test]
    public function it_can_get_git_status()
    {
        $git = new \LaravelGpt\Vscode\VscodeLaravelGit();
        
        // We can't assert specific output since it depends on the environment
        // We're testing that the method returns a GitResult object
        try {
            $result = $git->getStatus();
            $this->assertInstanceOf(\LaravelGpt\Vscode\DataTransferObjects\GitResult::class, $result);
            $this->assertIsNumeric($result->exitCode);
            $this->assertIsString($result->stdout);
            $this->assertIsString($result->stderr);
        } catch (\LaravelGpt\Vscode\Exceptions\GitException $e) {
            // This is expected if we're not in a Git repository
            $this->assertStringContainsString('Git command failed', $e->getMessage());
        }
    }
}