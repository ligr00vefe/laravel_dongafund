<div class="support-board-header">
    <div class="board-head">
        <div class="column">
            <div class="select-form">
                <form action="">
                    <div class="row">
                        <select name="" id="" onchange="location.href='/support?category=college&college='+this.value+'&major={{request()->get('major') ?? ""}}'">
                            <option value="">단과대를 선택하세요</option>
                            @foreach(college_type() as $key => $value) {{--DB에 고정적으로 들어있기 때문에 무조건 가져온다--}}
                            <option value="{{$value->college}}" @if(!empty(request()->get('college'))) {{focused(request()->get('college') ?? "", $value->college, "selected")}} @endif>{{$value->college}}</option>
                            @endforeach
                        </select>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <div class="row">
                        <select name="" id="" onchange="location.href='/support?category=college&college={{request()->get('college')?? ""}}&major='+this.value">
                            <option value="">학과를 선택하세요</option>
                            @foreach(department_type() as $key => $value) {{--DB에 고정적으로 들어있기 때문에 무조건 가져온다--}}
                            @continue(empty($value->department))
                            <option value="{{$value->department}}" @if(!empty(request()->get('major'))) {{focused(request()->get('major') ?? "", $value->department, "selected")}} @endif >{{$value->department}}</option>
                            @endforeach
                        </select>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
