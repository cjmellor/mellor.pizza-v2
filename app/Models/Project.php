<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Project extends Model
{
    use Sushi;

    protected array $rows = [
        [
            'name' => 'Keis One',
            'description' => 'A brand website for YouTuber and documentary filmmaker <span class="font-semibold">@keisone</span>',
            'testimonial' => 'Chris did an amazing job setting up my site. The service was super fast and the communication was excellent. Highly Recommended!',
            'logo' => 'keisone.jpg',
            'url' => 'keisone.net',
        ],
        [
            'name' => '16Personalities',
            'description' => 'A 3 month contract job asissting in modernising the codebase and helping to develop API\'s',
            'testimonial' => '',
            'logo' => '16p.svg',
            'url' => 'https://16personalities.com/',
        ],
    ];
}
