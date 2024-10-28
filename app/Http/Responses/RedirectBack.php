<?php declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Support\Facades\Redirect;

final readonly class RedirectBack
{
    public static function success($message)
    {
        return Redirect::back()->with([
            'alert' => [
                'type' => 'success',
                'message' => $message,
            ],
        ]);
    }

    public static function error($message)
    {
        return Redirect::back()->with([
            'alert' => [
                'type' => 'error',
                'message' => $message,
            ],
        ]);
    }
}
