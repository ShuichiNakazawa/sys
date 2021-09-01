<!-- resources/views/template/index.blade.php -->
@extends('layouts.app')

@section('content')

    @if(session('message'))
    <div class="alert alert-success">
    {{ session('message') }}
    </div>
    @endif
	
    @include('common.errors')
	<br>

    <div style="width: 800px; height: 1000px; margin: 0 auto; background: white;">
        <br>
        <div class="row">
            <div class="left" style="z-index: 10; margin-top: 50px;">
                <div style="background: white; width: 200px; height: 100px; margin-left: 100px; border-radius: 10px;">
                    <div style="background: rgb(48, 105, 96); width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute;">
                        <div style="background: rgb(48, 105, 96); width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
                            <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute;">
                                <img src="" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div style="background: white; width: 200px; height: 100px; margin-left: 100px; border-radius: 10px;">
                    <div style="background: lightblue; width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute;">
                        <div style="background: lightblue; width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
                            <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute;">
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div style="background: white; width: 200px; height: 100px; margin-left: 100px; border-radius: 10px;">
                    <div style="background: rgb(190, 126, 6); width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute;">
                        <div style="background: rgb(190, 126, 6); width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
                            <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute;">
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div style="background: white; width: 200px; height: 100px; margin-left: 100px; border-radius: 10px;">
                    <div style="background: rgb(212, 109, 109); width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute;">
                        <div style="background: rgb(212, 109, 109); width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
                            <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute;">
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div style="background: white; width: 200px; height: 100px; margin-left: 100px; border-radius: 10px;">
                    <div style="background: gray; width: 194px; height: 94px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute;">
                        <div style="background: gray; width: 188px; height: 88px; margin-top: 3px; margin-left: 3px; border-radius: 10px; position: absolute; border-left: solid 1px white;">
                            <div style="background: white; width: 172px; height: 82px; margin-top: 3px; margin-left: 10px; border-radius: 10px; position: absolute;">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>

            <div class="right" style="z-index: 5;">
                <div style="width: 500px; height: 1000px; background: rgb(158, 148, 158); margin-left: -100px; border-radius: 20px; padding-left: 150px; padding-top: 30px;">

                    <div style="width: 300px; height: 400; background: white; border-radius: 10px;">

                        <div style="width: 100px; height: 33px; background: rgb(158, 148, 158); border-bottom-right-radius: 25px;">
                            <img src="../images/1.jpg" alt="" width="auto" height="30">
                            <span style="font-size: 20px; color: white;">&nbsp;test</span>
                        </div>
                        <br>
                        <div class="row">
                            <div style="width: 100px; border: solid 2px #aaa; margin-left: 30px; z-index: 5; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <input type="radio" name="tab" value="" id="tab_a"><label for="tab_a">タブA</label>
                            </div>

                            <div style="width: 100px; border: solid 2px #aaa; margin-left: 30px; z-index: 5; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <input type="radio" name="tab" value="" id="tab_b"><label for="tab_b">タブB</label>
                            </div>

                            <div style="width: 270px; height: 300px; background: white; border: solid 2px #aaa; margin: 0 auto; z-index: 11; margin-top: -3px;">
                                aaaaa
                            </div>

                            <div class="inactive" style="width: 270px; height: 300px; background: white; border: solid 2px #aaa; margin: 0 auto; z-index: 11; margin-top: -3px; display: none;">
                                aaaaa
                            </div>
                        </div>



                    </div>

                    <div style="width: 300px; height: 400; background: white; border-radius: 10px; margin-top: 15px; z-index: 10;">
                        <div style="width: 100px; height: 33px; background: rgb(158, 148, 158); border-bottom-right-radius: 25px;">
                            <img src="../images/1.jpg" alt="" width="auto" height="30">
                            <span style="font-size: 20px; color: white;">&nbsp;test</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	@endsection

  @section('footer')
  	<div class="container copyright">
      &copy;2020 - 2021 lara-assist.jp
    </div>
  @endsection
	</body>
</html>
