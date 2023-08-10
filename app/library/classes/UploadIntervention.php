<?php

namespace app\library\classes;

use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class UploadIntervention
{
    protected ImageManager $manager;
    protected ?Image $image = null;
    protected array $upload;

    public function __construct()
    {
        $this->manager = new ImageManager(['driver' => 'gd']);
    }

    private function extension_accepted()
    {
        $acceptedExtensions = ['png', 'jpeg', 'jpg'];
        $this->upload['extension'] = pathinfo($this->upload['image']['name'], PATHINFO_EXTENSION);

        return in_array($this->upload['extension'], $acceptedExtensions);
    }

    public function make(string $field = 'file')
    {
        $this->upload['image'] = $_FILES[$field];

        if (!$this->extension_accepted()) {
            throw new \Exception("Extension {$this->upload['extension']} not eaccepted");
        }

        $this->create_new_image_name();
        $this->image = $this->manager->make($this->upload['image']['tmp_name']);

        return $this;
    }

    protected function create_new_image_name()
    {
        // $this->upload['path'] = '/assets/images/'.uniqid().'.'.$this->upload['extension'];
        $this->upload['path'] = '/assets/images/'.uniqid();
    }

    public function resize(int $width, int $height)
    {
        $this->image->resize($width, $height);

        return $this;
    }

    public function resize_aspect_ratio(int $width)
    {
        $this->image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        return $this;
    }

    public function watermark($image_url, $position = 'top-left', $x = 0, $y = 0)
    {
        $source = $this->manager->make($image_url);

        $this->image->insert($source, $position, $x, $y);

        return $this;
    }

    public function execute(int $quality = 60, ?string $format = null)
    {
        if (!$this->image) {
            throw new \Exception('Image instance not found');
        }

        if (!$format) {
            $format = $this->upload['extension'];
        }

        $this->image->save($this->upload['path'], $quality, $format);
    }

    public function get_path()
    {
        return $this->upload['path'];
    }
}
