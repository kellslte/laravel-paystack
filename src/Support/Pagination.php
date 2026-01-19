<?php

namespace Scwar\LaravelPaystack\Support;

class Pagination
{
    public function __construct(
        public readonly int $total,
        public readonly int $perPage,
        public readonly int $currentPage,
        public readonly int $totalPages,
        public readonly ?int $nextPage = null,
        public readonly ?int $prevPage = null
    ) {
    }

    /**
     * Create from Paystack API response meta.
     *
     * @param array $meta
     * @return self
     */
    public static function fromMeta(array $meta): self
    {
        return new self(
            total: $meta['total'] ?? 0,
            perPage: $meta['perPage'] ?? 0,
            currentPage: $meta['page'] ?? 1,
            totalPages: $meta['pageCount'] ?? 0,
            nextPage: $meta['next'] ?? null,
            prevPage: $meta['previous'] ?? null
        );
    }

    /**
     * Check if there is a next page.
     */
    public function hasNextPage(): bool
    {
        return $this->nextPage !== null;
    }

    /**
     * Check if there is a previous page.
     */
    public function hasPrevPage(): bool
    {
        return $this->prevPage !== null;
    }

    /**
     * Convert to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'total' => $this->total,
            'per_page' => $this->perPage,
            'current_page' => $this->currentPage,
            'total_pages' => $this->totalPages,
            'next_page' => $this->nextPage,
            'prev_page' => $this->prevPage,
        ];
    }
}
