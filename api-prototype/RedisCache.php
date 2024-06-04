<?php

class RedisCache implements CacheInterface
{
    private $redis;

    public function __construct()
    {
        // Инициализация подключения к Redis
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);
    }

    public function get(string $key): ?string
    {
        return $this->redis->get($key);
    }

    public function set(string $key, string $value, int $ttl): void
    {
        $this->redis->setex($key, $ttl, $value);
    }

    public function delete(string $key): bool
    {
        return $this->redis->del($key);
    }
}