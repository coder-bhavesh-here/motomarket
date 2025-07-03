<?php

namespace App\Steps;

use App\Models\Tour;
use PhpParser\Node\Expr\Cast\Bool_;
use Vildanbina\LivewireWizard\Components\Step;

class TourTwo extends Step
{
    // Step view located at resources/views/steps/general.blade.php 
    protected string $view = 'livewire.tours.steps.second';
    public $tour;

    /*
     * Initialize step fields
     */
    public function mount()
    {
        if (isset($_GET['tour_id'])) {
            $this->tour = Tour::withTrashed()->find($_GET['tour_id']);
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
        return __('Description');
    }
}
