
@extends('layouts.app_excercise')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

    <h3>{{ $subject_name }} 過去問</h3>

    <div>
        <table>
            <tr>
                <td>
                    Perfect
                </td>
                <td>
                    Stable
                </td>
                <td>
                    Good
                </td>
                <td>
                    Bad
                </td>
                <td>
                    No look
                </td>
            </tr>

            <tr>
                @if( Auth::user() !== null )
                    <td style="text-align: center;">
                        Perfectの数
                    </td>
                    <td style="text-align: center;">
                        Stableの数
                    </td>
                    <td style="text-align: center;">
                        Goodの数
                    </td>
                    <td style="text-align: center;">
                        Badの数
                    </td>
                    <td style="text-align: center;">
                        No lookの数
                    </td>
                @else
                    <td style="text-align: center;">
                        --
                    </td>
                    <td style="text-align: center;">
                        --
                    </td>
                    <td style="text-align: center;">
                        --
                    </td>
                    <td style="text-align: center;">
                        --
                    </td>
                    <td style="text-align: center;">
                        --
                    </td>           
                @endif
            </tr>
        </table>
        棒グラフ表示<br>
        <br>

        <div class="row" style="text-align: center;">
            <div style="width: 100px; background: white;">
                ランダム出題
            </div>
            <div style="width: 100px; background: lightgray;">
                年度指定
            </div>
        </div>


        <div class="row active" id="random_question">
            <div>
                <input type="radio" name="numOfQuestion" id="question10">
                <label for="question10">１０問</label>
            </div>
            <div>
                <input type="radio" name="numOfQuestion" id="question30">
                <label for="question30">３０問</label>
            </div>
            <div>
                <input type="radio" name="numOfQuestion" id="question50">
                <label for="question50">５０問</label>
            </div>
            <div>
                <input type="radio" name="numOfQuestion" id="question100">
                <label for="question100">１００問</label>
            </div>
        </div>

        <div class="row inactive" id="selected_question">
            @foreach($titles as $title)

                <div style="margin: 20px;">
                    {{ $title->question_title }}
                </div>
            @endforeach
        </div>
    </div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>

@endsection

@section('script')
@endsection