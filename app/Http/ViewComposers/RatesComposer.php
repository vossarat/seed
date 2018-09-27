<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
use Func;
use App\Order;
use App\Reference\Rate;

class RatesComposer
{

    public function __construct()
    {

    }

    /**
    * Bind data to the view.
    *
    * @param  View  $view
    * @return void
    */
    public function compose(View $view)
    {
        /*$url     = "http://www.nationalbank.kz/rss/rates_all.xml";
        $dataObj = simplexml_load_file($url);
        $rates = [];
        if ($dataObj) {
            foreach ($dataObj->channel->item as $item) {
                if($item->title == 'USD'){
					$rates[0] = array('title'=> $item->title, 'description'=>$item->description);     
				}
				if($item->title == 'EUR'){
					$rates[1] = array('title'=> $item->title, 'description'=>$item->description);     
				}
				if($item->title == 'RUB'){
					$rates[2] = array('title'=> $item->title, 'description'=>$item->description);     
				}   
            }
        }*/
        
        $stmt = Rate::find(1)->get();
        $rates[0] = array('title'=>'USD','description'=>$stmt[0]->usd);
        $rates[1] = array('title'=>'EUR','description'=>$stmt[0]->eur);
        $rates[2] = array('title'=>'RUB','description'=>$stmt[0]->rub);

        $view->with([
            'rates' => $rates,
            'cnt_orders' => Order::count(),
            'cnt_active_orders' => Order::where('active', 1)->count(),
        ]);
    }

}