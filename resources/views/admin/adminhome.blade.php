@extends('layouts.adminlayout')
@section('content')
    <div class="container justify-content-between d-flex">
        <form class="d-flex flex-row g-3">
            <div class="col-3">
                <h3>Instruction:</h3>
                <p style="color: black;">To use the Calendar select the date on which you want to add the event.</p><br>
                <h4>To Delete:</h4>
                <p style="color: black;">To delete select the Event name and confirm to delete the event.</p>
            </div>
            <div class="col-9">
                <div id='calendar'></div>
            </div>
        </form>
<script>
    $(document).ready(function () {
        var calendar = $('#calendar').fullCalendar({
            editable:true,
            events:'/adminhome',
            selectable:true,
            selectHelper: true,
            select:function(start, end, allDay)
            {
                var title = prompt('Event Title:');
    
                if(title)
                {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
    
                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
    
                    $.ajax({
                        url:"{{ route('event.store') }}",
                        type:"POST",
                        headers:{
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            type: 'add'
                        },
                        success:function(data)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event created");
                        }
                    })
                }
            },
            editable:true,
            eventResize: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"{{ route('event.store') }}",
                    type:"POST",
                    headers:{
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event updated");
                    }
                })
            },
            eventDrop: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"{{ route('event.store') }}",
                    type:"POST",
                    headers:{
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event updated");
                    }
                })
            },
            eventClick:function(event)
            {
                if(confirm("Are you sure you want to remove it?"))
                {
                    var id = event.id;
                    $.ajax({
                        url:"{{ route('event.store') }}",
                        type:"POST",
                        headers:{
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{
                            id:id,
                            type:"delete"
                        },
                        success:function(response){
                            calendar.fullCalendar('refetchEvents');
                            alert("Event deleted");
                        }
                    })
                }
            }
        });
    });
    </script>

    </div>
@endsection
