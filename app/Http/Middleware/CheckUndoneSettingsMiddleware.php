<?php

namespace App\Http\Middleware;

use App\Helpers;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as ResponseFacades;
use Symfony\Component\HttpFoundation\Response;

class CheckUndoneSettingsMiddleware
{
    use Helpers;
    public function handle(Request $request, Closure $next): Response
    {
        $checkUndone = $this->checkUndoneSettings();
        $assets = [
            "checked" => asset("assets/checklist.svg"),
            "unchecked" => asset("assets/uncheck.svg")
        ];
        $progress = [
            "progress" => match (count($checkUndone["settings"])) {
                0 => 100,
                1 => 75,
                2 => 50,
                3 => 25,
                4 => 0
            }
        ];
        $checkUndone = array_merge($checkUndone, $assets, $progress);
        return $checkUndone["isDone"] ? $next($request) : ResponseFacades::view('undone-setting', $checkUndone);
    }
}
