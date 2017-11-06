<?php

namespace Breadlesscode\Office\Programs;

class DrawProgram extends Program
{
    protected static $handableExtensions = [
        'svg', 'odg'
    ];

    protected static $possibleConversions = [
        'jpg', 'jpeg', 'png', 'pdf', 'txt', 'html'
    ];
}
