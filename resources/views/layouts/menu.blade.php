<li class="{{ active_class(Active::checkUriPattern('admin/dashboard')) }}">
  <a href="{{ route('posts.index') }}">
    <i class="fa fa-dashboard"></i>
    <span>{{ trans('Posts') }}</span>
  </a>
</li>