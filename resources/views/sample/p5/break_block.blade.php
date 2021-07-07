<!-- resources/views/equip/index.blade.php -->
@extends('layouts.app_p5')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif
  
@include('common.errors')
        <br>

        <div style="margin:0 auto; width: 80%">
          <h2 class="txt_center">ブロック崩し</h2>
          <br><br>

          <a href="{{ route('sample.p5_index') }}">
            p5.jsトップ
          </a>&nbsp;&nbsp;&nbsp;&gt;&gt;&gt;&nbsp;&nbsp;&nbsp;ブロック崩し

        </div>
        <br><br><br>

          <div id="canvas"></div>

        @endsection



        @section('footer')

        @endsection

        <script src="../../js/break_block.js"></script>
    </body>
</html>
