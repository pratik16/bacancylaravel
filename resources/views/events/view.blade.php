@php
    $eventIds = array();
@endphp
    
    @foreach ($htmldata as $event)
    <div class="row">
            <div class="col-sm">
            {{$event['title']}}
            </div>
            <div class="col-sm">
            {{$event['event_date']}}
            </div>
        </div>
        @php
            $eventIds[] = $event['id'];
        @endphp
    @endforeach

    @if(!empty($htmldata))
        @php
            $strEventIds = implode(",", $eventIds);
        @endphp
        <input type="hidden" value= "{{$strEventIds}}" id="eventids" readonly />
        <br /><br />
        <div class="row">
            <button type="button" class="btn btn-primary" id="invite_people">Invite People</button>
        </div>
    @endif


