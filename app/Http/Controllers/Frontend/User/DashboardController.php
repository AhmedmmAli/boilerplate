<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PostsController;
//use App\Http\Requests\CreatePostsRequest;
//use App\Http\Requests\UpdatePostsRequest;
//use App\Repositories\PostsRepository;
//use InfyOm\Generator\Controller\AppBaseController;
//use Illuminate\Http\Request;
//use Flash;
//use Prettus\Repository\Criteria\RequestCriteria;
//use Response;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {     
//         $new = new PostsController();
//         $posts = $new->index();
//         
         return view('frontend.user.dashboard');
         
    }
}
