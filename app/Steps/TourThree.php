<?php

namespace App\Steps;

use App\Models\Tour;
use App\Models\TourImage;
use Vildanbina\LivewireWizard\Components\Step;

class TourThree extends Step
{
    // Step view located at resources/views/steps/general.blade.php 
    protected string $view = 'livewire.tours.steps.third';
    public $images;
    public $tour;

    /*
     * Initialize step fields
     */
    public function mount()
    {
        // dd($this->model);
        if (isset($_GET['tour_id'])) {
            $this->images = TourImage::where('tour_id', $_GET['tour_id'])->get();
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
        return __('Images & Video');
    }
}
