<?php

namespace Breadlesscode\Office\Programs;

class WriterProgram extends Program
{
    protected static $handableExtensions = [
        'doc', 'docx', 'odt', 'pdf', 'dot', 'wri',
        '602', 'txt', 'sdw', 'sgl', 'vor', 'wpd',
        'wps', 'html', 'htm', 'jdt', 'jtt', 'hwp',
        'pdb', 'pages', 'cwk', 'rtf'
    ];

    protected static $possibleConversions = [
        'jpg', 'jpeg', 'png', 'pdf', 'txt', 'html'
    ];
}
