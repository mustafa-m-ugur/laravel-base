<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Support\Utils\Constant;
use App\Traits\Responder;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use Responder;

    public $user;
    /**
     * Type of controller object.
     *
     * @param string $type
     */
    public $type;

    /**
     * Sidebar active main page index
     *
     * @param string $active_page_index
     */
    protected $active_page_index;

    /**
     * Sidebar active sub page index
     *
     * @param string $active_sub_page_index
     */
    protected $active_sub_page_index;

    /**
     * Check for user access
     *
     * @param string $will_check_user_access
     */

    protected $will_check_user_access;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        if ($this->will_check_user_access) {
            $this->middleware('check_user_access:' . $this->type);
        }
        $this->user = auth()->guard('backend')->user();


        // other middlewares for admin usage...
    }

    public function view($view, $with = [])
    {
        $user = auth()->guard('backend')->user();
        view()->share('user', $user);

        $data = [
            'user' => $user,
            'active_page_index' => $this->active_page_index,
            'active_sub_page_index' => $this->active_sub_page_index,
            //'datatable_languages' => Constant::$datatable_languages

        ];

        return view('backend.' . $this->type . '.' . $view)->with(
            array_merge($data, $with)
        );
    }
}
