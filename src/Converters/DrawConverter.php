<?php

namespace Breadlesscode\Office\Converters;

class DrawConverter extends AbstractConverter
{
    protected static $handableExtensions = [
        'svg', 'odg'
    ];

    protected static $possibleConversions = [
        'jpg', 'jpeg', 'png', 'pdf', 'txt', 'html'
    ];
}
