<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisment extends Model
{
    use HasFactory;

    protected $table = 'advertisment';
    protected $fillable = ['title', 'title_ar', 'image'];

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitleAr(): string
    {
        return $this->id;
    }

    public function setTitleAr(string $title_ar): void
    {
        $this->title_ar = $title_ar;
    }

    public function getImage(): string
    {
        return $this->id;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }
}
