<?php

namespace Mns\Validators;


use Mns\Exceptions\ParameterException;
use Mns\Requests\SendMessage;

class SendMessageValidator extends MessageValidator
{
    /**
     * @param SendMessage $req
     * @throws ParameterException
     */
    public static function validate($req)
    {
        self::queueNameValidate($req->getQueueName());

        self::validateString($messageBody = $req->getMessageBody());
        self::validateNumber($delaySeconds = $req->getDelaySeconds());
        self::validateNumber($priority = $req->getPriority());

        if ( ! $messageBody) {
            throw new ParameterException('MessageBodyInvalid', 'Bad value: "", message body should not be None.');
        }

        if ($delaySeconds != -1 && $delaySeconds < 0 & $delaySeconds > 604800) {
            throw new ParameterException('DelaySecondsInvalid', sprintf('Bad value: "%d", delay_seconds should between 0 and 604800.', $delaySeconds));
        }

        if ($priority != -1 && $priority < 0) {
            throw new ParameterException('PriorityInvalid', sprintf('Bad value: "%d", priority should larger than 0.', $priority));
        }
    }
}