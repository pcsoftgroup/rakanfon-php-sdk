<?php

namespace PCsoft\RakanFon\Resources;

class ErrorCode
{
    const DUPLICATED_TRACKING_ID = "Error#6#Transaction ID Can not be Repeated";
    const SUBSCRIBER_EXCEED_RATE_LIMIT = "Error#9#هناك عملية سابقة لهذا الرقم لايمكن تكرار العملية قبل مرور 4 دقيقة/دقائق من وقت تنفيذ العملية السابقة";

    public static function all()
    {
        return [
            self::DUPLICATED_TRACKING_ID => 'Duplicated tracking id',
            self::SUBSCRIBER_EXCEED_RATE_LIMIT => 'Sorry, the subscriber number has many payment please try again after 4 minuets'
        ];
    }

    public static function contains($code)
    {
        return in_array($code, array_keys(self::all()));
    }
}
