@extends('layouts.app_musatrasama')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<div class="width_adjust" style="margin: 0 auto;">
  <br><br>
    <div class="container">     
      @foreach($comments as $comment)
        <div class="comment_outer row">
          タイトル：<p>{{ $comment->title }}</p>
          <div style="width: 100%;">
          </div>

          コメント：<p>{{ $comment->comment }}</p>
          <div style="width: 100%;">
          </div>

          {{-- 1commentに付随するファイル名をforeachで出力（ファイルへのリンク）したい --}}
            <div style="display: flex;">
              ファイルリンク：
              @if( !empty($files[$comment->id]) )
                @foreach($files[$comment->id] as $file)

                  <div style="margin-left: 10px; margin-right: 10px;">
                    <a href="#"  download="#">
                      {{ $file->file_name }}
                    </a>
                  </div>
                @endforeach
              @else
                -
              @endif
            </div>
         </div>
         <br>
      @endforeach

    </div>
    <br>
  </div>

</div>
@endsection('content')
