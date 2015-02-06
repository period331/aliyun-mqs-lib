<?php
// baocaixiong 下午2:46

namespace Mqs\Validators;


use Mqs\Exceptions\ParameterException;
use Mqs\Requests\CreateQueue;

class CreateQueueValidator extends QueueValidator
{
    public static function validate(CreateQueue $req)
    {
        parent::validate($req);

        self::validateNumber($req->getMaximumMessageSize());
        self::validateNumber($req->getDelaySeconds());
        self::validateNumber($req->getPollingWaitSeconds());
        self::validateNumber($req->getMessageRetentionPeriod());
        self::validateNumber($req->getVisibilityTimeout());

        if (($t = $req->getVisibilityTimeout()) != -1 && $t <= 0) {
            throw new ParameterException('QueueAttrInvalid', sprintf('Bad value: "%d", visibility timeout should larger than 0.', $t));
        }

        if ( ($t = $req->getMaximumMessageSize()) != -1 && $t <= 0) {
            throw new ParameterException('QueueAttrInvalid', sprintf('Bad value: "%d", maximum message size should larger than 0.', $t));
        }

        if ( ($t = $req->getMessageRetentionPeriod()) != -1 && $t <= 0 ) {
            throw new ParameterException('QueueAttrInvalid', sprintf('Bad value: "%d", message retention period should larger than 0.', $t));
        }

        if ( ($t = $req->getDelaySeconds()) != -1 && $t <= 0 ) {
            throw new ParameterException('QueueAttrInvalid', sprintf('Bad value: "%d", delay seconds should larger than 0.', $t));
        }

        if ( ($t = $req->getPollingWaitSeconds()) != -1 && $t <= 0 ) {
            throw new ParameterException('QueueAttrInvalid', sprintf('Bad value: "%d", polling wait seconds should larger than 0.', $t));
        }
    }
}