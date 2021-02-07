<?php

namespace App\Models;

use App\Helpers\Functions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

/**
 * @method static create(array $input)
 */
/**
 * @property integer id
 * @property string name
 * @property string mobile
 * @property mixed email
 * @property mixed city_id
 * @property string password
 * @property mixed|null avatar
 * @property integer type
 * @property mixed|null provider_id
 * @property mixed|null bio
 * @property string|null device_token
 * @property string|null device_type
 * @property string|null lat
 * @property string|null lng
 * @property mixed|null email_verified_at
 * @property mixed|null mobile_verified_at
 * @method User find(int $id)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','mobile','city_id','email','password','avatar','iban_number' ,'gender','id_image','portfolio_image','type','provider_id','bio','device_token','device_type','lat','lng','email_verified_at','mobile_verified_at'];

    protected $hidden = ['password'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime'
    ];

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
    public function getMobile(): string
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     */
    public function setMobile(string $mobile): void
    {
        $this->mobile = $mobile;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed|null
     */
    public function getCityId()
    {
        return $this->city_id;
    }

    /**
     * @param mixed|null $city_id
     */
    public function setCityId($city_id): void
    {
        $this->city_id = $city_id;
    }

    /**
     * @return string|null
     */
    public function getIbanNumber()
    {
        return $this->iban_number;
    }

    /**
     * @param string|null $iban_number
     */
    public function setIbanNumber($iban_number): void
    {
        $this->iban_number = $iban_number;
    }

    /**
     * @return integer|null
     */
    public function getGender()
    {
        return $this->iban_number;
    }

    /**
     * @param integer|null $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }


    /**
     * @return string|null
     */
    public function getLat(): ?string
    {
        return $this->lat;
    }

    /**
     * @param string|null $lat
     */
    public function setLat(?string $lat): void
    {
        $this->lat = $lat;
    }

    /**
     * @return string|null
     */
    public function getLng(): ?string
    {
        return $this->lng;
    }

    /**
     * @param string|null $lng
     */
    public function setLng(?string $lng): void
    {
        $this->lng = $lng;
    }


    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = Hash::make($password);
    }

    /**
     * @return mixed|null
     */
    public function getAvatar()
    {
        return ($this->avatar)?asset($this->avatar):null;
    }

    /**
     * @param mixed|null $avatar
     */
    public function setAvatar($avatar): void
    {
        $this->avatar = Functions::StoreImageModel($avatar,'users/avatar');
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }


    /**
     * @return mixed
     */
    public function getProviderType()
    {
        return $this->provider_type;
    }

    /**
     * @param mixed $provider_type
     */
    public function setProviderType($provider_type): void
    {
        $this->provider_type = $provider_type;
    }

    /**
     * @return string
     */
    public function getAppLocale(): string
    {
        return $this->app_locale;
    }

    /**
     * @param string $app_locale
     */
    public function setAppLocale(string $app_locale): void
    {
        $this->app_locale = $app_locale;
    }

    /**
     * @return string|null
     */
    public function getDeviceToken(): ?string
    {
        return $this->device_token;
    }

    /**
     * @param string|null $device_token
     */
    public function setDeviceToken(?string $device_token): void
    {
        $this->device_token = $device_token;
    }

    /**
     * @return string|null
     */
    public function getDeviceType(): ?string
    {
        return $this->device_type;
    }

    /**
     * @param string|null $device_type
     */
    public function setDeviceType(?string $device_type): void
    {
        $this->device_type = $device_type;
    }

    /**
     * @return mixed
     */
    public function getEmailVerifiedAt()
    {
        return $this->email_verified_at;
    }

    /**
     * @param mixed $email_verified_at
     */
    public function setEmailVerifiedAt($email_verified_at): void
    {
        $this->email_verified_at = $email_verified_at;
    }

    /**
     * @return mixed
     */
    public function getMobileVerifiedAt()
    {
        return $this->mobile_verified_at;
    }

    /**
     * @param mixed $mobile_verified_at
     */
    public function setMobileVerifiedAt($mobile_verified_at): void
    {
        $this->mobile_verified_at = $mobile_verified_at;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio): void
    {
        $this->bio = $bio;
    }

}
