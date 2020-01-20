<div class="card">
    <div class="calender table-responsive">
        <table class="table">
            <tr>
                <td colspan="2">
                    <button class="btn btn-outline-secondary prev-next-btn" data-year="{{$month->add(-1, 'month')->format('Y')}}" data-month="{{ $month->add(-1, 'month')->format('m') }}" onclick="calendarShow(this)"><</button>
                </td>
                <th colspan="3">
                    <div class="text-center">
                        {{ $month->year }}年{{ $month->month }}月
                    </div>
                </th>
                <td colspan="2">
                    <div class="text-right">
                        <button class="btn btn-outline-secondary prev-next-btn" data-year="{{$month->add(1, 'month')->format('Y')}}" data-month="{{ $month->add(1, 'month')->format('m') }}" onclick="calendarShow(this)">></button>
                    </div>
                </td>
            </tr>

            <tr>
                <th class="sun"  style="color: red"><div class="text-center">日</div></th>
                <th class="mon"><div class="text-center">月</div></th>
                <th class="tue"><div class="text-center">火</div></th>
                <th class="wed"><div class="text-center">水</div></th>
                <th class="thu"><div class="text-center">木</div></th>
                <th class="fri"><div class="text-center">金</div></th>
                <th class="sat"  style="color: blue"><div class="text-center">土</div></th>
            </tr>
            {{-- @if(isset($events))
                @foreach ($events as $event)
                    {{$event->title}}
                @endforeach
            @endif --}}
            @foreach ($calendar as $week)
                <tr>
                    @foreach ($week as $date)
                        @if(isset($events[$date->day]))
                            <td class=" calendar_img p-0 " style="background-image: url('{{$events[$date->day]->image_path}}')">
                                <div class="text-center  text_stroke text-white  my-2 pt-1">
                                    @if($date->weekDay() === 0)
                                        <span class="sun" style="color: red">{{ $date->day }}</span>
                                    @elseif($date->weekDay() === 6)
                                        <span class="sat" style="color: blue">{{ $date->day }}</span>
                                    @else
                                        <span class="other">{{ $date->day }}</span>
                                    @endif
                                </div>
                            </td>
                        @else
                            <td>
                                <div class="text-center">
                                    @if($date->weekDay() === 0)
                                        <span class="sun" style="color: red">{{ $date->day }}</span>
                                    @elseif($date->weekDay() === 6)
                                        <span class="sat" style="color: blue">{{ $date->day }}</span>
                                    @else
                                        <span class="other">{{ $date->day }}</span>
                                    @endif
                                </div>
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
</div>