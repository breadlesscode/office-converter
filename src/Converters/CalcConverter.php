<?php
namespace Breadlesscode\Office\Converters;

class CalcConverter extends AbstractConverter
{
    protected static $handableExtensions = [
        'xls', 'ods', 'numbers', 'dif', 'gnm',
        'gnumeric', 'wk1', 'wks', '123', 'wk3',
        'wk4', 'xlw', 'xlt', 'pxl', 'wb2', 'wq1',
        'wq2', 'sdc', 'vor', 'slk', 'xlts', 'xlsm',
        'xlsx'
    ];

    protected static $possibleConversions = [
        'jpg', 'jpeg', 'png', 'pdf',  'html'
    ];
}
