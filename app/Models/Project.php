<?php

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
    ];
}
