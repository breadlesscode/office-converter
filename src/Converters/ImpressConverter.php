<?php

namespace Breadlesscode\Office\Converters;

class ImpressConverter extends AbstractConverter
{
    protected static $handableExtensions = [
        'ppt', 'pptx', 'odp', 'kth', 'key',
        'pps', 'pot', 'pcd', 'sda', 'sdd',
        'sdp', 'vor', 'pot', 'potx', 'ppsx',
        'ppsm'
    ];

    protected static $possibleConversions = [
        'jpg', 'jpeg', 'png', 'pdf', 'txt', 'html'
    ];
}
