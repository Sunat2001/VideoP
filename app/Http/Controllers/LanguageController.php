<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class LanguageController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function changeUserLanguage(Request $request): Response
    {
        $this->validate($request, [
            'language' => ['required', Rule::in(['ru','en'])]
        ]);

        Auth::user()->update([
            'language' => $request->get('language', 'ru')
        ]);

        return response()->noContent();
    }

    /**
     * @return JsonResponse
     */
    public function getAppLanguage(): JsonResponse
    {
        return response()->json([
            'language' => App::currentLocale()
        ]);
    }
}
