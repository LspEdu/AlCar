<x-app-layout>
    @csrf
    <x-slot name="header" class="justify-content-around">
        <h2 class="font-semibold text-xxl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ $coche->marca }} {{ $coche->modelo }}
        </h2>

        @if (Auth::user()->id == $coche->user_id)
            @if ($coche->validado)
                <div class="bg-success rounded">

                    <p class=" text-white fs-4 bg-success rounded  align-middle">
                        <span class="material-symbols-outlined">
                            check_circle
                        </span>
                        ¡Está todo correcto! Si cambias algún dato, deberás esperar de nuevo una validación.
                    </p>
                </div>
            @else
                <div class="bg-warning rounded">
                    <p class="ms-2 text-white fs-4  rounded  align-middle">
                        <span class="material-symbols-outlined fs-1">report</span>
                        ¡Perfecto!, Ahora toca esperar a que un administrador
                        valide tu coche!
                    </p>
                </div>
            @endif
        @endif
    </x-slot>
    <div class="mt-4 mt-md-2 row gap-2 justify-content-around ms-1 me-1">
        <div class="col-12 col-md-6 bg-white rounded shadow">
            <div class="card mt-2 border-0">
                <h2 class="card-title m-2 fw-bold ">{{ $coche->marca }} {{ $coche->modelo }}@if (Auth::user()->id == $coche->user_id)
                        <a class="align-middle mb-5 mt-2 fs-4"
                            href="{{ route('coche.edit', ['id' => $coche->id]) }}"><span
                                class="material-symbols-outlined">
                                edit
                            </span></a>
                    @endif
                </h2>
                <div class="card-body">
                    <img class="card-img-top img-fluid shadow" src="{{ asset($coche->foto) }}" style=" height: 20em"
                        alt="Title">
                    <div class="table-responsive mt-2">
                        <table class="table table-light table-hover fs-5">
                            <tbody>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Marca</td>
                                    <td class="text-end">{{ $coche->marca }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Modelo</td>
                                    <td class="text-end">{{ $coche->modelo }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Motor</td>
                                    <td class="text-end">{{ $coche->motor ?? 'Desconocido' }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Cambio</td>
                                    <td class="text-end">{{ $coche->cambio }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Año de Matriculación</td>
                                    <td class="text-end">{{ $coche->ano }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Matrícula</td>
                                    <td class="text-end">{{ $coche->matricula }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Combustible</td>
                                    <td class="text-end">{{ $coche->combustible ?? 'Desconocido' }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Cilindrada</td>
                                    <td class="text-end">{{ $coche->cilindrada ?? 'Desconocida' }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Tipo</td>
                                    <td class="text-end">{{ ucfirst($coche->tipo) }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Kilómetros</td>
                                    <td class="text-end">{{ $coche->km ?? 'Desconocidos' }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Plazas</td>
                                    <td class="text-end">{{ $coche->plazas ?? 'Desconocidas' }}</td>
                                </tr>
                                <tr class="">
                                    <td scope="row" class="fw-bold">Color</td>
                                    <td class="text-end">{{ $coche->color ?? 'Desconocido' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <form method="POST" x-data="{ pago: 'efectivo' }" class="col-12 col-md-4 bg-white rounded h-fit shadow"
            action="{{ route('coche.alquilar', ['id' => $coche->id]) }}">
            @csrf
            <div class="row mt-3 justify-content-around">
                <div class="col-12 col-md-5">
                    <label class="form-label fs-5 fw-bold" for="fechaInicio">Fecha Inicio </label>
                    <input class="form-control" required type="date" name="fechaInicio" id="fechaInicio">
                    <x-input-error class="mt-2" :messages="$errors->get('fechaInicio')" />
                </div>
                <div class="col-12 col-md-5">
                    <label class="form-label fs-5 fw-bold" for="fechaFin">Fecha Fin </label>
                    <input class="form-control" required type="date" name="fechaFin" id="fechaFin">
                    <x-input-error class="mt-2" :messages="$errors->get('fechaFin')" />
                </div>

            </div>
            <hr>
            <div class="row p-2">
                <p class="col-12 fs-4 pt-3">¿Cómo deseas pagar?</p>
                <select x-model="pago" name="pago" id="pago" class="form-select mt-3 m-2 w-50  ">
                    <option selected value="efectivo">Efectivo</option>
                    @foreach (Auth::user()->paymentMethods() as $metodo)
                        <option value="{{$metodo->card->last4}}">Tarjeta - {{$metodo->card->last4}}</option>
                    @endforeach
                </select>



                <div class="col-12">
                    <h4>Coste total </h4>
                </div>
                <input type="submit" @if (Auth::user()->id == $coche->user_id) disabled @endif value="Alquilar"
                    class="btn btn-outline-success w-25 mb-5 mt-2">
                <input type="text" id="precio"
                    class="form-input col-6 text-right m-2 border-2 mb-5  focus-outline-success rounded bg-slate-200 text-success fw-bolder fs-4"
                    value=" {{ $coche->precio }}€" readonly>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('stripe-public-key');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            );

            if (error) {
                // Display "error.message" to the user...
            } else {
                // The card has been verified successfully...
            }
        });
    </script>
    <script defer>
        let fin,
            precio = {{ $coche->precio }};
        const inputPrecio = document.getElementById('precio');



        document.addEventListener('DOMContentLoaded', function() {
            const fechaInicioPicker = flatpickr('#fechaInicio', {
                dateFormat: "Y-m-d",
                minDate: "today",
                onChange: function(selectedDates) {
                    fin = new Date(selectedDates[0].setDate(selectedDates[0].getDate() + 1));
                    fechaFinPicker.set('minDate', fin);

                },
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                            'Sábado'
                        ],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct',
                            'Nov', 'Dic'
                        ],
                        longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
                disable: [
                    @foreach ($coche->facturas as $factura)
                        {
                            from: "{{ $factura->FechaInicio }}",
                            to: "{{ $factura->FechaFin }}"
                        },
                    @endforeach

                ],
            });
            const fechaFinPicker = flatpickr('#fechaFin', {
                dateFormat: "Y-m-d",
                minDate: 'today',
                onChange: function(selectedDates) {
                    if (fechaInicioPicker.selectedDates[0]) inputPrecio.value = precio * (Math.round((
                        selectedDates[0] - fechaInicioPicker.selectedDates[0]) / (24 * 60 *
                        60 * 1000)) + 1) + "€"
                },
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes',
                            'Sábado'
                        ],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct',
                            'Nov', 'Dic'
                        ],
                        longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
                disable: [
                    @foreach ($coche->facturas as $factura)
                        {
                            from: "{{ $factura->FechaInicio }}",
                            to: "{{ $factura->FechaFin }}"
                        },
                    @endforeach

                ],
            });
        });
    </script>

    {{--     <script defer>
        var stripe = Stripe('pk_test_51NErvcHtlOR6xNx1vwxETnOfYXVdsxm2n9SZ0ZvfMd4QyXUOfRuqjwi2udKHKecY9SZAMjHxdkikqJmuywU5Vfk700IDw2KxDh');
        var elements = stripe.elements();
        var card = elements.create('card');

        // Add an instance of the card UI component into the `card-element` <div>
        card.mount('#card-element');
        </script> --}}
    {{--     <script type="text/javascript" defer>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(e) {
                var form = document.querySelector(".require-validation");
                var inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]',
                    'input[type=file]', 'textarea'
                ].join(', ');
                var inputs = form.querySelectorAll('.required ' + inputSelector);
                var errorMessage = form.querySelector('div.error');
                var valid = true;
                errorMessage.classList.add('hide');
                var errorElements = document.querySelectorAll('.has-error');
                errorElements.forEach(function(el) {
                    el.classList.remove('has-error');
                });
                inputs.forEach(function(el) {
                    var input = el;
                    if (input.value === '') {
                        input.parentNode.classList.add('has-error');
                        errorMessage.classList.remove('hide');
                        e.preventDefault();
                    }
                });
                if (!form.getAttribute('data-cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey(form.getAttribute('data-stripe-publishable-key'));
                    Stripe.createToken({
                        number: document.querySelector('.card-number').value,
                        cvc: document.querySelector('.card-cvc').value,
                        exp_month: document.querySelector('.card-expiry-month').value,
                        exp_year: document.querySelector('.card-expiry-year').value
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    var errorElement = document.querySelector('.error');
                    errorElement.classList.remove('hide');
                    errorElement.querySelector('.alert').textContent = response.error.message;
                } else {
                    var token = response.id;
                    form.querySelectorAll('input[type=text]').forEach(function(el) {
                        el.value = '';
                    });
                    var input = document.createElement('input');
                    input.setAttribute('type', 'hidden');
                    input.setAttribute('name', 'stripeToken');
                    input.setAttribute('value', token);
                    form.appendChild(input);
                    form.submit();
                }
            }
        });
    </script> --}}


</x-app-layout>
