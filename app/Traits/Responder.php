<?php

namespace App\Traits;

trait Responder
{
    public function respond(
        $type = 'success',
        $messages = 'İşlem başarılı bir şekilde gerçekleştirildi.',
        $redirect = null,
        $code = 302
    ) {
        if (!is_array($messages)) {
            $messages = [$messages];
        }

        $titles = [
            'success' => 'Başarılı!',
            'error' => 'Hata!',
            'warning' => 'Uyarı!',
            'info' => 'Bilgi!',
        ];

        $with = [
            'form_result_alert_type' => $type,
            'form_result_alert_title' => isset($titles[$type]) ? $titles[$type] : '',
            'form_result_messages' => $messages
        ];

        if ($redirect) {
            return redirect($redirect, $code)->with($with);
        } else {
            return back()->with($with)->withInput();
        }
    }
}
