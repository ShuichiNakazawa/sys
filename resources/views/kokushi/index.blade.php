<!-- resources/views/rooms/index.blade.php -->
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<div class="card-body">
  <div class="card-body">
    <h3 class="header_center">国試過去問</h3>
  </div>

  @foreach ($fields as $field)
    <div class="card-body">
      <h4 class="header_center">{{ $field->field_name }}</h4>

      <div class="row justify-content-center">

        {{--
          ここに、foreachを使って、テーブルに登録されている科目名（分野ごと）のリストを表示させる
        --}}
        @foreach($subjects as $subject)
          <div class="btn_subject">
            <a href="{{  url('/' . $subject->id) }}">
              <button>{{ $subject->subject_name }}</button>
            </a>
          </div>
        @endforeach
        {{--
          ここまで
          --}}
      </div>
    </div>
  @endforeach
      <div class="btn_subject">
        <a href="{{  url('nurse') }}">
          <button>看護師</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('phn') }}">
          <button>保険師</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('midwife') }}">
          <button>助産師</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('clt') }}">
          <button>臨床検査技師</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('rt') }}">
          <button class="btn-dark" disabled="disabled">診療放射線技師</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('ort') }}">
          <button class="btn-dark" disabled="disabled">視能訓練士</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('ot') }}">
          <button class="btn-dark" disabled="disabled">作業療法士</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('pt') }}">
          <button class="btn-dark" disabled="disabled">理学療法士</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('jrt')}}">
          <button class="btn-dark" disabled="disabled">柔道整復師</button>
        </a>
      </div>

    </div>

  </div>


  <div class="card-body">
    <h4 class="header_center">情報系</h4>

    <div class="row justify-content-center">
      <div class="btn_subject">
        <a href="{{ url('fe')}}">
          <button>基本情報技術者</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('ap')}}">
          <button>応用情報技術者</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('nw')}}">
          <button>ネットワークスペシャリスト
          </button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('st')}}">
          <button>ITストラテジスト</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('sa')}}">
          <button>システムアーキテクト</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('sm')}}">
          <button>ITサービスマネージャ</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('sc')}}">
          <button>情報処理安全確保支援士</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('pm')}}">
          <button>プロジェクトマネージャ</button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('db')}}">
          <button>データベーススペシャリスト
          </button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('es')}}">
          <button>
            エンベデッドシステムスペシャリスト
          </button>
        </a>
      </div>

      <div class="btn_subject">
        <a href="{{ url('au')}}">
          <button>システム監査技術者</button>
        </a>
      </div>
    </div>
  </div>

</div>
<br>

  <div class="listArea">
    <div class="innerList">

      <!-- TOP  -->


    </div>
  </div>
@endsection
