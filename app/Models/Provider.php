<?php

namespace App\Models;

use App\Helpers\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @property integer id
 * @property string name
 * @property string name_ar
 * @property string description
 * @property float  price
 * @property Integer $type
 * @property mixed catedory_id
 * @property mixed sub_catedory_id
 * @property boolean is_active
 */

class Provider extends Model
{
    use HasFactory;
    protected $table= 'product';
    protected $fillable = ['id','user_id','name','name_ar','description','catedory_id','sub_catedory_id','price','type'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function media(): HasMany
    {
        return $this->hasMany(Media::class,'ref_id')->where('media_type',Constant::MEDIA_TYPES['Food']);
    }

    /**
     * @return int
     */
    public function getID(): int
    {
       return $this->id;
    }

    /**
     * @param int $id
     */
    public function setID(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
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
     * @return mixed
     */
    public function getSubcategoryId()
    {
        return $this->sub_category_id;
    }

    /**
     * @param mixed $sub_category_id
     */
    public function setSubcategoryId($sub_category_id): void
    {
        $this->sub_category_id = $sub_category_id;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getNameAr()
    {
        return $this->name_ar;
    }

    /**
     * @param mixed $name
     */
    public function setNameAr($name_ar): void
    {
        $this->name = $name_ar;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $size
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

}
