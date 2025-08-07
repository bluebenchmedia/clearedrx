<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormsortSubmitRequest;
use App\Services\DosableIntakeService;
use Illuminate\Http\JsonResponse;

class FormsortController extends Controller
{
    public function __construct(private DosableIntakeService $dosableService)
    {
    }

    public function submit(FormsortSubmitRequest $request): JsonResponse
    {
        $data = $request->all();
        $attrs = $request->attributes->all();

       $mergedData = array_merge($data, $attrs);

        $checkoutUrl = $this->dosableService->handleFormsortSubmission($mergedData);

        return response()->json(['checkout_url' => $checkoutUrl]);
    }
}
