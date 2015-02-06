<?php
// baocaixiong 下午2:58

namespace Mqs\Validators;


use Mqs\Requests\DeleteQueue;

class DeleteQueueValidator extends QueueValidator
{
    public static function validate(DeleteQueue $req)
    {
        parent::validate($req);

        self::queueNameValidate($req->getQueueName());
    }
}