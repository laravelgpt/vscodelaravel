<?php

// Example usage of the VS Code Laravel Git package

require_once __DIR__ . '/../vendor/autoload.php';

use YourVendor\VscodeLaravelGit\VscodeLaravelGit;
use YourVendor\VscodeLaravelGit\DataTransferObjects\GitResult;

// Initialize the Git client
$git = new VscodeLaravelGit();

try {
    // Get current branch
    $branchResult = $git->getCurrentBranch();
    if ($branchResult->isSuccess()) {
        echo "Current branch: " . trim($branchResult->stdout) . "\n";
    } else {
        echo "Error getting current branch: " . $branchResult->stderr . "\n";
    }

    // Get Git status
    $statusResult = $git->getStatus();
    if ($statusResult->isSuccess()) {
        if (empty(trim($statusResult->stdout))) {
            echo "Working directory is clean\n";
        } else {
            echo "Modified files:\n";
            $lines = $statusResult->getLines();
            foreach ($lines as $line) {
                if (!empty($line)) {
                    echo "  " . $line . "\n";
                }
            }
        }
    } else {
        echo "Error getting status: " . $statusResult->stderr . "\n";
    }

    // Get Git log
    $logResult = $git->getLog();
    if ($logResult->isSuccess()) {
        echo "Recent commits:\n";
        $commits = $logResult->getLines();
        foreach ($commits as $commit) {
            if (!empty($commit)) {
                echo "  " . $commit . "\n";
            }
        }
    } else {
        echo "Error getting log: " . $logResult->stderr . "\n";
    }

} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}