<?php

namespace App\Steps;

use App\Models\TourAddOn;
use App\Models\TourPrice;
use Vildanbina\LivewireWizard\Components\Step;

class TourFour extends Step
{
    // Step view located at resources/views/steps/general.blade.php 
    protected string $view = 'livewire.tours.steps.fourth';
    public $prices;
    public $addons;
    /*
     * Initialize step fields
     */
    public function mount()
    {
        // dd($this->model);
        if (isset($_GET['tour_id'])) {
            $this->prices = TourPrice::where('tour_id', $_GET['tour_id'])->get();
            $this->addons = TourAddOn::where('tour_id', $_GET['tour_id'])->get();
        }
        $this->mergeState([
            'title'                  => $this->model->title,
        ]);
    }

    /*
    * Step icon 
    */
    public function icon(): string
    {
        return 'check';
    }

    /*
     * When Wizard Form has submitted
     */
    public function save($state)
    {
        $tour = $this->model;

        $tour->title     = $state['title'];

        $tour->save();
    }

    /*
     * Step Validation
     */
    public function validate()
    {
        return [
            [
                // 'state.title'     => ['required'],
            ],
            [],
            [
                'state.title'     => __('title'),
            ],
        ];
    }

    /*
     * Step Title
     */
    public function title(): string
    {
        return __('Addons & Pricing');
    }
}
