<?php

namespace Spatie\ThereThere\Enums;

enum SidebarItemType: string
{
    case Numeric = 'numeric';
    case Markdown = 'markdown';
    case Date = 'date';
    case Boolean = 'boolean';
    case Url = 'url';
}
