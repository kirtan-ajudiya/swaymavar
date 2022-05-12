<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Banner Information')}}</h3>
    </div>

    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('home_banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
        @if($banner->position != 5)
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3" for="url">{{__('URL')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('URL')}}" id="url" name="url" value="{{ $banner->url }}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label class="control-label">{{__('Banner Images')}}</label>
                        <strong>(850px*421px)</strong>
                    </div>
                    <div class="col-sm-9">
                        @if ($banner->photo != null)
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="img-upload-preview">
                                    <img loading="lazy"  src="{{ asset($banner->photo) }}" alt="" class="img-responsive">
                                    <input type="hidden" name="previous_photo" value="{{ $banner->photo }}">
                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        @endif
                        <div id="photo">

                        </div>
                    </div>
                </div>
            </div>
        @else 
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-3">
                        <label class="control-label">{{__('Banner Images 1')}}</label>
                        <strong>(850px*420px)</strong>
                    </div>
                    <div class="col-sm-9">
                        @if ($banner->photo != null)
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="img-upload-preview">
                                    <img loading="lazy"  src="{{ asset($banner->photo) }}" alt="" class="img-responsive">
                                    <input type="hidden" name="previous_photo" value="{{ $banner->photo }}">
                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        @endif
                        <div id="photo" style="display:none"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="url">{{__('URL 1')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('URL')}}" id="url" name="url"  value="{{ $banner->url }}"  class="form-control" required>
                    </div>
                </div>
                <hr />
                <div class="form-group">
                    <label class="col-sm-3" for="url">{{__('URL 2')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('URL')}}" id="url1" name="url1"  value="{{ $banner->url1 }}"  class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="url">{{__('Title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Title')}}" id="title" name="title"  value="{{ $banner->title }}"  class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3">Description</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="Description"  name="description" rows="3">{{ $banner->description }}</textarea>
                    </div>
                </div>
                <hr />
                <div class="form-group">
                    <div class="col-sm-3">
                        <label class="control-label">{{__('Banner Images 2')}}</label>
                        <strong>(850px*420px)</strong>
                    </div>
                    <div class="col-sm-9">
                        @if ($banner->photo1 != null)
                            <div class="col-md-4 col-sm-4 col-xs-6">
                                <div class="img-upload-preview">
                                    <img loading="lazy"  src="{{ asset($banner->photo1) }}" alt="" class="img-responsive">
                                    <input type="hidden" name="previous_photo1" value="{{ $banner->photo1 }}">
                                    <button type="button" class="btn btn-danger close-btn remove-files1"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        @endif
                        <div id="photo1" style="display:none"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="url">{{__('URL 2')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('URL 2')}}" id="url2" value="{{ $banner->url2 }}" name="url2" class="form-control" required>
                    </div>
                </div>
            </div>
        @endif
        <div class="panel-footer text-right">
            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
        </div>
    </form>
    <!--===================================================-->
    <!--End Horizontal Form-->

</div>

<script type="text/javascript">

    $(document).ready(function(){

        $('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
            $('#photo').css('display', 'block');
        });
        
        $('.remove-files1').on('click', function(){
            $(this).parents(".col-md-4").remove();
            $('#photo1').css('display', 'block');
        });

        $("#photo").spartanMultiImagePicker({
            fieldName:        'photo',
            maxCount:         1,
            rowHeight:        '200px',
            groupClassName:   'col-md-4 col-sm-9 col-xs-6',
            maxFileSize:      '',
            dropFileLabel : "Drop Here",
            onExtensionErr : function(index, file){
                console.log(index, file,  'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr : function(index, file){
                console.log(index, file,  'file size too big');
                alert('File size too big');
            }
        });
        $("#photo1").spartanMultiImagePicker({
            fieldName:        'photo1',
            maxCount:         1,
            rowHeight:        '200px',
            groupClassName:   'col-md-4 col-sm-9 col-xs-6',
            maxFileSize:      '',
            dropFileLabel : "Drop Here",
            onExtensionErr : function(index, file){
                console.log(index, file,  'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr : function(index, file){
                console.log(index, file,  'file size too big');
                alert('File size too big');
            }
        });
    });

</script>
