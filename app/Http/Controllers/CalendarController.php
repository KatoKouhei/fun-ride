<?php

namespace App\Http\Controllers;

use App\Event;
use App\Entry;
use App\User;
use Illuminate\Http\Request;
use Carbon\CarbonImmutable;
use Carbon\Carbon;

class CalendarController extends Controller
{
    // カレンダーを表示する
    public function show($year, $month, $user_id){
        $entries = Entry::where('user_id', $user_id)->get();
        $events = [];
        foreach($entries as $event_id){
            $event = Event::where('id', $event_id->event_id)->whereYear('start_at', $year)->whereMonth('start_at', $month)->first();
            if(isset($event)){
                $dt = new Carbon($event->start_at);
                $events[$dt->day] = $event;
            }
        }
        // dd($events);
        $year_month = $year.'-'.$month;
        $calendar = $this->calendar($year_month);
        $month = new CarbonImmutable($year_month);
        $html = view('calendar', compact( 'calendar', 'month', 'events'))->render();
        return response()->json(['html' => $html]);
    }

    public function dates($month){
      //カレンダーで先月の残り(7/28~7/31)を$date配列に入れる
        $dates = [];
        //その月の1日の曜日を０〜６で出す
        $last = date('w', strtotime("first day of $month"));
        for (; 0 <= $last - 1; $last -= 1) {
            $dates[] = new CarbonImmutable("$month -$last day");
        }
        //今月分(8/1~8/31)を$date配列に入れる
        $week = date('d', strtotime("last day of $month"));
        for ($i = 1;  $i <= $week; $i += 1) {
            $dates[] = new CarbonImmutable("$month-$i");
        }
        //カレンダーで来月の残り(今回9月分はなし)を$date配列に入れる
        $next = date('w', strtotime("last day of $month"));
        for ($i = 1; $i <= (6 - $next); $i += 1) {
            $dates[] = new CarbonImmutable("$month-$next + $i day");
        }
        return $dates;
    }
 
    public function calendar($month){
        //該当する月$monthのカレンダーを表示する用の配列を得る
        $dates = $this->dates($month);
        $week = [];
        for ($i = 0; $i < count($dates); $i += 7) {
            $week = [];
            foreach (array_slice($dates, $i,7) as $date) {
                $week[] = $date;
            }
            yield $week;
        }
    }
  }
