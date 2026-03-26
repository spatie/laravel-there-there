<?php

namespace Spatie\ThereThere;

enum SidebarItemType: string
{
    case Numeric = 'numeric';
    case Markdown = 'markdown';
    case Date = 'date';
    case Boolean = 'boolean';
}
