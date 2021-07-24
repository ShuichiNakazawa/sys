@extends('layouts.app_musatrasama')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<br><br><br>
<div class="width_adjust" style="margin: 0 auto;">
  <br><br>
    <div class="container">     
      <h3>
        musatra様向け掲示板　投稿画面
      </h3>

      <div>
        @foreach($comments as $comment)
          タイトル：<p>{{ $comment->title }}</p>
          コメント：<p>{{ $comment->text }}</p>

          {{-- 1commentに付随するファイル名をforeachで出力（ファイルへのリンク）したい --}}

          {{--
            [$comment->id]
          --}}
          ファイル
          @foreach($files[$comment->id] as $file)
            <p>
              {{ $file->file_name }}
            </p>
          @endforeach
        @endforeach
      </div>
    </div>
    <br>
  </div>

</div>
@endsection('content')
