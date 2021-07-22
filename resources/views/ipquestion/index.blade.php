@extends('layouts.app_ipquestion')

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
      <div id = "" style="display: block;">
        <img src = 'icon/computer_work.png'><span style="font-size:32px;font-weight:bold;color:#30b279;">過去問</span>にチャレンジ
      </div>
      <div style="display: block; width: 100%;">
      </div>

      @php
        $index = 0;
      @endphp

      @foreach($subjects as $subject)
        <form action="{{ route(('select_menu')) }}" method="post">
          @csrf
          <div class="card_outer">
            <div class="rectant" style="width:15px;height: 30px; background-color: green; margin-top: 15px;margin-left: 15px;">
            </div>
            <div class="" style="width: 160px; height: 30px; background-color: rgb(223, 226, 234); margin-top: 15px;">
              <p style="font-size: 20px;"><b>{{ $subject->subject_name }}</b></p>

              <div>

                <select name="title_id">
                  @foreach($titles[$index] as $title)
                    <option value="{{ $title->title_id }}">
                      {{ $title->question_title }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>
            <br><br><br>


            <div class="menu_item row" style="margin: 20px;">
              <div style="margin-left: 10px; margin-top: 10px;">
                <button type="submit" name="selected_menu" value="1" class="" style="width: 80px; height: 80px; border-radius: 8px;">
                  <img src="icon/list.jpg" alt="LIST" width="50px" height="50px">
                </button>
                {{--
                <a href="{{ url( "/list/" . $subject->id) }}">
                  <img src="icon/list.jpg" alt="LIST" width="50px" height="50px">
                </a>
                --}}
              </div>
              <div style="margin-left: 10px; margin-top: 10px;">
                {{--
                <a href="{{ url("/test/" . $subject->id)  }}">
                  --}}
                <button type="submit" name="selected_menu" value="2" class="" style="width: 80px; height: 80px; border-radius: 8px;">
                  <img src="icon/test.jpg" alt="TEST" width="50px" height="50px">
                </button>
              </div>

              <div style="margin-left: 10px; margin-top: 10px;">
                <button type="submit" name="selected_menu" value="3" class="" style="width: 80px; height: 80px; border-radius: 8px;">
                  {{--
                  <a href="{{ url("/graph/" . $subject->id) }}">
                    --}}
                  <img src="icon/graph.jpg" alt="GRAPH" width="50px" height="50px">
                  </button>
                </a>
              </div>
            </div>


            <div style="width: 100%;">
              
            </div>



            <div id="spacer">
            </div>

            <div style="width: 20px;">
            </div>

            <div class="" style="height: 100px;">
              <table>
                <tr>
                  <th style="width: 80px;">
                    本日
                  </th>
                  <th style="width: 80px;">
                    累積
                  </th>
                </tr>
                <tr>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <br>

          <input type="hidden" name="subject_id" value="{{ $subject->id }}">
          @php
            $index++;
          @endphp

        </form>
      @endforeach

      </div>
    </div>
    <br>
  </div>

</div>
@endsection('content')

{{--
<div id = "layer1"></div>

      <!-- ポップアップ -->
      <div id="year_season_list">
        <div id = "year_season_list_in"></div>
      </div>

<br>
<br>

<br><br><br>
</div>
--}}
