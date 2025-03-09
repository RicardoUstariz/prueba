@extends('layouts.dash')
@section('title', $title)
@section('content')

<style>
    .form-container {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 100%;
        max-width: 400px;
        margin: auto;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 18px;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-size: 14px;
        margin-bottom: 5px;
    }

    input,
    select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 14px;
        color: #333;
    }

    input:disabled {
        background-color: #f9f9f9;
    }

    .amount-options {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .amount-btn {
        background-color: #00d1d0;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
    }

    .amount-btn:hover {
        background-color: #00a9a7;
    }

    .submit-btn {
        width: 100%;
        background-color: orange;
        color: white;
        padding: 12px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .submit-btn:hover {
        background-color: #ff9900;
    }

    .form-group label[for="notify-client"] {
        display: inline-block;
        margin-right: 10px;
    }

    input[type="checkbox"] {
        transform: scale(1.5);
        vertical-align: middle;
    }
</style>

<!-- Page title -->
<div class="page-title">
    <div class="row justify-content-between align-items-center">
        <div class="mb-3 col-md-6 mb-md-0">
            <h5 class="mb-0 text-white h3 font-weight-400">Agregar deposito</h5>
        </div>
    </div>
</div>
<x-danger-alert />
<x-success-alert />
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-body">

                <form method="POST" action="{{ url('/crear-deposito') }}" class="form-container">

                    {{ csrf_field() }}

                    <h2>DEPÓSITO</h2>
                    <div id="deposit-form">

                        <div class="form-group">
                            <label for="account-type">Producto</label>
                            <select id="payment_mode" name="payment_mode" required>
                                <option value="">Selecciona una opción</option>
                                <option value="Bancolombia">Bancolombia</option>
                                <option value="Daviplata">Daviplata</option>
                                <option value="Nequi">Nequi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="account-type">Tipo de cuenta</label>
                            <select id="account-type" name="account-type" required>
                                <option value="">Selecciona una opción</option>
                                <option value="corriente">Cuenta corriente</option>
                                <option value="ahorros">Cuenta de ahorros</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="account-number">Número de cuenta</label>
                            <input type="text" id="account-number" name="account-number" required>
                        </div>

                        <div class="form-group">
                            <label for="id-number">Cédula o Nit de titular de la cuenta</label>
                            <input type="text" id="id-number" name="id-number" required>
                        </div>

                        <div class="form-group">
                            <label for="client-phone">Celular del cliente</label>
                            <input type="text" id="client-phone" name="client-phone" required>
                        </div>

                        <div class="form-group">
                            <label for="value">Valor</label>
                            <input type="number" min="1" max="{{ $user->account_bal }}" id="value" name="value" value="$0" onkeyup="ponerPrecio()" required>
                        </div>

                        <div class="amount-options">
                            <button type="button" class="amount-btn" data-value="50000">$50,000</button>
                            <button type="button" class="amount-btn" data-value="100000">$100,000</button>
                            <button type="button" class="amount-btn" data-value="200000">$200,000</button>
                        </div>

                        <div class="form-group">
                            <label for="notify-client">Enviar notificación al cliente</label>
                            <input type="checkbox" id="notify-client">
                        </div>

                        <input type="hidden" name="status" value="Pending">
                        <input type="hidden" name="amount" id="amount">

                        <button type="submit" class="submit-btn">Realizar depósito</button>
                    </div>
                </form>

                <!--<div class="row">
                        <div class="col-md-8">
                            <form action="javascript:;" method="post" id="submitpaymentform">
                                @csrf
                                <div class="row">
                                    <div class="mb-4 col-md-12">
                                        <h5 class="card-title ">Introduzca el monto</h5>
                                        <input class="form-control " placeholder="Introduzca el monto"
                                            min="{{ $moresettings->minamt }}" type="number" name="amount" required>
                                    </div>
                                    <div class="mb-4 col-md-12">
                                        <input type="hidden" name="payment_method" id="paymethod" value="Bank Transfer">
                                    </div>
                                    
                                    
                                    @if (count($dmethods) > 0)
                                        <div class="mt-2 mb-1 col-md-12">
                                            <input type="submit" class="px-5 btn btn-primary btn-lg"
                                                value="Proceder al pago">
                                        </div>
                                        <input type="hidden" id="lastchosen" value="12">
                                    @endif
                                </div>
                            </form>
                        </div>
                        <div class="mt-4 col-md-4">
                            <div class="card">

                                <div class="card-body">
                                    <div class="pb-4">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h6 class="mb-0">Total Deposit</h6>
                                                <span class="text-sm text-muted">-</span>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="mb-1">
                                                    <b>{{ $settings->currency }}{{ number_format($deposited, 2, '.', ',') }}
                                                    </b>
                                                </h6>
                                                <span class="text-sm text-muted">Amount</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="actions d-flex justify-content-between">
                                        <a href="{{ route('accounthistory') }}" class="action-item">
                                            <span class="btn-inner--icon">View deposit history</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Bootstrap Notify -->
<script src="{{ asset('dash2/libs/bootstrap-notify/bootstrap-notify.min.js') }} "></script>

<script>
    // Para manejar la selección de las cantidades y actualizar el campo "Valor"
    const amountButtons = document.querySelectorAll('.amount-btn');
    const valueField = document.getElementById('value');

    amountButtons.forEach(button => {
        button.addEventListener('click', () => {
            const amount = button.getAttribute('data-value');
            valueField.value = amount;
            document.getElementById('amount').value = amount;
        });
    });

    async function ponerPrecio(){

        let precio = document.getElementById('value').value;

        if(parseFloat(precio) > 0){

            document.getElementById('value').value = precio;
            document.getElementById('amount').value = precio;
        }else{

            document.getElementById('value').value = '';
            document.getElementById('amount').value = '';
        }
    }

    async function ponerProducto(){

        let producto = await localStorage.getItem('datosProducto');

        if(producto != null){

            document.getElementById('payment_mode').value = producto;

            await localStorage.removeItem('datosProducto');
        }
    }

    window.location.onload = ponerProducto();

</script>

@include('purpose.user.script')

@endsection
@endsection