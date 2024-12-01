<?php namespace App\Domains\SourceBlock\Jobs;

use Lucid\Units\Job;
use ZipStream\Option\Archive;
use ZipStream\ZipStream;

class CreateZipArchiveJob extends Job
{
    private string $filename;
    private Archive $archive;

    public function __construct(string $filename, Archive $archive = null)
    {
        $this->filename = $filename;

        if ($archive === NULL) {

            $archive = new Archive();
            $archive->setSendHttpHeaders(true);
        }

        $this->archive = $archive;
    }

    public function handle(): ZipStream
    {
        return new ZipStream($this->filename, $this->archive);
    }
}
