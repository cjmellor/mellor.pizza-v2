<?php

declare(strict_types=1);

namespace App\Portfolio;

use Illuminate\Support\Collection;

final readonly class Testimonial
{
    public function __construct(
        public string $quote,
        public string $name,
        public ?string $role,
        public string $company,
    ) {}

    /**
     * @return Collection<int, self>
     */
    public static function all(): Collection
    {
        return collect([
            new self(
                quote: 'Chris joined us for a 3 month contract and did exactly what we needed. We had a backlog, he did it fast and at a high quality. Will no doubt see him again.',
                name: 'Danny Tomalin',
                role: 'Managing Director',
                company: 'PoweredByRental',
            ),
        ]);
    }
}
