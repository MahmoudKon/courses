<style>
    #createPost{
        position: fixed;
        left: -98px;
        cursor: pointer;
        z-index: 100;
        transition: all .5s ease-in-out;
    }
    #createPost:hover{
        left: 0px;
    }
</style>

<!-- Button trigger modal -->
<button type="button" id="createPost" class="btn btn-primary" data-toggle="modal" data-target="#createPostModal">
    Create Post <i class="fa fa-plus"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @if(auth()->user() != null)
            <form action="" id="addPost" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="user_id" class="form-control" value="{{ auth()->user()->id }}">
                    @csrf
                    <!-- Description Input & Image View -->
                    <div class="row">
                        <!-- Description Textarea -->
                        <div class="col-md-12">
                            <!-- Description Textarea -->
                            <div class="form-group has-feedback">
                                <label for="status">@lang('site.title')</label>
                                <input name="title" class="form-control" value="{{ old('title') }}">
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('title') : '' }}</div>
                            </div>
                        </div>

                        <!-- Description Textarea -->
                        <div class="col-md-12">
                            <!-- Description Textarea -->
                            <div class="form-group has-feedback">
                                <label for="status">@lang('site.description')</label>
                                <textarea name="description" class="form-control ckeditor">{{ old('description') }}</textarea>
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('description') : '' }}</div>
                            </div>
                        </div>

                        <!-- Image Input & Image View -->
                        <div class="col-md-6">
                            <!-- Image Input -->
                            <div class="form-group has-feedback">
                                <label for="status">@lang('site.image')</label>
                                <input type="file" name="image" id="createImage" class="form-control image" placeholder="@lang('site.image')">
                                <span class="glyphicon glyphicon-picture form-control-feedback"></span>
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('image') : '' }}</div>
                            </div>
                        </div>

                        <!-- Categories Select -->
                        <div class="col-md-6">
                            <!-- Categories Select -->
                            <div class="form-group has-feedback">
                                <label for="status">@lang('site.category')</label>
                                <select name="category_id" id="category" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('category_id') : '' }}</div>
                            </div>
                        </div>

                        <!-- Tags Input -->
                        <div class="col-md-12">
                            <!-- Tags Input -->
                            <div class="form-group has-feedback">
                                <label for="status">@lang('site.tags')</label>
                                <input type="text" name="tags" class="form-control" placeholder="exampel : Tag, Tag, Tag">
                                <span class="glyphicon glyphicon-tags form-control-feedback"></span>
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('tags') : '' }}</div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                </div>
            </form><!-- end of form -->
            @else
            <div class="modal-body">You must be <a href="{{ route('user.login') }}">login</a> to create a post.</div>
            @endif
        </div>
    </div>
</div>


<!-- Update -->
<div class="modal fade" id="updatePost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formTitle">Update Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" id="editPost" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user() != null ? auth()->user()->id : '' }}">
                    <!-- Description Input & Image View -->
                    <div class="row">
                        <!-- Description Textarea -->
                        <div class="col-md-12">
                            <!-- Description Textarea -->
                            <div class="form-group has-feedback">
                                <label for="updateTitle">@lang('site.title')</label>
                                <input name="title" class="form-control" id="updateTitle" value="{{ old('title') }}">
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('title') : '' }}</div>
                            </div>
                        </div>

                        <!-- Description Textarea -->
                        <div class="col-md-12">
                            <!-- Description Textarea -->
                            <div class="form-group has-feedback">
                                <label for="updateDescription">@lang('site.description')</label>
                                <textarea name="description" id="updateDescription" class="form-control ckeditor">{{ old('description') }}</textarea>
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('description') : '' }}</div>
                            </div>
                        </div>

                        <!-- Image Input & Image View -->
                        <div class="col-md-6">
                            <!-- Image Input -->
                            <div class="form-group has-feedback">
                                <label for="updateImage">@lang('site.image')</label>
                                <input type="file" name="image" id="updateImage" class="form-control image" placeholder="@lang('site.image')">
                                <span class="glyphicon glyphicon-picture form-control-feedback"></span>
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('image') : '' }}</div>
                            </div>
                        </div>

                        <!-- Categories Select -->
                        <div class="col-md-6">
                            <!-- Categories Select -->
                            <div class="form-group has-feedback">
                                <label for="updateCategory">@lang('site.category')</label>
                                <select name="category_id" id="updateCategory" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('category_id') : '' }}</div>
                            </div>
                        </div>

                        <!-- Tags Input -->
                        <div class="col-md-12">
                            <!-- Tags Input -->
                            <div class="form-group has-feedback">
                                <label for="updateTags">@lang('site.tags')</label>
                                <input type="text" id="updateTags" name="tags" class="form-control" placeholder="exampel : Tag, Tag, Tag">
                                <span class="glyphicon glyphicon-tags form-control-feedback"></span>
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('tags') : '' }}</div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="updateForm" class="btn btn-primary"><i class="fa fa-load"></i> @lang('site.update')</button>
                </div>
            </form><!-- end of form -->
        </div>
    </div>
</div>

