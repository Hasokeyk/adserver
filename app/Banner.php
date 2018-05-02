<?php

namespace App;

use App\Events\CreativeSha1;
use App\Events\GenerateUUID;

use App\ModelTraits\AutomateMutators;
use App\ModelTraits\BinHex;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use AutomateMutators;
    use BinHex;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => GenerateUUID::class,
        'saving' => CreativeSha1::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'uuid', 'campaign_id',
      'creative_contents', 'creative_type', 'creative_sha1', 'creative_width', 'creative_height',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'id','creative_contents','campaign_id'
    ];

    /**
    * The attributes that use some ModelTraits with mutator settings automation
    *
    * @var array
    */
    protected $traitAutomate = [
      'uuid' => 'BinHex',
      'creative_sha1' => 'BinHex',
    ];

    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }

    /**
    * check toArrayExtrasCheck() in AutomateMutators trait
    */
    protected function toArrayExtras($array)
    {
        $array['FU'] = 'TESTED';
        // TODO: follow up
        // $json['serve_url'] = $router->generate('serve_creative', ['id' =>  $this->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        // $json['view_url'] = $router->generate('log_view', ['id' =>  $this->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        // $json['click_url'] = $router->generate('log_click', ['id' =>  $this->getId()], UrlGeneratorInterface::ABSOLUTE_URL);
        return $array;
    }
}
