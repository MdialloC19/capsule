<?php

declare(strict_types=1);

namespace App\Http\Controllers\StudentCard;

use App\Actions\StudentCard\GeneratePdf;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCard\StoreRequest;
use App\Models\StudentCard;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request): void
    {
        

        $studentCard=app(GeneratePdf::class)->handle(
             StudentCard::create($request->validated()),
           config('student-cards.pdf.directory')
        );

        
    }
}
