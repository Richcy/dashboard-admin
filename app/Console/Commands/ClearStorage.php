<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ClearStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all files in the public storage folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Read the .gitignore file and get the list of patterns to ignore
        $gitignore = file(base_path('.gitignore'), FILE_IGNORE_NEW_LINES);
        $gitignore = array_map('trim', $gitignore); // Clean up the lines

        // Filter out any empty lines and comments (lines starting with #)
        $gitignore = array_filter($gitignore, function ($line) {
            return !empty($line) && $line[0] !== '#';
        });

        // Get all files in the 'public' disk
        $publicFiles = Storage::disk('public')->allFiles();

        // Delete files in the public disk, excluding .gitignore files
        foreach ($publicFiles as $file) {
            // Check if the file matches any pattern in .gitignore
            if ($this->isIgnored($file, $gitignore)) {
                continue; // Skip this file if it's in the .gitignore
            }
            Storage::disk('public')->delete($file);
        }

        // Get all files in the 'private' disk
        $privateFiles = Storage::disk('local')->allFiles();

        // Delete files in the private disk, excluding .gitignore files
        foreach ($privateFiles as $file) {
            // Check if the file matches any pattern in .gitignore
            if ($this->isIgnored($file, $gitignore)) {
                continue; // Skip this file if it's in the .gitignore
            }
            Storage::disk('local')->delete($file);
        }

        $this->info('All files in public and private storage have been deleted, excluding those listed in .gitignore.');
    }

    /**
     * Check if a file is ignored based on .gitignore patterns.
     *
     * @param string $file
     * @param array $gitignore
     * @return bool
     */
    protected function isIgnored($file, $gitignore)
    {
        foreach ($gitignore as $pattern) {
            // If the file matches any of the patterns, it's ignored
            if (fnmatch($pattern, $file)) {
                return true;
            }
        }
        return false;
    }
}
