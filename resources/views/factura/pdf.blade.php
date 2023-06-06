<!DOCTYPE html>
<html>

<head>
    <title>{{ $titulo }}</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;

        }

        .container {
            margin: 1em;
            height: 95%;
        }

        footer {
            font-size: 5px;
            position: fixed;
            bottom: 0;
            color: gray;
        }

        .bot-line {
            border-bottom: 1px solid black;
            width: 100%;
        }

        main table {
            margin: 0.5em 0 0.5em 0;


        }

        main table td:not(.importe) {
            border: 1px solid black;
            text-align: center
        }


        main table table {
            margin-left: 5px;

            padding: 5px;
        }

        main table td table td {
            border: none;
        }


        main table table tr td:first-child {
            font-weight: bold;
            text-align: start;
        }

        .collapse,
        .collapse tr {
            border-collapse: collapse;

        }

        .coche {
            width: 100%;
            font-size: large;
            line-height: 1.5em;

        }

        .importe {
            width: 100%;
            padding-top: 1em;
        }

        .importe td {
            border: none;
            text-align: start;
        }

        .end {
            text-align: right;
        }
    </style>

</head>

<body>

    <div class="container">
        <header>
            <table class="bot-line">
                <tr>
                    <td width="20%">
                        <img src="{{ public_path() }}/build/assets/img/logotipo.png" style="width: 8em" alt="">
                    </td>
                    <td width="40%">
                    </td>
                    <td width="40%">
                        <p>
                            <center>
                                <h1>AlCar S.L.</h1>
                            </center>
                        </p>
                        <p>Factura {{ $factura->codigo }}</p>
                        <p>Fecha de Impresión: {{ $hoy->format('d/m/Y H:i a') }}</p>
                    </td>
                </tr>
            </table>
        </header>
        <main>
            <table class="bot-line collapse">
                <tr>
                    <td align="center">
                        <h2>Datos del cliente</h2>
                    </td>
                    <td width="50%">
                        <table>
                            <tr>
                                <td>Nombre</td>
                                <td>{{ $factura->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Apellidos</td>
                                <td>{{ $factura->user->ape1 }} {{ $factura->user->ape2 }}</td>
                            </tr>
                            <tr>
                                <td>Teléfono</td>
                                <td>{{ $factura->user->tlf }}</td>
                            </tr>
                            <tr>
                                <td>Correo Electrónico</td>
                                <td>{{ $factura->user->email }}</td>
                            </tr>
                            <tr>
                                <td>Método de Pago Usado</td>
                                <td>{{ $factura->metodoPago }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <table class="bot-line ">
                <tr>
                    <td width="60%" rowspan="2">{{-- datos coche --}}
                        <table class="coche">
                            <tr>
                                <td align="center" colspan="2">
                                    <h2>Datos del Coche</h2>
                                </td>
                            </tr>
                            <tr>
                                <td>Marca</td>
                                <td>{{ $factura->coche->marca }}</td>
                            </tr>
                            <tr>
                                <td>Modelo</td>
                                <td>{{ $factura->coche->modelo }}</td>
                            </tr>
                            <tr>
                                <td>Matricula</td>
                                <td>{{ $factura->coche->matricula }}</td>
                            </tr>
                            <tr>
                                <td>Tipo</td>
                                <td>{{ $factura->coche->tipo }}</td>
                            </tr>
                            <tr>
                                <td>Año de Matriculación</td>
                                <td>{{ $factura->coche->ano ?? 'Desconocido' }}</td>
                            </tr>
                            <tr>
                                <td>Motor</td>
                                <td>{{ $factura->coche->motor ?? 'Desconocido' }}</td>
                            </tr>
                            <tr>
                                <td>Cilindrada</td>
                                <td>{{ $factura->coche->cilindrada ?? 'Desconocida' }}</td>
                            </tr>
                            <tr>
                                <td>Motor</td>
                                <td>{{ $factura->coche->motor ?? 'Desconocido' }}</td>
                            </tr>
                            <tr>
                                <td>Número de Plazas</td>
                                <td>{{ $factura->coche->plazas ?? 'Desconocidas' }}</td>
                            </tr>
                            <tr>
                                <td>Kilometraje</td>
                                <td>{{ $factura->coche->km ?? 'Desconocida' }}</td>
                            </tr>
                            <tr>
                                <td>Color</td>
                                <td>{{ $factura->coche->color ?? 'Desconocido' }}</td>
                            </tr>
                            <tr>
                                <td>Combustible</td>
                                <td>{{ $factura->coche->combustible }}</td>
                            </tr>
                            <tr>
                                <td>Cambio</td>
                                <td>{{ $factura->coche->cambio }}</td>
                            </tr>
                        </table>
                    </td>
                    <td>{{-- Datos del cliente --}}
                        <table>
                            <tr>
                                <td colspan="2">Datos del Dueño</td>
                            <tr>
                            <tr>
                                <td>Nombre</td>
                                <td>{{ $factura->coche->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Apellidos</td>
                                <td>{{ $factura->coche->user->ape1 }} {{ $factura->coche->user->ape2 }}</td>
                            </tr>
                            <tr>
                                <td>Teléfono</td>
                                <td>{{ $factura->coche->user->tlf }}</td>
                            </tr>
                            <tr>
                                <td>Correo Electrónico</td>
                                <td>{{ $factura->coche->user->email }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Ubicación del Coche</b>
                        <p>{{$sitio->results[0]->formatted_address}}</p>
                        <img src="https://maps.googleapis.com/maps/api/staticmap?center={{$factura->lat}},{{$factura->lng}}&zoom=15&size=400x400&markers=color:red%7Clabel:{{$factura->coche->matricula}}%7C{{$factura->lat}},{{$factura->lng}}&key={{ env('GOOGLE_MAP_KEY') }}"" style="width: 12em" alt="">
                    </td>
                </tr>
            </table>

            <table class="importe ">
                <caption>
                    <h2>Coste Total</h2>
                </caption>
                <tr>
                    <td>Fecha de Inicio</td>
                    <td>{{ $factura->FechaInicio }}</td>
                    <td>Días Totales</td>
                    <td class="end">{{ $factura->dias }}</td>
                </tr>
                <tr>
                    <td>Fecha de Fin</td>
                    <td>{{ $factura->FechaFin }}</td>
                    <td>Importe total</td>
                    <td class="end">{{ $factura->importe }}€</td>
                </tr>
            </table>
        </main>
        <footer>
            La presente factura es emitida por AlCar y contiene información confidencial y datos personales sujetos a
            las leyes de privacidad y protección de datos vigentes. Al recibir esta factura, usted reconoce y acepta las
            siguientes condiciones:

            Tratamiento de datos: AlCar se compromete a tratar sus datos personales de acuerdo con las leyes y
            regulaciones aplicables en materia de protección de datos. Sin embargo, no nos hacemos responsables de la
            veracidad, actualidad o exactitud de los datos proporcionados por usted.

            Privacidad de datos: AlCar implementa medidas de seguridad adecuadas para proteger la confidencialidad y la
            integridad de los datos personales que usted nos proporciona. Sin embargo, no podemos garantizar la plena
            seguridad de la transmisión de datos a través de internet ni nos hacemos responsables de cualquier acceso no
            autorizado, divulgación o alteración de sus datos personales que pueda ocurrir como resultado de factores
            externos o eventos fuera de nuestro control.

            Uso y almacenamiento de datos: AlCar utilizará sus datos personales exclusivamente con el propósito de
            gestionar y procesar esta factura, así como para fines administrativos y contables internos. Sus datos no
            serán compartidos con terceros, a menos que sea requerido por ley o con su consentimiento expreso.

            Conservación de datos: AlCar conservará sus datos personales durante el tiempo necesario para cumplir con
            las obligaciones legales y fiscales correspondientes. Una vez cumplido este período, sus datos serán
            eliminados de forma segura y definitiva.

            Responsabilidad por el trato al vehículo: AlCar declina cualquier responsabilidad por daños, pérdidas o
            cualquier otro tipo de perjuicio que pueda ocurrir en relación con el trato o uso que usted pueda darle al
            vehículo alquilado. Usted acepta que es su responsabilidad utilizar el vehículo de manera adecuada y acorde
            a las normas de tránsito y seguridad vial.

            Mantenimiento y cuidado del vehículo: Usted se compromete a devolver el vehículo en las mismas condiciones
            en las que fue entregado, salvo el desgaste normal derivado del uso ordinario. Cualquier daño, pérdida o
            deterioro adicional será de su responsabilidad y podrá ser cobrado de acuerdo a las condiciones establecidas
            en el contrato de alquiler.

            Al recibir esta factura, usted acepta y comprende las condiciones establecidas en esta declaración de
            exención de responsabilidad. Si tiene alguna pregunta o inquietud acerca del tratamiento de sus datos
            personales o del trato al vehículo, le invitamos a ponerse en contacto con nuestro equipo de atención al
            cliente.
        </footer>
    </div>
</body>

</html>
