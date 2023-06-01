<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait FileUpload
{
    public static function imageUrl($module, $dimension, $image)
    {
        $based = $module;
        $wh = config('image.' . $based . '.' . $dimension . '.width') . 'x' . config('image.' . $based . '.' . $dimension . '.height');
        $pos = strripos($image, '.');
        $url = substr($image, 0, $pos) . '_' . $wh . substr($image, $pos);
        $exist = Storage::disk('uploads')->exists($url);
        if (!$exist) {
            $width = config('image.' . $based . '.' . $dimension . '.width');
            $height = config('image.' . $based . '.' . $dimension . '.height');
            $canvas = config('image.' . $based . '.' . $dimension . '.canvas');
            $exploded = explode('/', $image);
            if ($exploded[0] == "storage" && $exploded[1] == "uploads") {
                $image = $exploded[2] . "/" . $exploded[3];
            }
            $isExist = Storage::disk('uploads')->exists($image);

            if ($isExist) {
                $img = Image::make(file_get_contents(Storage::disk('uploads')->url($image)));
                if ($img->width() <= $img->height()) {
                    $img->resize(null, $height, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                } else {
                    $img->resize($width, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }

                if ($canvas == true) {
                    $img->resizeCanvas($width, $height, 'center', false, '#ffffff');
                }
                $stream = $img->stream();
                Storage::disk('uploads')->put(substr($image, 0, $pos) . '_' . $wh . substr($image, $pos), $stream->__toString());
            }
        }
        return $url;
    }

    public static function productUpload($param = array())
    {
        $file = $param["file"];
        $module = $param["module"];
        $extension = $param["extension"];
        $originalName = $param["originalName"];
        if ($file) {
            $imageName = $originalName;
            $newPath = 'uploads/' . $module . '/';
            $path = 'uploads/' . $module . '/';
            $imagePath = $path . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($file));
            $imageSize = config('image.' . $module);


            foreach ($imageSize as $sizeName => $size) {
                $width = config('image.' . $module . '.' . $sizeName . '.width');
                $height = config('image.' . $module . '.' . $sizeName . '.height');
                if ($extension != 'svg') {
                    $img = Image::make(Storage::disk('public')->path($imagePath));

                    if ($img->width() <= $img->height()) {
                        $img->resize(null, $height, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    } else {
                        $img->resize($width, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }

                    $wh = $width . 'x' . $height;
                    $pos = strripos($imageName, '.');
                    $img->save(Storage::disk('public')->path($newPath . substr($imageName, 0, $pos) . '_' . $wh . substr($imageName, $pos)), 100);

                } else {
                    //$img = Storage::disk('public')->path($imagePath);
                    $wh = $width . 'x' . $height;
                    $pos = strripos($imageName, '.');
                    Storage::disk('public')->path($newPath . substr($imageName, 0, $pos) . '_' . $wh . substr($imageName, $pos));
                }

            }
            return "/storage/uploads/" . $module . "/" . $imageName;
        }
    }

}
