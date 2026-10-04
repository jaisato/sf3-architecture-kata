<?php

declare(strict_types=1);

namespace Acme\BlogBundle;

/**
 * Exercise 5: the bundle's service, acme.blog.topic_manager. The topics live
 * in memory for the length of the request.
 */
final class TopicManager
{
    /** @var list<array{title: string}> */
    private array $topics = [];

    /**
     * @return list<array{title: string}>
     */
    public function all(): array
    {
        return $this->topics;
    }

    /**
     * @return array{title: string}
     */
    public function create(string $title): array
    {
        $topic = ['title' => $title];
        $this->topics[] = $topic;

        return $topic;
    }
}
