<?php

namespace App\Enums;

enum TaskProgressEnum : int
{
    public static function fromStatus(string $status) : int
    {
        return match ($status) {
            'new'         => 0,
            'in_progress' => 5,
            'discussion'  => 20,
            'testing'     => 70,
            'staging'     => 90,
            'completed'   => 100,
            'cancelled'   => 0,
            default       => 0,
        };
    }
}
