<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>{{__('phone_list.title')}}</title>
        <style>
            .hidden{
                display: none;
            }
        </style>
    </head>
    <body class="antialiased" style="margin:30px;padding:100px">
        <section class="container-fluid">
            <h2>{{__('phone_list.title')}}</h2>
            @include('phone-list.filter-form')

            <table class="table table-striped table-bordered table-hover mt-4">
                <thead>
                <tr>
                    <th>{{__('phone_list.country')}}</th>
                    <th>{{__('phone_list.state')}}</th>
                    <th>{{__('phone_list.country_code')}}</th>
                    <th>{{__('phone_list.phone')}}</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($phone_list))
                        @foreach($phone_list as $phone_data)
                            <tr>
                                <th scope="row">{{ $phone_data['country_name'] }}</th>
                                <td>{{ $phone_data['phone_status'] }}</td>
                                <td>{{ $phone_data['country_code'] }}</td>
                                <td>{{ $phone_data['phone_number'] }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr><td colspan="4">{{__('phone_list.no records found')}}</td></tr>
                    @endif
                </tbody>
            </table>
            <div class="text-center mt-3 mb-5">
                {!! $phone_list->appends(request()->input())->links() !!}
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous">
        </script>
    <script>
        document.getElementById('country_code').addEventListener('change', function() {
            document.querySelector('#filter_form').submit();
        });

        document.getElementById('state').addEventListener('change', function() {
            document.querySelector('#filter_form').submit();
        });

    </script>
    </body>
</html>
