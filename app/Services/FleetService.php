<?php

namespace App\Services;

use App\Helper\BaseQuery;
use App\Models\Fleet;
use App\Models\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\FleetFeature;
use App\Models\Tax;


use App\Helper\ImageUpload;

class FleetService
{
    use BaseQuery;
    use ImageUpload;
    private $_imgPath = 'fleets/';
    private $_model = null;
    private $_disk = 'public';

    /**
     * Create a new service instance.
     *
     * @return $reauest, $modal
     */
    public function __construct()
    {
        $this->_model = new Fleet();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->get_all($this->_model);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($data)
    {
        $fleet = $this->add($this->_model, $data);

        // Process and store banner image
        if (request()->hasFile('banner_image')) {
            $bannerImage=request()->file('banner_image');
            $name = Str::random(4) . '_' . $bannerImage->getClientOriginalName();
            $path = $this->_imgPath . '' . $name;
            Storage::disk($this->_disk)->put($path, File::get($bannerImage));
            $data['banner_image']=$path;
        }

        // Process and store gallery images
        if (request()->hasFile('images')) {
            $imagesUploaded = [];

            foreach (request()->file('images') as $key => $image) {
                $title = $data['image_title'][$key] ?? null;
                $description = $data['image_description'][$key] ?? null;
                $imageUploaded = $this->uploadImage($image, $this->_imgPath, $title, $description);
                $imageModel = $fleet->images()->create($imageUploaded);
                $imagesUploaded[] = $imageModel;
            }

            $fleet->images()->saveMany($imagesUploaded);
        }


        if (($data['feature_name'])) {

            foreach ($data['feature_name'] as $featureData) {

                FleetFeature::create([
                    'feature_name' => $featureData?? null,
                    'fleet_id'=>$fleet->id,
                ]);

            }
        }

        if ($data['tax_title'] && $data['tax_amount']) {
            $taxTitles = $data['tax_title'];
            $taxAmounts = $data['tax_amount'];

            if (count($taxTitles) === count($taxAmounts)) {
                foreach ($taxTitles as $index => $taxTitle) {
                    $taxAmount = $taxAmounts[$index];
                    Tax::create([
                        'tax_title' => $taxTitle ?? null,
                        'tax_amount' => $taxAmount ?? null,
                        'fleet_id' => $fleet->id,
                    ]);
                }
            } else {
            }
        }




        // Update fleet data
        $fleet->update($data);

        return $fleet;
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->get_by_id($this->_model, $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, $data)
    {

        $fleet = $this->get_by_id($this->_model, $id);
        if (request()->hasFile('banner_image')) {
            if ($fleet->banner_image != null) {
                $this->deleteImage($fleet->banner_image);
                $bannerImage=request()->file('banner_image');
                $name = Str::random(4) . '_' . $bannerImage->getClientOriginalName();
                $path = $this->_imgPath . '' . $name;
                Storage::disk($this->_disk)->put($path, File::get($bannerImage));
                $data['banner_image']=$path;
            }
        }

        if ($data['feature_name']) {
            $features = [];
            foreach ($data['feature_name'] as $featureName) {
                $features[] = ['feature_name' => $featureName];
            }
            $fleet->features()->delete();
            $fleet->features()->createMany($features);
        }

        if ($data['tax_title'] && $data['tax_amount']) {
            $taxes = [];
            foreach ($data['tax_title'] as $index => $taxTitle) {
                $taxes[] = [
                    'tax_title' => $taxTitle,
                    'tax_amount' => $data['tax_amount'][$index]
                ];
            }
            $fleet->taxes()->delete();
            $fleet->taxes()->createMany($taxes);
        }


        $fleet->update($data);
        return $fleet;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->delete($this->_model, $id);
    }

    public function imgDestroy($id)
    {
        $image = Image::findOrFail($id);
        if ($image->url && file_exists(public_path($image->url))) {
            unlink($image->url);
        }

        $image->delete();
        return true;

    }

    public function ImgUpdate($id, $newImage,$title,$description)
    {


        $image = Image::findOrFail($id);
        if($newImage)
        {
            $this->deleteImage($image->url);
            $name = Str::random(4) . '_' . $newImage->getClientOriginalName();
            $path = $this->_imgPath . '' . $name;
            Storage::disk($this->_disk)->put($path, File::get($newImage));
        }


        $image->name = $name ?? $image->name;
        $image->url = $path ?? $image->url;
        $image->title=$title ?? $image->title;
        $image->description=$description ?? $image->description;
        $image->save();
        return true;

    }

}