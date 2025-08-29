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
    public $activeStep = 1; // 👈 type hint hata diya

    public function setActiveStep($step)
    {
        $this->activeStep = (int) $step; // force integer
    }
    protected $casts = [
        'activeStep' => 'integer',
    ];

    public array $steps = [
        TourOne::class,
        TourTwo::class,
        TourThree::class,
        TourFive::class,
        TourFour::class,
        TourSix::class,
    ];

    public $tourId;

    public function model()
    {
        return Tour::withTrashed()->findOrNew($this->tourId);
    }
}
