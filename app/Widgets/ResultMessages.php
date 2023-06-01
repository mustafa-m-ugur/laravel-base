<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class ResultMessages extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('backend.widgets.result_messages', [
            'config' => $this->config,
        ]);
    }
}
