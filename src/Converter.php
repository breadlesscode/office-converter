<?php
namespace Breadlesscode\Office;

use Breadlesscode\Office\Exception\ConverterException;
use Spatie\TemporaryDirectory\TemporaryDirectory;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Converter
{
    public static $converters = [
        \Breadlesscode\Office\Converters\WriterConverter::class,
        \Breadlesscode\Office\Converters\CalcConverter::class,
        \Breadlesscode\Office\Converters\ImpressConverter::class,
        \Breadlesscode\Office\Converters\DrawConverter::class
    ];

    protected $paramters = ['--headless'];
    protected $file = null;
    protected $converter = null;
    protected $binaryPath = 'libreoffice';
    protected $temporaryPath = 'temp';
    protected $timeout = 2000;

    public function __construct(string $file, string $fileType = null)
    {
        try {
            $file = new File($file, $fileType);
        } catch (\Exception $e) {
            throw new ConverterException($e->getMessage(), 1);
        }

        foreach (self::$converters as $converter) {
            if (!$converter::canHandleExtension($file->getType())) {
                continue;
            }

            $this->file = $file;
            $this->converter = $converter;
            break;
        }

        if ($this->file === null) {
            throw new ConverterException('Can not handle file type '.$file->getType());
        }
    }

    public static function canHandleExtension(string $fileExtension): bool
    {
        foreach (self::$converters as $converter) {
            if ($converter::canHandleExtension($fileExtension)) {
                return true;
            }
        }

        return false;
    }
    public static function file(string $file, string $fileType = null)
    {
        return new static($file, $fileType);
    }

    public function setLibreofficeBinaryPath(string $path)
    {
        $this->binaryPath = $path;

        return $this;
    }

    public function setTemporaryPath(string $path)
    {
        $this->temporaryPath = $path;

        return $this;
    }

    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function thumbnail(string $extension = 'jpg')
    {
        $this->save($this->file->getDirectory().DIRECTORY_SEPARATOR.$this->getNewFilename($extension));
    }

    public function text()
    {
        return trim($this->content('txt'));
    }

    public function save(string $path, string $extension = null): bool
    {
        $pathInfo = pathinfo($path);
        $rename = is_null($extension);

        if (is_null($extension)) {
            $extension = $pathInfo['extension'] ? $pathInfo['extension'] : $extension;
        }

        if (!$this->isConvertableTo($extension)) {
            throw new ConverterException("Invalid conversion. Can not convert ".$this->file->getType()." to ".$extension, 1);
        }


        $this->setFilter($extension);
        $this->setOutputDir($rename ? $pathInfo['dirname'] : $path);
        $this->callLibreofficeBinary();

        if ($rename) {
            // rename to new name
            $oldName = $pathInfo['dirname'].DIRECTORY_SEPARATOR.$this->getNewFilename($extension);
            $newName = $pathInfo['dirname'].DIRECTORY_SEPARATOR.$pathInfo['basename'];
            rename($oldName, $newName);
        }

        return true;
    }

    public function content(string $extension = null): string
    {
        if (!$this->isConvertableTo($extension)) {
            throw new ConverterException("Invalid conversion. Can not convert ".$this->file->getType()." to ".$extension, 1);
        }

        $tempDir = (new TemporaryDirectory(__DIR__))
            ->name('temp')
            ->force()
            ->create()
            ->empty();

        $this->setFilter($extension);
        $this->setOutputDir($tempDir->path());
        $this->callLibreofficeBinary();

        $content = file_get_contents($tempDir->path($this->getNewFilename($extension)));
        $tempDir->delete();

        return $content;
    }

    protected function getNewFilename(string $extension)
    {
        if ($this->file->getExtension() === null) {
            return $this->file->getName() . '.' . $extension;
        }

        return str_replace($this->file->getExtension(), $extension, $this->file->getName());
    }

    protected function setOutputDir(string $dir)
    {
        $this->paramters[] = '--outdir '.$this->escapeArgument($dir);
    }

    protected function setFilter(string $extension, string $filter = '')
    {
        $arg = empty($filter) ? $extension : $extension.':'.$filter;

        $this->paramters[] = '--convert-to '.$this->escapeArgument($arg);
    }

    protected function escapeArgument(string $arg): string
    {
        return escapeshellarg($arg);
    }

    protected function callLibreofficeBinary(): string
    {
        // add file to convert
        $filePath = (string) $this->file;
        $this->paramters[] = $filePath;
        // glue parameters
        $cliStr = escapeshellarg($this->binaryPath);
        $cliStr.= ' '.implode(' ', $this->paramters);
        // start convert process
        $process = (new Process($cliStr))->setTimeout($this->timeout);
        $process->run();

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }

    protected function isConvertableTo(string $extension): bool
    {
        if (is_null($extension)) {
            throw new ConverterException('No extension is set.');
        }

        return $this->converter::canConvertTo($extension);
    }
}
