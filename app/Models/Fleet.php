<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\OneToMany;

class Fleet extends Model
{
    use HasFactory, HasUuids;

      protected $fillable = [
        'title',
        'description',
        'banner_image',
        'max_passengers',
        'max_suitcases',
        'max_hand_luggage',
        'rate',
      ];

      public function images(): MorphMany
      {
          return $this->morphMany(Image::class, 'imageable')->where('type', 'image');
      }

      public function imageUrl(): string
    {
        $image = $this->images;
        return $image;
        if ($image !== null) {

            return $this->imagePath($image->url);
        }

        return '';
    }

      private function imagePath($url): string
      {

          return asset($url);
      }

      public function features()

      {
        return $this->hasMany(FleetFeature::class,'fleet_id', 'id');
      }

      public function bookings()
      {
        return $this->hasMany(Booking::class);
      }
      public function taxes()
      {
        return $this->hasMany(Tax::class);
      }
}