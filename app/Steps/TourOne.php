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
