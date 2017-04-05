<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
use App\Repositories\PostsRepository;
use InfyOm\Generator\Controller\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Posts;
use App\Http\Controllers\Frontend\Auth\LoginController;
use Auth;
use \Dimsav\Translatable\Translatable;

class PostsController extends AppBaseController
{
    /** @var  PostsRepository */
    private $postsRepository;

    
    public function __construct(PostsRepository $postsRepo)
    {

        $this->postsRepository = $postsRepo;
    }

    /**
     * Display a listing of the Posts.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $posts = new Posts();
        $posts = $posts::orderBy('id','DESC')->where('status','1')->get();
        return view('frontend.user.dashboard')
            ->with('posts', $posts);
    }
    /**
     * Display a listing of the posts for the admin
     * @param Request $request
     * @return Response
     */
    public function Adminposts(Request $request)
    {
        $this->postsRepository->pushCriteria(new RequestCriteria($request));
        $posts = $this->postsRepository->all();

        return view('backend.access.postindex')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new Posts.
     *
     * @return Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created Posts in storage.
     *
     * @param CreatePostsRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {

           $input = $request->all();
           $post = new Posts();
           $post->user_id = \Auth::user()->id;
           $post->save();
           foreach (['en', 'ar'] as $locale){
               $post->translateOrNew($locale)->text = $input["text_".$locale];
           }

           $post->save();

    echo 'Created an article with some translations!';
         return redirect(route('posts.index'));
    }

    /**
     * Display the specified Posts.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $posts = $this->postsRepository->findWithoutFail($id);

        if (empty($posts)) {
            Flash::error('Posts not found');

            return redirect(route('posts.index'));
        }

        return view('posts.show')->with('posts', $posts);
    }

    /**
     * Show the form for editing the specified Posts.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $posts = $this->postsRepository->findWithoutFail($id);

        if (empty($posts)) {
            Flash::error('Posts not found');

            return redirect(route('posts.index'));
        }

        return view('posts.edit')->with('posts', $posts);
    }

    /**
     * Update the specified Posts in storage.
     *
     * @param  int              $id
     * @param UpdatePostsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostsRequest $request)
    {
        $posts = $this->postsRepository->findWithoutFail($id);

        if (empty($posts)) {
            Flash::error('Posts not found');

            return redirect(route('posts.index'));
        }

        $posts = $this->postsRepository->update($request->all(), $id);

        Flash::success('Posts updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified Posts from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $posts = $this->postsRepository->findWithoutFail($id);

        if (empty($posts)) {
            Flash::error('Posts not found');

            return redirect(route('posts.index'));
        }

        $this->postsRepository->delete($id);

        Flash::success('Posts deleted successfully.');

        return redirect(route('posts.index'));
    }
    /**
     * Approving user's posts by Admin
     *@param Request $request
     *@return Response 
    */
     public function changestatus(Request $request){
          $status = '1';
          $input = $request->id;
          $post = posts::find($input);
          $post->status = $status;
          $post->save();
          return $this->Adminposts($request);
     }
}