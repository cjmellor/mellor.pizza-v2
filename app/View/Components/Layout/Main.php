<?php

declare(strict_types=1);

namespace App\View\Components\Layout;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Main extends Component
{
    public function __construct(
        public bool $container = true,
        public ?string $subTitle = null
    ) {}

    public function render(): View
    {
        return view('components.layout.main');
    }
}
