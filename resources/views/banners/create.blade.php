<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Banner Information')}}</h3>
    </div>

    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('home_banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($position != 5)
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3" for="url">{{__('URL')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('URL')}}" id="url" name="url" class="form-control" required>
                    </div>
                </div>
                <input type="hidden" name="position" value="{{ $position }}">
                <div class="form-group">
                    <div class="col-sm-3">
                        <label class="control-label">{{__('Banner Images')}}</label>
                        <strong>(850px*420px)</strong>
                    </div>
                    <div class="col-sm-9">
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
                        <div id="photo">

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="url">{{__('URL 1')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('URL')}}" id="url" name="url" class="form-control" required>
                    </div>
                </div>
                <hr />
                <div class="form-group">
                    <label class="col-sm-3" for="url">{{__('URL 2')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('URL')}}" id="url1" name="url1" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="url">{{__('Title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Title')}}" id="title" name="title" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3">Description</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="Description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <hr />
                <div class="form-group">
                    <div class="col-sm-3">
                        <label class="control-label">{{__('Banner Images 2')}}</label>
                        <strong>(850px*420px)</strong>
                    </div>
                    <div class="col-sm-9">
                        <div id="photo1">

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3" for="url">{{__('URL 2')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('URL 2')}}" id="url2" name="url2" class="form-control" required>
                    </div>
                </div>
                <input type="hidden" name="position" value="{{ $position }}">
        
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

        $('.demo-select2').select2();

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
