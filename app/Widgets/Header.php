<?php

namespace App\Widgets;

use App\Services\NotificationService;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Header extends AbstractWidget
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
        $notificationService = new NotificationService();

        if (Cache::has('notifications_' . Auth::guard('backend')->user()->employee_id)) {
            $notifications = Cache::get('notifications_' . Auth::guard('backend')->user()->employee_id);
        } else {
            $notifications = Cache::remember('notifications_' . Auth::guard('backend')->user()->employee_id, 60, function () use ($notificationService) {
                return $notificationService->get([
                    'backend_id' => Auth::guard('backend')->user()->backend_id,
                    'employee_id' => Auth::guard('backend')->user()->employee_id,
                ]);
            });
        }

        return view('backend.widgets.header', [
            'config' => $this->config,
            'notifications' => $notifications['data']['data'],
            'notify_count' => $notifications['data']['count'],
        ]);
    }
}
