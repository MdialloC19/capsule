<?php

use App\Console\Enums\SchoolEnum;
use App\Models\StudentCard;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

it('can store a student card', function () {
    actingAs(User::factory()->create())
        ->post(
            route('student-cards.store'),
            [
                'user_id' => $userId = User::factory()->create()->id,
                'school' => $school = fake()->randomElement(SchoolEnum::cases())->value,
                'description' => $description = Str::random(16),
                'is_internal' => $isInternal = fake()->boolean,
                'date_of_birth' => $dob = Carbon::create('2000', '1', '1')->format('Y-m-d'),
            ]
        )->assertOk();

    $studentCard = StudentCard::first();

    expect($studentCard->user_id)->toBe($userId);
    expect($studentCard->school->value)->toBe($school);
    expect($studentCard->description)->toBe($description);
    expect($studentCard->is_internal)->toBe($isInternal);
    expect($studentCard->date_of_birth->format('Y-m-d'))->toBe($dob);

    assertDatabaseCount('student_cards', 1);
});

it('can  not store a student card', function () {
    actingAs(User::factory()->create())
        ->post(
            route('student-cards.store'),
            [

                'description' => $description = Str::random(1),

                'date_of_birth' => $dob = Carbon::create('2000', '1', '1')->format('d-m-y'),
            ]
        )->assertSessionHasErrors([
            'user_id',
            'school',
            'description',
            'date_of_birth',
        ]);

    assertDatabaseCount('student_cards', 0);
});
