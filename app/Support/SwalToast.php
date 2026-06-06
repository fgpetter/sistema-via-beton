<?php

namespace App\Support;

use SweetAlert2\Laravel\Swal;

class SwalToast
{
    /**
     * @return array<string, mixed>
     */
    public static function defaults(?int $timer = 2000): array
    {
        return [
            'toast' => true,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => $timer ?? 2000,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public static function options(string $title, ?string $text = null, ?int $timer = null): array
    {
        $options = [...self::defaults($timer), 'title' => $title];

        if ($text !== null && $text !== '') {
            $options['text'] = $text;
        }

        return $options;
    }

    /**
     * @return array<string, mixed>
     */
    public static function successOptions(string $title, ?string $text = null, ?int $timer = null): array
    {
        return self::options($title, $text, $timer);
    }

    /**
     * @return array<string, mixed>
     */
    public static function errorOptions(string $title, ?string $text = null, ?int $timer = null): array
    {
        return self::options($title, $text, $timer);
    }

    public static function success(string $title, ?string $text = null, ?int $timer = null): void
    {
        Swal::toastSuccess(self::options($title, $text, $timer));
    }

    public static function error(string $title, ?string $text = null, ?int $timer = null): void
    {
        Swal::toastError(self::options($title, $text, $timer));
    }
}
