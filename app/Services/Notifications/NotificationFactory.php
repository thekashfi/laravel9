<?php


namespace App\Services\Notifications;


use App\Exceptions\UnknownHandlerException;
use App\Services\Notifications\Providers\PatternSMSNegareshProvider;
use App\Services\Notifications\Providers\PatternSMSProvider;
use App\Services\Notifications\Providers\SMSNegareshProvider;
use App\Services\Notifications\Providers\SMSProvider;

class NotificationFactory
{

    public static function handle(string $handler) : NotificationInterface
    {
        switch (strtolower($handler)){
            case 'sms':
                return new SMSProvider();
            case 'pattern':
                return new PatternSMSProvider();
            case 'pattern_negresh':
                return new PatternSMSNegareshProvider();
            case 'negresh':
                return new SMSNegareshProvider();
            default:
                throw new UnknownHandlerException();
        }
    }
}
