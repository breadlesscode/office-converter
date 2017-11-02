<?php

namespace Breadlesscode\Office\Programs;

class CalcProgram extends Program
{
	protected static $handableExtensions = [
		'xls', 'ods', 'numbers', 'dif', 'gnm',
		'gnumeric', 'wk1', 'wks', '123', 'wk3',
		'wk4', 'xlw', 'xlt', 'pxl', 'wb2', 'wq1',
		'wq2', 'sdc', 'vor', 'slk'
	];

	protected static $possibleConversions = [
		'jpg', 'jpeg', 'png', 'pdf',  'html'
	];
}
