
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $reservation->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('house_id') }}
            <select id="house_id" class="form-control">
                @foreach ($houses as $house)
                    <option value="{{ $house->id }}">{{ $house->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('house_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('start') }}
            {{ Form::text('start', $reservation->start, ['class' => 'form-control' . ($errors->has('start') ? ' is-invalid' : ''), 'placeholder' => 'Start', 'id' => 'datepicker1']) }}
            {!! $errors->first('start', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('finish') }}
            {{ Form::text('finish', $reservation->finish, ['class' => 'form-control' . ($errors->has('finish') ? ' is-invalid' : ''), 'placeholder' => 'Finish', 'id' => 'datepicker2']) }}
            {!! $errors->first('finish', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('price') }}
            {{ Form::text('price', $reservation->price, ['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Price']) }}
            {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('info') }}
            {{ Form::text('info', $reservation->info, ['class' => 'form-control' . ($errors->has('info') ? ' is-invalid' : ''), 'placeholder' => 'Info']) }}
            {!! $errors->first('info', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    <script>
        $(document).ready(function() {
            $("#datepicker1").datepicker({
                // Set the date format to "dd/mm/yy"
                dateFormat: "yy/mm/dd",
                // Set the language to Turkish
                regional: "tr",
                // Set the background color of the calendar
                beforeShow: function(input, inst) {
                    inst.dpDiv.css({
                        "background": "green",
                        "color" : "white",
                        "padding" : "5px"
                    });
                }
            });

            $("#datepicker2").datepicker({
                // Set the date format to "dd/mm/yy"
                dateFormat: "yy/mm/dd",
                // Set the language to Turkish
                regional: "tr",
                // Set the background color of the calendar
                beforeShow: function(input, inst) {
                    inst.dpDiv.css({
                        "background": "red",
                        "color" : "white",
                        "padding" : "5px"
                    });
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</div>
