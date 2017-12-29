<?php

  namespace   App\Classes;

  use Illuminate\Support\Facades\Storage;
  use Intervention\Image\ImageManagerStatic as Image;

  /**
   * @param string $input // The string provided from an form input
   * @param object from Eloquent $obj // An object returned by Eloquent
   * @param string $disk // The disk where the will be saved
   * @param string $path // The path to save the image
   */
  class ImageUploader
  {

    function __construct($input, $obj, $dbcolumn, $disk, $path)
    {
      $this->input = $input;
      $this->obj = $obj;
      $this->dbcolumn = $dbcolumn;
      $this->storage = Storage::disk($disk);
      $this->img = Image::make($this->input);
      $this->imgName = date('ymd'.time()).$this->generateRandomString().".jpg";
      $this->imgPath = $path;
      $this->imgDbPath = $this->storage->url($path).$this->imgName;
    }

    public function removeOld()
    {
      // Find Stored URL
      $storedImage = $this->obj[$this->dbcolumn];

      // Delete from Storage
      $db = explode('/', 'https://coviweb.s3.amazonaws.com/images/accounts_logos/1712291514582636Q1nczks2RD.jpg');
      $s3 = explode('/', Storage::url('/'));

      if ($db[2] == $s3[2]) {
        // Explode to get Path
        $storedImage = explode('.com/', $storedImage);
        $this->storage->delete($storedImage[1]);
      }
    }

    public function store($size = 100)
    {
      // Resize to fix bg and size issues
      $this->resizeImg($size);
      // Store new File
      $this->storage->put($this->imgPath.$this->imgName, $this->img->stream('jpg', 60)->__toString());
      // Update DB Path
      $this->obj->update([
        $this->dbcolumn => $this->imgDbPath
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

    public function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

  }
