
{{$name}}様

Fun-Rideよりイベントに関するご連絡です。
フォローしている{{$follower_data->name}}様が{{$event->title}}に参加しました。

開催イベント ： {{$event->title}}
開催地 ： {{$event->prefecture}}
開催時間 ： {{$event->start_at}}

開催イベントURL : {{url("/event/$event->id")}}