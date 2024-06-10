<?php

namespace App\Admin\Widgets;

use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Widgets\BaseDimmer;
use App\Models\Category;

class CategoriesWidget extends BaseDimmer
{
    public function run()
    {
        $count = Category::count();
        $string = $count == 1 ? 'категория' : 'категорий';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-categories',
            'title'  => "{$count} {$string}",
            'text'   => "В вашей базе данных находится {$count} {$string}. Нажмите на кнопку ниже, чтобы просмотреть все категории.", ['count' => $count, 'string' => $string],
            'button' => [
                'text' => 'Просмотреть все категории',
                'link' => route('voyager.categories.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }

    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Category::first());
    }
}
