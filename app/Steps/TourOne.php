<?php

namespace App\Steps;

use App\Models\Tour;
use Vildanbina\LivewireWizard\Components\Step;

class TourOne extends Step
{
    protected string $view = 'livewire.tours.steps.first';
    public $tour;

    /*
     * Initialize step fields
     */
    public function mount()
    {
        // dd($this->model);
        $this->mergeState([
            'title'                  => $this->model->title,
            'bike_insurance'         => $this->model->bike_insurance,
            'insurance_notes'        => $this->model->insurance_notes,
        ]);
        if (isset($_GET['tour_id'])) {
            $this->tour = Tour::find($_GET['tour_id']);
        }
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
        $tour->bike_insurance = $state['bike_insurance'];
        $tour->insurance_notes = $state['insurance_notes'];

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
        return __('Tour Details');
    }
}
