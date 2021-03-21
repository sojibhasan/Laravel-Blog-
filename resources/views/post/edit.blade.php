@extends('layouts.back')

@section('title')
Blog Create
@endsection

@section('page_title')
Edit and Update Post
@endsection

@section('css_plugins')
<link href="{{ asset('back/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('back/plugins/dropify/css/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('back/plugins/summernote/dist/summernote.css') }}" />
<link rel="stylesheet" href="{{ asset('back/plugins/select2/select2.css') }}" />
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="{{ asset('back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
@endsection

@section('custom_css')
<style>
    form label {
        font-weight: 900;
    }

</style>
@endsection

@section('breadcrumb')
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Post</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ul>
@endsection

@section('content')
<div class="container-fluid">
    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="rounded col-lg-8 py-lg-4" style="background-color: #fff;">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Title here" name="title" value="{{ old('title') ? old('title') : $post->title  }}">
                    @if($errors->has('title'))
                    <span style="color: red;">{{ $errors->first('title') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="slug">Title</label>
                    <input type="text" class="form-control" id="slug" placeholder="Title here" name="slug" value="{{ old('slug') ? old('slug') : $post->slug  }}">
                    @if($errors->has('slug'))
                    <span style="color: red;">{{ $errors->first('slug') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="summery">Summery</label>
                    <textarea class="form-control summernote" id="summery" rows="1"
                        name="summery">{{ old('summery') ? old('summery') : $post->summery  }}</textarea>
                    @if($errors->has('summery'))
                    <span style="color: red;">{{ $errors->first('summery') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control summernote" id="content" rows="1"
                        name="content">{{ old('content') ? old('content') : $post->content  }}</textarea>
                    @if($errors->has('content'))
                    <span style="color: red;">{{ $errors->first('content') }}</span>
                    @endif
                </div>

            </div>
            <div class="col-lg-4 rounded py-lg-4" style="background-color: #fff;">
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control show-tick ms select2" data-placeholder="Select" name="category_id">
                        <option></option>
                        @foreach($categories as $category)
                        <option {{ old('category_id') == $category->id || $post->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))
                    <span style="color: red;">{{ $errors->first('category_id') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Tag</label>
                    <select class="form-control show-tick ms select2" multiple data-placeholder="Select" name="tag[]">
                        @foreach($tags as $tag)
                        <option @if(old('tag') !='' ) @if(in_array($tag->id, old('tag'))) selected @endif @elseif(in_array($tag->id, $tags_id)) selected @endif value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('tag'))
                    <span style="color: red;">{{ $errors->first('tag') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Featured Image</label>
                    <input data-default-file="{{ asset('front/images/post/' . $post->image) }}" name="image" type="file" class="dropify" value="$post->image">
                    @if($errors->has('image'))
                    <span style="color: red;">{{ $errors->first('image') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="meta_des">Meta Description</label>
                    <textarea class="form-control" id="meta_des" rows="4" placeholder="Meta Description" name="meta_des">{{ old('meta_des') ? old('meta_des') : $post->meta_des  }}</textarea>
                    @if($errors->has('meta_des'))
                    <span style="color: red;">{{ $errors->first('meta_des') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="meta_key">Meta Keyword</label>
                    <textarea class="form-control" id="meta_key" rows="4" placeholder="Meta Keyword" name="meta_key">{{ old('meta_key') ? old('meta_key') : $post->meta_key  }}</textarea>
                    @if($errors->has('meta_key'))
                    <span style="color: red;">{{ $errors->first('meta_key') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="alt">Image Alt</label>
                    <input type="text" class="form-control" id="alt" placeholder="Image Alt" name="alt" value="{{ old('alt') ? old('alt') : $post->slug  }}">
                    @if($errors->has('alt'))
                    <span style="color: red;">{{ $errors->first('alt') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button name="status" value="1" type="submit" class="btn btn-primary">Publish</button>
                    <button name="status" value="2" type="submit" class="btn btn-info">Save Draft</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('js_plugins')
<script src="{{ asset('back/plugins/jquery-validation/jquery.validate.js') }}"></script>
<!-- Jquery Validation Plugin Css -->
<script src="{{ asset('back/plugins/jquery-steps/jquery.steps.js') }}"></script> <!-- JQuery Steps Plugin Js -->
<script src="{{ asset('back/plugins/dropify/js/dropify.min.js') }}"></script>
<script src="{{ asset('back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<!-- Bootstrap Tags Input Plugin Js -->
<script src="{{ asset('back/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
@endsection

@section('custom_js')
<script src="{{ asset('back/js/pages/forms/form-validation.js') }}"></script>
<script src="{{ asset('back/js/pages/forms/dropify.js') }}"></script>
<script src="{{ asset('back/plugins/summernote/dist/summernote.js') }}"></script>
<script>
    // Select2 selectbox
    $(function () {
        $('.select2').select2();
        $(".search-select").select2({
            allowClear: true
        });
        $("#max-select").select2({
            placeholder: "Select",
            maximumSelectionSize: 2,
        });
        $("#loading-select").select2({
            placeholder: "Select",
            minimumInputLength: 1,
            query: function (query) {
                var data = {
                        results: []
                    },
                    i, j, s;
                for (i = 1; i < 5; i++) {
                    s = "";
                    for (j = 0; j < i; j++) {
                        s = s + query.term;
                    }
                    data.results.push({
                        id: query.term + i,
                        text: s
                    });
                }
                query.callback(data);
            }
        });
        var data = [{
            id: 0,
            tag: 'enhancement'
        }, {
            id: 1,
            tag: 'bug'
        }, {
            id: 2,
            tag: 'duplicate'
        }, {
            id: 3,
            tag: 'invalid'
        }, {
            id: 4,
            tag: 'wontfix'
        }];

        function format(item) {
            return item.tag;
        }
        $("#array-select").select2({
            placeholder: "Select",
            data: {
                results: data,
                text: 'tag'
            },
            formatSelection: format,
            formatResult: format
        });

    });
    $('#summery').summernote({
        placeholder: 'Summery',
        height: 120
    });

    $('#content').summernote({
        placeholder: 'Content',
        height: 320
    });

</script>
@endsection
