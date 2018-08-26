<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\MyApp\NewClass;

class TrolleyResource extends JsonResource
{

    private $user;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {


        if($this->user_defined_location_id)
            {
                $trolleyLocation =  strtoupper($this->theUserDefinedLocation->location_description);
                $trolleyArea = strtoupper($this->theUserDefinedLocation->theLocation->location);
                $trolleyAreaId = $this->theUserDefinedLocation->theLocation->id;

            }else
            {
                $trolleyLocation = strtoupper($this->theTrackingSeries->location_description);
                $trolleyArea = strtoupper($this->theTrackingSeries->theLocation->location);
                $trolleyAreaId = $this->theTrackingSeries->theLocation->id;
            }


        return [
            'id' => $this->id,
            'trackingNumber' => $this->tracking_number,
            'trolleyLocation'  =>   $trolleyLocation,
            'trolleyArea'      => $trolleyArea,
            'trolleyAreaId'      => $trolleyAreaId,
        ];
    }
}
