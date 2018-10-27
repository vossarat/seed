<?php

namespace App\Reference;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';
    
    protected $fillable = [
		'usd',
		'eur',
		'rub',
	];
	
	public function setRates()
    {
    	$url     = "http://www.nationalbank.kz/rss/rates_all.xml";
        $dataObj = simplexml_load_file($url);
        $rates = [];
        if ($dataObj) {
            foreach ($dataObj->channel->item as $item) {
                if($item->title == 'USD'){
					$rates['usd'] = $item->description->__toString();     
				}
				if($item->title == 'EUR'){
					$rates['eur'] = $item->description->__toString();     
				}
				if($item->title == 'RUB'){
					$rates['rub'] = $item->description->__toString();     
				}
            }
        }
        return $rates;
    }  
}
