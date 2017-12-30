<?php
namespace Breadlesscode\Office;

class File
{
    protected $original = null;
    protected $extension = null;
    protected $directory = null;
    protected $name = null;
    protected $type = null;

    public function __construct(string $file, string $type = null)
    {
        if (!file_exists($file)) {
            throw new \Exception("File '${file}'' not found!", 1);
        }

        $this->original = $file;
        $pathInfo = pathinfo($file);
        $pathInfo['extension'] = isset($pathInfo['extension']) ? $pathInfo['extension'] : null;
        // using php 7.1 array destruction
        [
            'extension' => $this->extension,
            'dirname' => $this->directory,
            'basename' => $this->name
        ] = $pathInfo;
        $this->type = $type ?? $pathInfo['extension'];
    }

    public function getDirectory(): string
    {
        return $this->directory;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
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
