<?php

namespace App\Livewire;

use App\Models\Tour;
use App\Steps\TourFive;
use App\Steps\TourFour;
use App\Steps\TourOne;
use App\Steps\TourSix;
use App\Steps\TourThree;
use App\Steps\TourTwo;
use Livewire\Livewire;
use Vildanbina\LivewireWizard\WizardComponent;

class TourWizard extends WizardComponent
{
    public array $steps = [
        TourOne::class,
        TourTwo::class,
        TourThree::class,
        TourFour::class,
        TourFive::class,
        TourSix::class,
    ];

    public $tourId;

    public function model()
    {
        return Tour::findOrNew($this->tourId);
    }
}
