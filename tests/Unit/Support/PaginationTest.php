<?php

use Scwar\LaravelPaystack\Support\Pagination;

it('can create pagination from meta', function () {
    $meta = [
        'total' => 100,
        'perPage' => 20,
        'page' => 1,
        'pageCount' => 5,
        'next' => 2,
        'previous' => null,
    ];

    $pagination = Pagination::fromMeta($meta);

    expect($pagination->total)->toBe(100)
        ->and($pagination->perPage)->toBe(20)
        ->and($pagination->currentPage)->toBe(1)
        ->and($pagination->totalPages)->toBe(5)
        ->and($pagination->hasNextPage())->toBeTrue()
        ->and($pagination->hasPrevPage())->toBeFalse();
});

it('can convert pagination to array', function () {
    $pagination = new Pagination(100, 20, 1, 5, 2, null);

    $array = $pagination->toArray();

    expect($array)->toHaveKeys(['total', 'per_page', 'current_page', 'total_pages', 'next_page', 'prev_page']);
});
