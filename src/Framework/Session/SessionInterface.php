<?php

namespace App\Framework\Session;

interface SessionInterface
{
    public function get(string $key, $default = null);

    public function set(string $key, $value): void;

    public function delete(string $key): void;
}