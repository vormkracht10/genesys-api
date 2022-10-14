<?php

namespace Vormkracht10\GenesysApi\Entities\Conversations;

use Vormkracht10\GenesysApi\Entities\Model;

class Conversation extends Model
{
    public function get(string $id, array $params = []): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::GET,
            params: ['conversationId' => $id]
        );

        return $this->connection()->get($url, $params);
    }

    public function list(): array
    {
        $url = Endpoints::LIST;

        return $this->connection()->get($url);
    }

    public function create(array $params = []): array
    {
        $url = Endpoints::CREATE;

        return $this->connection()->post($url, $params);
    }

    public function messages(string $id): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::MESSAGES,
            params: ['conversationId' => $id]
        );

        return $this->connection()->get($url);
    }

    public function createMessage(string $conversationId, array $params): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::CREATE_MESSAGE,
            params: ['conversationId' => $conversationId]
        );

        return $this->connection()->post($url, $params);
    }

    public function message(string $conversationId, string $messageId): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::MESSAGE,
            params: [
                'conversationId' => $conversationId,
                'messageId' => $messageId,
            ]
        );

        return $this->connection()->get($url);
    }

    public function getMessageDraft(string $conversationId): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::GET_MESSAGE_DRAFT,
            params: [
                'conversationId' => $conversationId,
            ]
        );

        return $this->connection()->get($url);
    }

    public function updateMessageDraft(string $conversationId, array $params): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::UPDATE_MESSAGE_DRAFT,
            params: [
                'conversationId' => $conversationId,
            ]
        );

        $params = ['body' => json_encode($params)];

        return $this->connection()->put($url, $params);
    }

    public function emails(string $id): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::EMAILS,
            params: ['conversationId' => $id]
        );

        return $this->connection()->get($url);
    }

    public function updateAttributes(string $conversationId, string $participantId, array $params): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::UPDATE_ATTRIBUTES,
            params: ['conversationId' => $conversationId, 'participantId' => $participantId]
        );

        $params = ['attributes' => json_encode($params)];

        return $this->connection()->patch($url, $params);
    }

    public function updateParticipant(string $conversationId, string $participantId, array $params): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::UPDATE_CONVERSATION_PARTICIPANT,
            params: ['conversationId' => $conversationId, 'participantId' => $participantId]
        );

        $params = ['body' => json_encode($params)];

        return $this->connection()->patch($url, $params);
    }

    public function replaceParticipant(string $conversationId, string $participantId, array $params): array
    {
        $url = $this->replaceParameters(
            endpoint: Endpoints::REPLACE_CONVERSATION_PARTICIPANT,
            params: ['conversationId' => $conversationId, 'participantId' => $participantId]
        );

        return $this->connection()->post($url, $params);
    }
}
