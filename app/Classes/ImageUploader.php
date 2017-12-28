<?php

  namespace   App\Classes;

  use Illuminate\Support\Facades\Storage;
  use Intervention\Image\ImageManagerStatic as Image;

  /**
   * @param string $input // The string provided from an form input
   * @param object $obj // An object returned by Eloquent
   * @param object $path // The path to save the image
   */
  class ImageUploader
  {

    function __construct($input, $obj, $disk, $path, $update = false)
    {
      $this->input = $input;
      $this->obj = $obj;
      $this->storage = Storage::disk($disk);
      $this->img = Image::make($this->input);
      $this->imgName = date('ymd'.time()).str_shuffle ('accounts').".jpg";
      $this->imgPath = $path;
      $this->imgDbPath = $this->storage->url($path).$this->imgName;
      $this->update = $update;
    }

    public function removeOld()
    {
      // Find Stored URL
      $storedImage = $this->obj->avatar;

      // Explode to get Path
      $storedImage = explode('.com/', $storedImage);

      // Delete from Storage
      Storage::disk('s3')->delete($storedImage[1]);
    }

    public function store($size = 100)
    {
      // Resize to fix bg and size issues
      $this->resizeImg($size);

      // Remove Old Image
      if ($this->update)
      {
        $this->removeOld();
      }

      // Store new File
      $this->storage->put($this->imgPath.$this->imgName, $this->img->stream('jpg', 60)->__toString());

      // Update DB Path
      $this->obj->update([
        'avatar' => $this->imgDbPath
      ]);
    }

    public function resizeImg($val = 100)
    {
      // Resize to $val value
      $this->img->resize($val, null, function ($constraint) {
          $constraint->aspectRatio();
      });

      // Get the height and width of the image
      $heigth = $this->img->height();
      $width = $this->img->width();

      // Create a canvas with white background to fix PNG black bg
      $this->img = Image::canvas($width, $heigth, '#fefefe')->insert($this->img, 'center');
    }

  }


//
// if ($request->avatar) {
//     $s3 = Storage::disk('s3');
//
//     $avatar = Image::make($request->avatar);
//
//     $avatar->resize(200, null, function ($constraint) {
//         $constraint->aspectRatio();
//     });
//
//     $imgHeigth = $avatar->height();
//     $imgWidth = $avatar->width();
//
//     $avatar = Image::canvas($imgWidth, $imgHeigth, '#fefefe')->insert($avatar, 'center');
//
//     $avatarFileName = date('ymd'.time()).str_shuffle ('accountslogos').".jpg";
//
//     $avatarPath = 'images/accounts_logos/'.date('Y-m-d').'/';
//     $avatarDbPath = $s3->url('images').'/accounts_logos/'.date('Y-m-d').'/';
//
//     $s3->put($avatarPath.$avatarFileName, $avatar->stream('jpg', 60)->__toString());
//
//     $account->delete();
//
//     $account->update([
//       'avatar' => $avatarDbPath.$avatarFileName,
//     ]);
//   }
//   else
//   {
//     $account->update([
//       'avatar' => url('/images/accounts_logos/imagen-no-disponible.png'),
//     ]);
//   }
