<?php

interface CacheInterface
{
    public function get(string $key): ?string;
    public function delete(string $key): bool;
    public function set(string $key, string $value, int $ttl): void;
}