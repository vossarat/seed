<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Auth;
use Func;

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

        $url     = "http://www.nationalbank.kz/rss/rates_all.xml";
        $dataObj = simplexml_load_file($url);
        if ($dataObj) {
            foreach ($dataObj->channel->item as $item) {
                echo "title: ".$item->title."<br>";
                echo "pubDate: ".$item->pubDate."<br>";
                echo "description: ".$item->description."<br>";;
                echo "quant: ".$item->quant."<br>";
                echo "index: ".$item->index."<br>";
                echo "change: ".$item->change."<br>";
            }
        }

        $view->with([
                'dataObj' => $dataObj,
            ]);
    }

}