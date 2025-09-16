<?php

namespace App\Steps;

use App\Models\Tour;
use Vildanbina\LivewireWizard\Components\Step;

class TourSix extends Step
{
    // Step view located at resources/views/steps/general.blade.php 
    protected string $view = 'livewire.tours.steps.sixth';
    public $tour;
    public $embedUrl;
    /*
     * Initialize step fields
     */
    public function mount()
    {
        // dd($this->model);
        if (isset($_GET['tour_id'])) {
            $this->tour = Tour::with(['prices', 'images'])->withTrashed()->find($_GET['tour_id']);
            $this->embedUrl = "";
            $url = $this->tour->tour_start_location;
            if (!empty($url) && filter_var($url, FILTER_VALIDATE_URL) && str_contains($url, 'maps')) {
                if (str_contains($url, 'maps.app.goo.gl')) {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_HEADER, true);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($ch);
                    curl_close($ch);

                    if (preg_match('/Location:\s*(.*)\s/i', $response, $matches)) {
                        $url = trim($matches[1]); // Replace short URL with expanded URL
                    }
                }

                // 4️⃣ Extract query params (lat/lng or place)
                $lat = $lng = null;
                if (preg_match('/@([-0-9.]+),([-0-9.]+)/', $url, $matches)) {
                    $lat = $matches[1];
                    $lng = $matches[2];
                }

                // 5️⃣ Build embed URL
                if ($lat && $lng) {
                    // No API key needed
                    $this->embedUrl = "https://www.google.com/maps?q={$lat},{$lng}&output=embed&z=17";
                    // $embedUrl = "https://www.google.com/maps?q={$lat},{$lng}&output=embed&z=17&t=k";
                } else {
                    // Fallback for place links
                    $this->embedUrl = str_replace("https://www.google.com/maps", "https://www.google.com/maps/embed", $url);
                }
            }
            if (!$this->tour) {
                abort(404, 'Tour not found');
            }
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
        return __('Preview & Publish');
    }
}
