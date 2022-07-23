<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use SoftDeletes;
    protected $dates = ['start_sale_date', 'end_sale_date'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'event_id',
        'title',
        'description',
        'price',
        'max_per_person',
        'min_per_person',
        'quantity_available',
        'quantity_sold',
        'start_sale_date',
        'end_sale_date',
        'is_paused',
    ];

    /**
     * The rules to validate the model.
     *
     * @return array $rules
     */
    public function rules()
    {
        $format = 'Y-m-d H:i:s';
        return [
            'title'              => 'required',
            'price'              => 'required|numeric|min:0',
            'description'        => 'nullable',
            'start_sale_date'    => 'nullable|date_format:"'.$format.'"',
            'end_sale_date'      => 'nullable|date_format:"'.$format.'"|after:start_sale_date',
            'quantity_available' => 'nullable|integer|min:'.($this->quantity_sold + $this->quantity_reserved)
        ];
    }

    protected $perPage = 10;


    /**
     * Parse start_sale_date to a Carbon instance
     *
     * @param string $date DateTime
     */
    public function setStartSaleDateAttribute($date)
    {
        if (!$date) {
            $this->attributes['start_sale_date'] = Carbon::now();
        } else {
            $this->attributes['start_sale_date'] = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $date
            );
        }
    }

    /**
     * Parse end_sale_date to a Carbon instance
     *
     * @param string|null $date DateTime
     */
    public function setEndSaleDateAttribute($date)
    {
        if (!$date) {
            $this->attributes['end_sale_date'] = null;
        } else {
            $this->attributes['end_sale_date'] = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $date
            );
        }
    }
}
