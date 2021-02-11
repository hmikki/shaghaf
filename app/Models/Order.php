<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer id
 * @property mixed user_id
 * @property mixed freelancer_id
 * @property mixed product_id
 * @property mixed status
 * @property mixed quantity
 * @property mixed price
 * @property mixed order_date
 * @property mixed delivered_date
 * @property mixed reject_reason
 * @property mixed cancel_reason
 */
class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id','freelancer_id','product_id','status','quantity','price','order_date','delivered_date','is_finished','reject_reason','cancel_reason',];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class,'freelancer_id');
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    /**
     * @return HasMany
     */
    public function order_products(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
    /**
     * @return HasMany
     */
    public function order_statuses(): HasMany
    {
        return $this->hasMany(OrderStatus::class);
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
    public function getFreelancerId()
    {
        return $this->freelancer_id;
    }

    /**
     * @param mixed $freelancer_id
     */
    public function setFreelancerId($freelancer_id): void
    {
        $this->freelancer_id = $freelancer_id;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * @param mixed $product_id
     */
    public function setProductId($product_id): void
    {
        $this->product_id = $product_id;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->order_date;
    }

    /**
     * @param mixed $order_date
     */
    public function setOrderDate($order_date): void
    {
        $this->order_date = $order_date;
    }

    /**
     * @return mixed
     */
    public function getDeliveredDate()
    {
        return $this->delivered_date;
    }

    /**
     * @param mixed $delivered_date
     */
    public function setDeliveredDate($delivered_date): void
    {
        $this->delivered_date = $delivered_date;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
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
    public function getRejectReason()
    {
        return $this->reject_reason;
    }

    /**
     * @param mixed $reject_reason
     */
    public function setRejectReason($reject_reason): void
    {
        $this->reject_reason = $reject_reason;
    }

    /**
     * @return mixed
     */
    public function getCancelReason()
    {
        return $this->cancel_reason;
    }

    /**
     * @param mixed $cancel_reason
     */
    public function setCancelReason($cancel_reason): void
    {
        $this->cancel_reason = $cancel_reason;
    }
    /**
     * @return bool
     */
    public function getIsFinished(): bool
    {
        return $this->is_finished;
    }

    /**
     * @param bool $is_finished
     */
    public function setIsFinished(bool $is_finished): void
    {
        $this->is_finished = $is_finished;
    }

}