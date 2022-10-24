<?php

namespace Vormkracht10\GenesysApi\Entities\Conversations;

use Vormkracht10\GenesysApi\Traits\EnumsToArray;

enum Endpoints: string
{
    use EnumsToArray;

    case GET = 'conversations/{conversationId}';
    case LIST = 'conversations';
    case CREATE = 'conversations/emails';
    case CREATE_MESSAGE = 'conversations/{conversationId}/messages';
    case MESSAGES = 'conversations/emails/{conversationId}/messages';
    case MESSAGE = 'conversations/emails/{conversationId}/messages/{messageId}';
    // case GET_MESSAGE_DRAFT = 'conversations/emails/{conversationId}/messages/draft';
    // case UPDATE_MESSAGE_DRAFT = 'conversations/emails/{conversationId}/messages/draft';
    case GET_EMAILS = 'conversations/emails/{conversationId}';
    case UPDATE_ATTRIBUTES = 'conversations/{conversationId}/participants/{participantId}/attributes';
    case UPDATE_CONVERSATION_PARTICIPANT = 'conversations/emails/{conversationId}/participants/{participantId}';
    case REPLACE_CONVERSATION_PARTICIPANT = 'conversations/emails/{conversationId}/participants/{participantId}/replace';
}
