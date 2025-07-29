<?php

namespace App\Steps;

use App\Models\AddonGroup;
use App\Models\TourAddOn;
use App\Models\TourPrice;
use Vildanbina\LivewireWizard\Components\Step;

class TourFive extends Step
{
    // Step view located at resources/views/steps/general.blade.php 
    protected string $view = 'livewire.tours.steps.fifth';
    public $prices;
    public $addonGroups;
    /*
     * Initialize step fields
     */
    public function mount()
    {
        // dd($this->model);
        if (isset($_GET['tour_id'])) {
            $this->addonGroups = AddonGroup::with('addons')->where('tour_id', $_GET['tour_id'])->get();
            // $this->addons = TourAddOn::where('tour_id', $_GET['tour_id'])->get();
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
        return __('Addons');
    }
}
