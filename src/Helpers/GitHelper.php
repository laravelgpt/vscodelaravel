<?php

namespace LaravelGpt\Vscode\Helpers;

class GitHelper
{
    /**
     * Format Git status output for better readability
     *
     * @param string $statusOutput
     * @return array
     */
    public static function formatStatusOutput(string $statusOutput): array
    {
        $lines = explode("\n", trim($statusOutput));
        $formatted = [];
        
        foreach ($lines as $line) {
            if (!empty($line)) {
                $formatted[] = [
                    'status' => substr($line, 0, 2),
                    'file' => substr($line, 3)
                ];
            }
        }
        
        return $formatted;
    }

    /**
     * Parse Git log output
     *
     * @param string $logOutput
     * @return array
     */
    public static function parseLogOutput(string $logOutput): array
    {
        $lines = explode("\n", trim($logOutput));
        $commits = [];
        
        foreach ($lines as $line) {
            if (!empty($line)) {
                $parts = explode(' ', $line, 2);
                $commits[] = [
                    'hash' => $parts[0],
                    'message' => $parts[1] ?? ''
                ];
            }
        }
        
        return $commits;
    }
}