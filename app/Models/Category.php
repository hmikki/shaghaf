<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer id
 * @property string name
 * @property string name_ar
 * @property string image
 * @property integer|null parent_id
 * @property boolean is_active
 */
class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','name_ar','image','parent_id','is_product','is_service','is_active'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class,'parent_id');
    }
    /**
     * @return int
     */
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

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNameAr(): string
    {
        return $this->name_ar;
    }

    /**
     * @param string $name_ar
     */
    public function setNameAr(string $name_ar): void
    {
        $this->name_ar = $name_ar;
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
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    /**
     * @param int|null $parent_id
     */
    public function setParentId(?int $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return bool
     */
    public function getIsProduct(): bool
    {
        return $this->is_product;
    }

    /**
     * @param bool $is_product
     */
    public function setIsProduct(bool $is_product): void
    {
        $this->is_product = $is_product;
    }

    /**
     * @return bool
     */
    public function getIsService(): bool
    {
        return $this->is_service;
    }

    /**
     * @param bool $is_service
     */
    public function setIsService(bool $is_service): void
    {
        $this->is_service = $is_service;
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
