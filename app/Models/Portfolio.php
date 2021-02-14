<?php

namespace App\Models;

use App\Helpers\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{

    /**
     * @property integer id
     * @property mixed title
     * @property mixed title_ar
     * @property mixed media
     * @property mixed user_id
     */
    use HasFactory;

    protected $table = 'portfolios';
    protected $fillable= ['title', 'title_ar', 'media', 'user_id'];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function media(): HasMany
    {
        return $this->hasMany(Media::class,'ref_id')->where('media_type',Constant::MEDIA_TYPES['Product']);
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
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle(int $title): void
    {
        $this->title = $title;
    }
    /**
     * @return mixed
     */
    public function getTitle_ar()
    {
        return $this->title_ar;
    }

    /**
     * @param mixed $title_ar
     */
    public function setTitle_ar(int $title_ar): void
    {
        $this->title_ar = $title_ar;
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
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param mixed $media
     */
    public function setMedia($media)
    {
        $this->media = $media;
    }





}
