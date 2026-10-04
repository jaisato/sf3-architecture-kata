<?php

declare(strict_types=1);

namespace Acme\BlogBundle\Controller;

use Acme\BlogBundle\TopicManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Exercises 3 and 4: GET and POST /topics. Route names carry the bundle alias
 * as prefix, as the bundle best practices ask.
 */
final class TopicController extends AbstractController
{
    public function __construct(private readonly TopicManager $topicManager) {}

    #[Route('/topics', name: 'acme_blog_topic_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        return $this->json($this->topicManager->all());
    }

    #[Route('/topics', name: 'acme_blog_topic_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $topic = $this->topicManager->create($request->getPayload()->getString('title', 'Untitled'));

        return $this->json($topic, Response::HTTP_CREATED);
    }
}
