<form class="inline-block" method="get" action="{{ route('home') }}" id="filter_form">
    <div class="row mt-3">
        <div class="form-group">
            <div class="row">
                <div class="col-md-1">
                    <label for="country_code">{{__('phone_list.country')}}</label>
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="country_code" id="country_code">
                        <option @if(!request('country_code')) selected @endif value="">Select country</option>
                        @foreach ($countries as $name => $code)
                            <option @if(request('country_code') == $code) selected
                                    @endif value="{{ $code }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('country_code'))
                        <span class="text-danger" role="alert">
                            <p>{{ $errors->first('country_code') }}</p>
                        </span>
                    @endif
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-1">
                    <label for="state">{{__('phone_list.state')}}</label>
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="state" id="state">
                        <option @if(!request('state')) selected @endif value="">All</option>
                        @foreach($phone_number_states as $state_value => $state_text)
                            <option value="{{$state_value}}" @if(request('state') == $state_value) selected @endif >
                                {{__('phone_list.number_states.' . $state_text)}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('state'))
                        <span class="text-danger" role="alert">
                            <p>{{ $errors->first('state') }}</p>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>
