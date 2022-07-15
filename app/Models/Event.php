<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use SoftDeletes;
    protected $dates = ['start_date', 'end_date', 'on_sale_date'];

    /**
     * The validation rules.
     *
     * @return array $rules
     */
    public function rules()
    {
        $format = 'Y-m-d H:i';
        return [
            'title'               => 'required',
            'description'         => 'required',
            'start_date'          => 'required|date_format:"' . $format . '"',
            'end_date'            => 'required|date_format:"' . $format . '"',
            'organiser_name'      => 'required_without:organiser_id',
        ];
    }


    /**
     * The organizer associated with the event.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organiser()
    {
        return $this->belongsTo(Organiser::class);
    }

    /**
     * Parse start_date to a Carbon instance
     *
     * @param  string  $date  DateTime
     */
    public function setStartDateAttribute($date)
    {
        $format = 'Y-m-d H:i:s';

        if ($date instanceof Carbon) {
            $this->attributes['start_date'] = $date->format($format);
        } else {
            $this->attributes['start_date'] = Carbon::createFromFormat($format, $date);
        }
    }


    /**
     * Format start date from user preferences
     * @return String Formatted date
     */
    public function startDateFormatted()
    {
        return $this->start_date->format('Y-m-d H:i:s');
    }

    /**
     * Parse end_date to a Carbon instance
     *
     * @param  string  $date  DateTime
     */
    public function setEndDateAttribute($date)
    {
        $format = 'Y-m-d H:i:s';

        if ($date instanceof Carbon) {
            $this->attributes['end_date'] = $date->format($format);
        } else {
            $this->attributes['end_date'] = Carbon::createFromFormat($format, $date);
        }
    }

    /**
     * Format end date from user preferences
     * @return String Formatted date
     */
    public function endDateFormatted()
    {
        return $this->end_date->format('Y-m-d H:i:s');
    }

    /**
     * Indicates whether the event is currently happening.
     *
     * @return bool
     */
    public function getHappeningNowAttribute()
    {
        return Carbon::now()->between($this->start_date, $this->end_date);
    }

    /**
     * Get a usable address for embedding Google Maps
     *
     */
    public function getMapAddressAttribute()
    {
        $string = $this->location_street_number . ','
            . $this->location_address_line_1 . ','
            . $this->location_address_line_2 . ','
            . $this->location_state . ','
            . $this->location_post_code . ','
            . $this->location_country;

        return urlencode($string);
    }

}
