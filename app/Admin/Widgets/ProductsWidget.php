<?php

namespace App\Admin\Widgets;

use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Product;

class ProductsWidget extends BaseDimmer
{
    public function run()
    {
        $count = Product::count();
        $string = $count == 1 ? 'товар' : 'товаров';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-bag',
            'title'  => "{$count} {$string}",
            'text'   => "В вашей базе данных находится {$count} {$string}. Нажмите на кнопку ниже, чтобы просмотреть все товары.", ['count' => $count, 'string' => $string],
            'button' => [
                'text' => 'Просмотреть все товары',
                'link' => route('voyager.products.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/01.jpg'),
        ]));
    }

    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Product::first());
    }
}
