
@foreach($messages as $messageId => $aMessage)
    @include('tools::chunks.evaluators.message', ['messageId' => $messageId, 'message' => $aMessage['message'], 'contexts' => $aMessage['context'] ?? []])
@endforeach
