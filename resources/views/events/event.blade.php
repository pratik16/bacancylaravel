@extends('layouts.master')

@section('title', 'Event Management')


@section('content')
<div class="alert alert-dark" role="alert" id="last_result">
  
</div>
<div style="margin-top: 25px;">
    <div class="input-group date" data-provide="datepicker" width="50px;">
        From:&nbsp;&nbsp;<input placeholder="From date" type="text" readonly id="from" class="form-control datepicker">

    </div>
    <br />
    <div class="input-group date" data-provide="datepicker">
        To:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text"  readonly  id="to" placeholder="To date" class="form-control datepicker1">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
    </div>

    <br />
    <div class="d-flex justify-content-center">
        <button id="but_search">Show Events</button>
    </div>


    <h1 class="d-flex justify-content-center">Event List</h1>
    <br />
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <b>Name</b>
            </div>
            <div class="col-sm">
                <b>Date</b>
            </div>
        </div>
        <div id="results">
        
        </div>
        
    </div>
</div>

@stop

<script>
    window.onload = function() {
        $('#last_result').hide();
        //$(document).off('.datepicker.data-api');
        $('.datepicker').datepicker({
            dateFormat: "yy-mm-dd"
        });
        $('.datepicker1').datepicker({
            dateFormat: "yy-mm-dd"
        });

        //AJAX request for event list
        $('#but_search').click(function() {
            $('#last_result').hide();
            let from = $('#from').val();
            let to = $('#to').val();
            console.log(from);
            if (from.length > 0 && to.length > 0) {
                fetchRecords(from, to);
            }
            else {
                alert("Please enter both date range!");
            }
        });
        $(document.body).on('click', '#invite_people', function() {
            let ids = $('#eventids').val();
            if (ids.length > 0) {
                callEventSubmit(ids);
            }
        });

        

    }

    function fetchRecords(from, to) {
        $.ajax({
            url: 'get',
            type: 'get',
            dataType: 'json',
            data: { from: from , to:to }, 
            success: function(response) {
                console.log(response);
                $('#results').empty();
                $('#results').append(response.htmldata);
            }
        });
    }

    function callEventSubmit(ids) {
        $.ajax({
            url: 'eventsubmit',
            type: 'post',
            dataType: 'json',
            data: { ids: ids, _token: "{{ csrf_token() }}" }, 
            success: function(response) {
                $('#last_result').empty();
                $('#last_result').show();
                $('#last_result').append(response.msg);
            }
        });
    }
</script>