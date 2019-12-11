
{{$name}}様

Fun-Rideよりイベント公開に関するご連絡です。
{{$name}}様が参加されているグループ「{{$community->community_title}}」がイベントを公開しました。

開催イベント ： {{$event->title}}
開催地 ： {{$event->prefecture}}
開催時間 ： {{$event->start_at}}

開催イベントURL : {{url("/event/$event->id")}}