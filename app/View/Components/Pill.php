<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Pill extends Component
{
    public function __construct()
    {
        //
    }

    public function randomColor()
    {
        return $this->colors()->random();
    }

    public function colors(): Collection
    {
        return collect([
            'red' => 'text-red-800 bg-red-100',
            'orange' => 'text-orange-800 bg-orange-100',
            'amber' => 'text-amber-800 bg-amber-100',
            'yellow' => 'text-yellow-800 bg-yellow-100',
            'lime' => 'text-lime-800 bg-lime-100',
            'green' => 'text-green-800 bg-green-100',
            'emerald' => 'text-emerald-800 bg-emerald-100',
            'teal' => 'text-teal-800 bg-teal-100',
            'cyan' => 'text-cyan-800 bg-cyan-100',
            'sky' => 'text-sky-800 bg-sky-100',
            'blue' => 'text-blue-800 bg-blue-100',
            'indigo' => 'text-indigo-800 bg-indigo-100',
            'violet' => 'text-violet-800 bg-violet-100',
            'purple' => 'text-purple-800 bg-purple-100',
            'fuchsia' => 'text-fuchsia-800 bg-fuchsia-100',
            'pink' => 'text-pink-800 bg-pink-100',
            'rose' => 'text-rose-800 bg-rose-100',
        ]);
    }

    public function render(): View|Closure|string
    {
        return <<<'blade'
            <div class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium {{ $randomColor }}">
                {{ $slot }}
            </div>
        blade;
    }
}
