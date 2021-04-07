<style>
    .deleteComment{
        position: absolute;
        top: 0;
        {{ app()->getLocale() == 'ar' ? 'left: 0;' : 'right: 0;' }}
    }
</style>

<div class="box box-warning direct-chat direct-chat-warning">
    <div class="box-header with-border">
        <h3 class="box-title">@lang('site.direct_comments')</h3>
        <div class="box-tools pull-right">
            <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="{{ $comments->count() }} Comments">
                {{ $comments->count() }}
            </span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages">
            <!-- Message. Default to the left -->
            @if(isset($noForm))
                @include('dashboard.layouts.comment')
            @endif
            <!-- /.direct-chat-msg -->
        </div>
        <!--/.direct-chat-messages-->
    </div>
    <!-- /.box-body -->

    @if(! isset($noForm))
    <div class="box-footer">
        <form action="#" method="post">
            <div class="input-group">
                <input type="text" name="comment_text" placeholder="Type Comment ..." class="form-control">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-warning btn-flat addComment"
                            data-user="{{ auth()->user()->id }}" data-model="{{ Request::segment(4) }}">
                        @lang('site.add')
                    </button>
                </span>
            </div>
        </form>
    </div>
    @endif
    <!-- /.box-footer-->
</div>
