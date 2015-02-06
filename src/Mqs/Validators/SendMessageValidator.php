<?php
// baocaixiong 下午3:12

namespace Mqs\Validators;


use Mqs\Exceptions\ParameterException;
use Mqs\Requests\SendMessage;

class SendMessageValidator extends MessageValidator
{
    public static function validate(SendMessage $req)
    {
        self::queueNameValidate($req->getQueueName());

        self::validateString($messageBody = $req->getMessageBody());
        self::validateNumber($delaySeconds = $req->getDelaySeconds());
        self::validateNumber($priority = $req->getPriority());

        if ( ! $messageBody) {
            throw new ParameterException('MessageBodyInvalid', 'Bad value: "", message body should not be None.');
        }

        if ($delaySeconds != -1 && $delaySeconds < 0) {
            throw new ParameterException('DelaySecondsInvalid', sprintf('Bad value: "%d", delay_seconds should larger than 0.', $delaySeconds));
        }

        if ($priority != -1 && $priority < 0) {
            throw new ParameterException('PriorityInvalid', sprintf('Bad value: "%d", priority should larger than 0.', $priority));
        }
    }
}