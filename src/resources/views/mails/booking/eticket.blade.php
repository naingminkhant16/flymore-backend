<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Ticket | Fly More</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 72rem;
            margin-left: auto;
            margin-right: auto;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .my-6 {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .rounded-xl {
            border-radius: 0.75rem;
        }

        .font-black {
            font-weight: 900;
        }

        .text-6xl {
            font-size: 3.75rem;
            line-height: 1;
        }

        .italic {
            font-style: italic;
        }

        .mt-6 {
            margin-top: 1.5rem;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-gray-600 {
            color: #4b5563;
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem;
        }

        .table-auto {
            width: 100%;
            border-collapse: collapse;
        }

        .border {
            border-width: 1px;
            border-style: solid;
        }

        .border-gray-300 {
            border-color: #d1d5db;
        }

        .p-3 {
            padding: 0.75rem;
        }

        .text-center {
            text-align: center;
        }

        .opacity-50 {
            opacity: 0.5;
        }

        .mr-3 {
            margin-right: 0.75rem;
        }

        .ml-3 {
            margin-left: 0.75rem;
        }

        .text-lg {
            font-size: 1.125rem;
            line-height: 1.75rem;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .p-4 {
            padding: 1rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mt-3 {
            margin-top: 0.75rem;
        }
    </style>
</head>
<body>
<section class="container">
    <div class="my-6 flex items-center justify-between">
        <img src="https://images.scalebranding.com/dream-plane-logo-60a581b7-d1d5-4b64-97a8-6af52b192b1c.jpg" alt="logo"
             width="100" class="rounded-xl">

        <h1 class="font-black text-6xl italic">E-Ticket Receipt</h1>
    </div>
    <hr>
    <div class="mt-6">
        <h3 class="font-bold text-gray-600 text-xl">Booking Details</h3>

        <table class="table-auto border border-gray-300 mt-3">
            <tbody>
            <tr>
                <td class="font-bold p-3 border border-gray-300">Booking ID</td>
                <td class="p-3 border border-gray-300">{{$booking->id}}</td>
            </tr>
            <tr>
                <td class="font-bold p-3 border border-gray-300">Customer Name</td>
                <td class="p-3 border border-gray-300">{{$booking->booked_by}}</td>
            </tr>
            <tr>
                <td class="font-bold p-3 border border-gray-300">Customer Email</td>
                <td class="p-3 border border-gray-300">{{$booking->booked_email}}</td>
            </tr>
            <tr>
                <td class="font-bold p-3 border border-gray-300">Customer Phone</td>
                <td class="p-3 border border-gray-300">{{$booking->booked_phone}}</td>
            </tr>
            <tr>
                <td class="font-bold p-3 border border-gray-300">Booking Reservation Date</td>
                <td class="p-3 border border-gray-300">
                    {{\Carbon\Carbon::parse($booking->booked_at)->format("l d M Y, H:i A")}}
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <h3 class="font-bold text-gray-600 text-xl">Itinerary Details</h3>
        <table class="table-auto border border-gray-300 mt-3">
            <thead class="mb-3">
            <tr>
                <th colspan="4" class="border border-gray-300 p-4">
                    <div class="ml-3" style="text-align: left">
                        <span class="font-bold text-xl">{{$booking->flight->departureAirport->name}}</span>
                        <img src="https://www.freeiconspng.com/uploads/airplane-takeoff-icon--icon-search-engine-0.png"
                             alt="airplane" width="20"
                             class="opacity-50 mr-3 ml-3">
                        <span class="font-bold text-xl">{{$booking->flight->arrivalAirport->name}}</span>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="border border-gray-300 p-4 text-center font-bold text-xl">
                    {{$booking->flight->flight_number}}<br>
                    <span class="font-normal text-sm">
                        (&nbsp;{{$booking->flight->airline->name}}&nbsp;)
                    </span>
                </td>
                <td class="border border-gray-300 p-4">
                    <p class="font-bold text-lg">
                        {{$booking->flight->departureAirport->city}}
                    </p>
                    <p>
                        {{$booking->flight->departureAirport->name}} ({{$booking->flight->departureAirport->code}})
                    </p>
                    <p>
                        {{\Carbon\Carbon::parse($booking->flight->flight_date)->format("l d M Y")}}
                    </p>
                    <p>
                        {{\Carbon\Carbon::parse($booking->flight->departure_time)->format('H:i A')}}
                    </p>
                </td>
                <td class="border border-gray-300 p-4 text-center">
                    <img
                        src="https://www.freeiconspng.com/thumbs/airplane-icon-png/airplane-symbol-png-buy-this-icon-for--0-98-19.png"
                        alt="airplane" width="25" class="opacity-50 mr-3 ml-3">
                </td>
                <td class="border border-gray-300 p-4">
                    <p class="font-bold text-lg">
                        {{$booking->flight->arrivalAirport->city}}
                    </p>
                    <p>
                        {{$booking->flight->arrivalAirport->name}} ({{$booking->flight->arrivalAirport->code}})
                    </p>
                    <p>
                        {{\Carbon\Carbon::parse($booking->flight->flight_date)->format("l d M Y")}}
                    </p>
                    <p>
                        {{\Carbon\Carbon::parse($booking->flight->arrival_time)->format('H:i A')}}
                    </p>
                </td>
            </tr>
            </tbody>
        </table>
        <p class="mt-2 text-sm text-gray-600 italic">All times shown are local.</p>
    </div>

    <div class="mt-6">
        <h3 class="font-bold text-gray-600 text-xl">Passenger Details</h3>
        <table class="table-auto border border-gray-300 mt-3">
            <thead>
            <tr>
                <th class="p-4 border border-gray-300 text-center">#</th>
                <th class="p-4 border border-gray-300 text-center">First Name</th>
                <th class="p-4 border border-gray-300 text-center">Last Name</th>
                <th class="p-4 border border-gray-300 text-center">Passport Number</th>
                <th class="p-4 border border-gray-300 text-center">Email</th>
                <th class="p-4 border border-gray-300 text-center">Phone</th>
                <th class="p-4 border border-gray-300 text-center">Gender</th>
                <th class="p-4 border border-gray-300 text-center">Nationality</th>
                <th class="p-4 border border-gray-300 text-center">Age</th>
            </tr>
            </thead>
            <tbody>
            @foreach($booking->passengers as $index=> $passenger)
                <tr>
                    <td class="border border-gray-300 p-4 text-center">{{++$index}}</td>
                    <td class="border border-gray-300 p-4 text-center">{{$passenger->first_name}}</td>
                    <td class="border border-gray-300 p-4 text-center">{{$passenger->last_name}}</td>
                    <td class="border border-gray-300 p-4 text-center">{{$passenger->passport_number}}</td>
                    <td class="border border-gray-300 p-4 text-center">{{$passenger->email}}</td>
                    <td class="border border-gray-300 p-4 text-center">{{$passenger->phone}}</td>
                    <td class="border border-gray-300 p-4 text-center">{{$passenger->gender}}</td>
                    <td class="border border-gray-300 p-4 text-center">{{$passenger->nationality}}</td>
                    <td class="border border-gray-300 p-4 text-center">{{$passenger->age}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>
</body>
</html>
