<?php

namespace App\Http\Resources\Api\User;

use App\Http\Resources\Api\Home\CityResource;
use App\Http\Resources\Api\Home\CountryResource;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $token;
    public function __construct($resource, $token =null)
    {
        $this->token = $token;
        parent::__construct($resource);
    }
    public function toArray($request): array
    {
        $Object['id'] = (string) $this->getId();
        $Object['name'] = (string) $this->getName();
        $Object['mobile'] = (string) $this->getMobile();
        $Object['country_id'] = (string) $this->getCountryId();
        $Object['city_id'] = (string) $this->getCityId();
        $Object['Country'] = new CountryResource($this->country);
        $Object['City'] = new CityResource($this->city);
        $Object['email'] = (string) $this->getEmail();
        $Object['bio'] = (string) $this->getBio();
        $Object['gender'] = (string) $this->getGender();
        $Object['iban_number'] = (string) $this->getIbanNumber();
        $Object['identity_image'] = (string) $this->getIdentityImage();
        $Object['mobile_verified_at'] = (string) $this->getMobileVerifiedAt()?Carbon::parse($this->getMobileVerifiedAt())->format('Y-m-d'):null;
        $Object['email_verified_at'] = (string) $this->getEmailVerifiedAt()?Carbon::parse($this->getEmailVerifiedAt())->format('Y-m-d'):null;
        $Object['avatar'] = (string) asset($this->getAvatar());
        $Object['lat'] = (string) $this->getLat();
        $Object['lng'] = (string) $this->getLng();
        $Object['type'] = (string) $this->getType();
        $Object['Portfolios'] = PortfolioResource::collection($this->portfolios);
        $Object['is_available'] = (string) $this->getIsAvailable();
        $Object['app_locale'] = (string) $this->getAppLocale();
        $Object['notification_count'] = (string) Notification::where('user_id',$this->getId())->where('read_at',null)->count();
        $Object['access_token'] = $this->token;
        $Object['token_type'] = 'Bearer';
        return $Object;
    }

}
