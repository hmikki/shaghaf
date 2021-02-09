<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property mixed category_id
 * @property mixed title
 * @property boolean is_active
 * @method SubCategory find(mixed $food_id)
 */

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_category';
    protected $fillable = ['category_id','title','title_ar','image','is_active'];

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id): void
    {
        $this->category_id = $category_id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitleAr(): string
    {
        return $this->title_ar;
    }

    /**
     * @param string $title_ar
     */
    public function setTitleAr(string $title_ar): void
    {
        $this->title_ar = $title_ar;
    }

    /**
     * @return string
     */

    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return bool
     */
    public function isIsActive(): bool
    {
        return $this->is_active;
    }

    /**
     * @param bool $is_active
     */
    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }

}
