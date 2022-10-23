<?php


namespace App\Services\Notifications\Providers;


use App\Services\Notifications\NotificationInterface;
use Illuminate\Support\Facades\Http;

class PatternSMSNegareshProvider implements NotificationInterface
{
    private string $phone;
    private string $code;
    public function setData(array $data): void
    {
        $this->phone = $data['phone'];
        $this->code = $data['code'];
    }

    public function notice(): bool
    {
        try {
            $response = Http::post('https://rest.payamak-panel.com/api/SendSMS/BaseServiceNumber', [
                'username' => config('auth.code.pattern_negresh.username'),
                'password' => config('auth.code.pattern_negresh.password'),
                'bodyId' => config('auth.code.pattern_negresh.bodyId'),
                'to' => $this->phone,
                'text' => $this->code.';'.$this->code
            ]);
            $data = json_decode($response->body());
            return $data->RetStatus == 1 ;
        } catch (\Exception $e) {
            logger()->error($e->getMessage(),[$e->getLine() , $e->getFile()]);
        }
        return false;
    }
}
