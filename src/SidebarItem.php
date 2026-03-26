<?php

namespace Spatie\ThereThere;

use DateTimeInterface;

class SidebarItem
{
    public function __construct(
        public string $name,
        public mixed $value,
        public SidebarItemType $type,
    ) {}

    public static function numeric(string $name, int|float $value): self
    {
        return new self($name, $value, SidebarItemType::Numeric);
    }

    public static function markdown(string $name, string $value): self
    {
        return new self($name, $value, SidebarItemType::Markdown);
    }

    public static function date(string $name, DateTimeInterface|string $value): self
    {
        if ($value instanceof DateTimeInterface) {
            $value = $value->format('c');
        }

        return new self($name, $value, SidebarItemType::Date);
    }

    public static function boolean(string $name, bool $value): self
    {
        return new self($name, $value, SidebarItemType::Boolean);
    }

    /** @return array{name: string, value: mixed, type: string} */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
            'type' => $this->type->value,
        ];
    }
}
