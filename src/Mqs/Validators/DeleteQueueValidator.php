<?php
// baocaixiong 下午2:58

namespace Mqs\Validators;


use Mqs\Requests\DeleteQueue;

class DeleteQueueValidator extends QueueValidator
{
    /**
     * @param DeleteQueue $req
     * @throws \Mqs\Exceptions\ParameterException
     */
    public static function validate($req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}