<?php

namespace App\Steps;

use Vildanbina\LivewireWizard\Components\Step;

class TourOne extends Step
{
    protected string $view = 'livewire.tours.steps.first';

    /*
     * Initialize step fields
     */
    public function mount()
    {
        // dd($this->model);
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
        return __('Tour Details');
    }
}
