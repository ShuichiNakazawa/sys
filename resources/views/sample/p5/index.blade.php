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

        <div style="margin:0 auto; width: 50%">
          <h2 class="txt_center">p5.js</h2>
          <br><br>

          <div>
            <a href="{{ route('sample.bar_graph') }}">
              <button>棒グラフ</button>
            </a>
          </div>
          <br><br><br>

          <div>
            <a href="{{ route('sample.break_block') }}">
              <button>ブロック崩し</button>
            </a>
          </div>
          <br><br><br>

        </div>
        <br><br><br>
        @endsection

        @section('footer')

        @endsection

    </body>
    @section('script')
    <script type="module">
      var object = document.getElementById('defaultCanvas0');
      object.remove();

    </script>
  @endsection
</html>
