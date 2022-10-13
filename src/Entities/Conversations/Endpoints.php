<?php

namespace Vormkracht10\GenesysApi\Entities\Conversations;

enum Endpoints
{
    public const GET = 'conversations/{conversationId}';
    public const LIST = 'conversations';
    public const MESSAGES = 'conversations/emails/{conversationId}/messages';
    public const MESSAGE = 'conversations/emails/{conversationId}/messages/{messageId}';
    public const EMAILS = 'conversations/emails/{conversationId}';
    public const UPDATE_ATTRIBUTES = 'conversations/{conversationId}/participants/{participantId}/attributes';
    public const UPDATE_CONVERSATION_PARTICIPANT = 'conversations/emails/{conversationId}/participants/{participantId}';
}
