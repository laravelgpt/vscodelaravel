<?php

namespace LaravelGpt\Vscode\Tests\DataTransferObjects;

use PHPUnit\Framework\Attributes\Test;
use LaravelGpt\Vscode\DataTransferObjects\GitResult;
use PHPUnit\Framework\TestCase as BaseTestCase;

class GitResultTest extends BaseTestCase
{
    #[Test]
    public function it_can_create_a_git_result()
    {
        $result = new GitResult(0, 'success output', 'error output');
        
        $this->assertEquals(0, $result->exitCode);
        $this->assertEquals('success output', $result->stdout);
        $this->assertEquals('error output', $result->stderr);
    }

    #[Test]
    public function it_can_check_if_command_was_successful()
    {
        $successResult = new GitResult(0, 'success output', '');
        $failureResult = new GitResult(1, '', 'error output');
        
        $this->assertTrue($successResult->isSuccess());
        $this->assertFalse($failureResult->isSuccess());
    }

    #[Test]
    public function it_can_get_output_as_lines()
    {
        $result = new GitResult(0, "line1\nline2\nline3", '');
        $lines = $result->getLines();
        
        $this->assertCount(3, $lines);
        $this->assertEquals('line1', $lines[0]);
        $this->assertEquals('line2', $lines[1]);
        $this->assertEquals('line3', $lines[2]);
    }
}