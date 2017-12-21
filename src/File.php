<?php

namespace Breadlesscode\Office;

class File
{
    protected $original = null;
    protected $extension = null;
    protected $directory = null;
    protected $name = null;

    function __construct(string $file)
    {
        if(!file_exists($file)) {
            throw new \Exception("File '${file}'' not found!", 1);
        }

        $this->original = $file;
        // using php 7.1 array destruction
        [
            'extension' => $this->extension,
            'dirname' => $this->directory,
            'basename' => $this->name
        ] = pathinfo($file);
    }

    public function getDirectory(): string
    {
        return $this->directory;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOriginal(): string
    {
        return $this->original;
    }

    public function getRealpath(): string
    {
        return realpath($this->original);
    }

    public function __toString(): string
    {
        return $this->getRealpath();
    }
}
