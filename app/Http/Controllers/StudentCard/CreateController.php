<?php

declare(strict_types=1);

namespace App\Http\Controllers\StudentCard;

use App\Console\Enums\SchoolEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class CreateController extends Controller
{
    public function __invoke(): View
    {
        //    dd(User::whereNotIn('id', [auth()->id()])->get());
        return view('student_cards.create', [
            'users' => User::whereNotIn('id', [auth()->id()])->get(),
            'schools' => SchoolEnum::cases(),
        ]);
    }
}
