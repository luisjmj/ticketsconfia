<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Str;
use Image;

class Organiser extends Model
{
    use Authenticatable;

    /**
     * The validation rules for the model.
     *
     * @var array $rules
     */
    protected $rules = [
        'name'           => ['required'],
        'email'          => ['required', 'email'],
        'organiser_logo' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10000'],
    ];

    /**
     * The validation error messages for the model.
     *
     * @var array $messages
     */
    protected $messages = [
        'name.required'        => 'You must at least give a name for the event organiser.',
        'organiser_logo.max'   => 'Please upload an image smaller than 10Mb',
        'organiser_logo.size'  => 'Please upload an image smaller than 10Mb',
        'organiser_logo.mimes' => 'Please select a valid image type (jpeg, jpg, png)',
    ];

    /**
     * Get the full logo path of the organizer.
     *
     * @return mixed|string
     */
    public function getFullLogoPathAttribute()
    {
        if ($this->logo_path && (file_exists('/' . $this->logo_path) || file_exists(public_path($this->logo_path)))) {
            return '/' . $this->logo_path;
        }
        return "/assets/images/logo-dark.png";
    }

    /**
     * Get the url of the organizer.
     *
     * @return string
     */
    public function getOrganiserUrlAttribute()
    {
        return route('showOrganiserHome', [
            'organiser_id'   => $this->id,
            'organiser_slug' => Str::slug($this->name),
        ]);
    }


    /**
     * Set a new Logo for the Organiser
     *
     * @param \Illuminate\Http\UploadedFile $file
     */
    public function setLogo(UploadedFile $file)
    {
        $filename = Str::slug($this->name).'-logo-'.$this->id.'.'.strtolower($file->getClientOriginalExtension());

        // Image Directory
        $imageDirectory = public_path() . '/' . "organiser_images";

        // Paths
        $relativePath = "organiser_images".'/'.$filename;
        $absolutePath = public_path($relativePath);

        $file->move($imageDirectory, $filename);

        $img = Image::make($absolutePath);

        $img->resize(250, 250, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->save($absolutePath);

        if (file_exists($absolutePath)) {
            $this->logo_path = $relativePath;
        }
    }
}
