<?php

namespace Breadlesscode\Office\Programs;

abstract class Program
{
    protected static $handableExtensions = [];
    protected static $possibleConversions = [];

    public static function canHandleExtension(string $extensionToHandle): bool
    {
        $extensionToHandle = strtolower($extensionToHandle);

        foreach (static::$handableExtensions as $extension) {
            if ($extensionToHandle === $extension) {
                return true;
            }
        }

        return false;
    }

    public static function canConvertTo(string $convertToExtension): bool
    {
        $convertToExtension = strtolower($convertToExtension);

        foreach (static::$possibleConversions as $extension) {
            if ($convertToExtension === $extension) {
                return true;
            }
        }

        return false;
    }
}
