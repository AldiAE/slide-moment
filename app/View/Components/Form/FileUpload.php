<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FileUpload extends Component
{
    /**
     * Create a new component instance.
     */
    public string $name;
    public ?string $file;
    public string $placeholder;
    public string $helperText;
    public function __construct(
        string $name,
        ?string $file = null,
        string $placeholder = '/images/placeholder.png',
        string $helperText = 'Upload an image (JPG, PNG, or JPEG) and preview it here.'
    ) {
        $this->name = $name;
        $this->file = $file;
        $this->placeholder = $placeholder;
        $this->helperText = $helperText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.file-upload');
    }
}
