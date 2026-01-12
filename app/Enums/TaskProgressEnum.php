<?php

namespace App\Enums;

enum TaskProgressEnum : int
{
    public static function fromStatus(string $status) : int
    {
        return match ($status) {
            'new'         => 0,
            'in_progress' => 20,
            'discussion'  => 30,
            'testing'     => 70,
            'staging'     => 90,
            'completed'   => 100,
            'cancelled'   => 0,
            default       => 0,
        };
    }
}
