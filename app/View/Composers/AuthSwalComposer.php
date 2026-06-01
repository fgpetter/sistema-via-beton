<?php

namespace App\View\Composers;

use App\Support\SwalToast;
use Illuminate\Support\ViewErrorBag;
use Illuminate\View\View;

class AuthSwalComposer
{
    public function compose(View $view): void
    {
        if ($status = session()->pull('status')) {
            SwalToast::success(is_string($status) ? __($status) : (string) $status);
        }

        $errors = session('errors');

        if ($errors instanceof ViewErrorBag && $errors->any()) {
            $messages = $errors->getBag('default')->all();

            SwalToast::error(
                $messages[0],
                count($messages) > 1
                    ? __('+:count erro(s) adicional(is).', ['count' => count($messages) - 1])
                    : null
            );
        }
    }
}
