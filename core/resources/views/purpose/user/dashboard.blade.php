@extends('layouts.dash')
@section('title', $title)
@section('content')

<style>
    header {
        background-color: #3c1053;
        color: white;
        padding: 10px;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }

    .saldo-btn {
        background-color: #4c2889;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
    }

    .saldo-btn:hover {
        background-color: #3c1053;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .user-name {
        font-weight: bold;
        color: orange;
    }

    .user-id {
        font-size: 12px;
        color: #666;
    }

    nav ul {
        display: flex;
        justify-content: center;
        background-color: #3c1053;
        padding: 10px 0;
        margin-top: 10px;
        list-style: none;
    }

    .nav-btn {
        background-color: transparent;
        color: white;
        border: none;
        padding: 10px 20px;
        margin: 0 10px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 30px;
    }

    .nav-btn.active {
        background-color: #00d1d0;
    }

    .nav-btn:hover {
        background-color: #4c2889;
    }

    .payment-options {
        padding: 20px;
    }

    .option {
        display: flex;
        align-items: center;
        background-color: white;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .option .icon {
        font-size: 24px;
        margin-right: 15px;
    }

    .option .info h3 {
        margin-bottom: 5px;
    }

    .option .info p {
        color: #666;
    }

    /* Barra de búsqueda */
    .search-bar {
        width: 80%;
        max-width: 500px;
        display: flex;
        align-items: center;
        border: 2px solid #3d0057;
        border-radius: 30px;
        padding: 5px 15px;
        margin-bottom: 20px;
    }

    .search-bar input {
        border: none;
        outline: none;
        width: 100%;
        padding: 10px;
        font-size: 16px;
    }

    .search-bar svg {
        fill: #3d0057;
        width: 24px;
        height: 24px;
    }

    /* Título */
    .title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Contenedor de productos */
    .product-container {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        justify-content: center;
    }

    /* Estilos para cada tarjeta de producto */
    .product {
        width: 120px;
        height: 120px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 2px solid #a3f3ff;
        border-radius: 8px;
        text-align: center;
        font-size: 12px;
        font-weight: bold;
        color: #3d0057;
        padding: 10px;
        gap: 5px;
        cursor: pointer;
    }

    /* Ajustes de los íconos */
    .product img {
        width: 60px;
        height: 60px;
    }
</style>

<!-- Page title -->
<div class="page-title">
    <div class="row justify-content-between align-items-center">
        <div class="mb-3 col-md-6 mb-md-0">
            <h5 class="mb-0 text-white h3 font-weight-400">Bienvenido, {{ Auth::user()->name }}!</h5>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" style="min-height: 100vh;">

                <!--<header>
                    <div class="top-bar">
                        <button class="saldo-btn">Comprar saldo</button>
                        <div class="user-info">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <span class="user-id" style="color: #fff;">ID {{ Auth::user()->id }}</span>
                        </div>
                    </div>
                    <nav>
                        <ul>
                            <li><button class="nav-btn active">Comprar</button></li>
                            <li><button class="nav-btn">Reportar compra</button></li>
                            <li><button class="nav-btn">Reporte</button></li>
                        </ul>
                    </nav>
                </header>-->

                <!--<div class="row" style="padding: 5%;">
                    <div class="col-12">
                        <div class="nk-block-head-content">
                            <h5 class="text-primary h5">Resumen de cuenta</h5>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h6 class="mb-1 text-muted">Saldo de cuenta</h6>
                                        <span
                                            class="mb-0 h5 font-weight-bold">{{ $settings->currency }}{{ number_format(Auth::user()->account_bal, 2, '.', ',') }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="text-white icon bg-gradient-primary rounded-circle icon-shape">
                                            <i class="fas fa-sack-dollar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->

                <div class="row" style="padding: 5%;">
                    <div class="col-sm">

                        <h5>Estado del servicio (<span id="estadoServicio"></span>)</h5>

                        <!-- Barra de búsqueda -->
                        <div class="search-bar">
                            <input type="text" placeholder="Buscar producto" id="input-busqueda"
                                onkeyup="buscarProsucto()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M15.5 14h-.79l-.28-.27a6.471 6.471 0 001.48-5.34C14.72 5.02 12.61 3 10 3 6.69 3 4 5.69 4 9s2.69 6 6 6c1.61 0 3.09-.62 4.22-1.63l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-5.5 0C7.01 14 5 11.99 5 9s2.01-5 4.5-5S14 6.01 14 9s-2.01 5-4.5 5z" />
                            </svg>
                        </div>

                        <!-- Título -->
                        <div class="title">Multiproducto</div>

                        <!-- Contenedor de productos -->
                        <div class="product-container" id="productos">
                            <!--<div class="product">
                                <img src="{{ asset('assets/img/nequilogo') }}" alt="Be Ingresar">
                                <span>INGRESAR</span>
                            </div>-->
                        </div>

                    </div>
                </div>

                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="nk-block-head-content">
                            <h6 class="text-primary h5">Transacciones recientes <span
                                    class="text-base count">({{ count($t_history) }})</span>
                            </h6>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!--<div class="mb-2 text-right">
                                    <a href="{{ route('accounthistory') }}"> <i class="fas fa-clipboard"></i> View
                                        all
                                        transactions</a>
                                </div>-->
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>Fecha</th>
                                                <th>Tipo</th>
                                                <th>Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($t_history as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->created_at->toDayDateTimeString() }}
                                                    </td>
                                                    <td>
                                                        {{ $item->type }}
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-secondary">
                                                            {{ $settings->currency }}{{ number_format($item->amount) }}</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <td colspan="3">
                                                    Aún no hay registro
                                                </td>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <!--<section class="payment-options">
                    <div class="option">
                        <div class="icon">💬</div>
                        <div class="info">
                            <h3>Link de Cobro</h3>
                            <p>Tu cliente recibirá un mensaje con un link para que efectúe el pago</p>
                        </div>
                    </div>
                    <div class="option">
                        <div class="icon">💳</div>
                        <div class="info">
                            <h3>Transferencia bancaria con PSE</h3>
                        </div>
                    </div>
                    <div class="option">
                        <div class="icon">🏦</div>
                        <div class="info">
                            <h3>Transferencia con botón Bancolombia</h3>
                        </div>
                    </div>
                </section>-->

            </div>
        </div>
    </div>
</div>

<script>
    // Puedes agregar la lógica que necesites aquí.
    // Por ejemplo, cambiar la clase 'active' de los botones de navegación al hacer clic.
    const navButtons = document.querySelectorAll('.nav-btn');

    navButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            navButtons.forEach(button => button.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    let productos = [
        {
            img: '{{ asset('assets/img/bancolombialogo.png') }}',
            tipo: 'DEPÓSITO',
            name: 'Bancolombia',
        },
        {
            img: '{{ asset('assets/img/bancolombialogo.png') }}',
            tipo: 'RETIRO',
            name: 'Bancolombia',
        },
        {
            img: '{{ asset('assets/img/logodaviplata.png') }}',
            tipo: 'DEPÓSITO',
            name: 'Daviplata',
        },
        {
            img: '{{ asset('assets/img/logodaviplata.png') }}',
            tipo: 'RETIRO',
            name: 'Daviplata',
        },
        {
            img: '{{ asset('assets/img/nequilogo.png') }}',
            tipo: 'DEPÓSITO',
            name: 'Nequi',
        },
        {
            img: '{{ asset('assets/img/nequilogo.png') }}',
            tipo: 'RETIRO',
            name: 'Nequi',
        },
        {
            img: '{{ asset('assets/img/logomiltipagos.png') }}',
            tipo: 'MULTIPAGOS',
            name: 'Multipagos',
        },
    ];

    function listarProdcutos() {

        document.getElementById('productos').innerHTML = '';

        for (let producto of productos) {

            document.getElementById('productos').innerHTML += '<div class="product" onclick="verProducto(\'' + producto.name + '\', \'' + producto.tipo + '\')">' +
                '<img src="' + producto.img + '" alt="Ptm Ingresar">' +
                '<span>' + producto.tipo + '</span>' +
                '</div>';
        }
    }

    function buscarProsucto() {

        let query = document.getElementById('input-busqueda').value;

        if (query == '') {

            listarProdcutos();
        } else {

            document.getElementById('productos').innerHTML = '';

            const datos = productos;

            const regex = new RegExp(`${query.trim()}`, 'i');

            const busqueda = datos.filter(datos => datos.name.search(regex) >= 0);

            for (let producto of busqueda) {

                document.getElementById('productos').innerHTML += '<div class="product" onclick="verProducto(\'' + producto.name + '\', \'' + producto.tipo + '\')">' +
                    '<img src="' + producto.img + '" alt="Ptm Ingresar">' +
                    '<span>' + producto.tipo + '</span>' +
                    '</div>';
            }
        }
    }

    async function verProducto(name, tipo) {

        if (tipo == 'DEPÓSITO') {

            await localStorage.setItem('datosProducto', name);

            window.location.href = '{{ route('deposits') }}';
        } else if (tipo == 'RETIRO') {

            await localStorage.setItem('datosProducto', name);

            window.location.href = '{{ route('withdrawalsdeposits') }}';
        } else if (tipo == 'MULTIPAGOS') {

            window.location.href = 'https://app.multipagos.co/';
        }
    }

    window.location.onload = listarProdcutos();

    async function verEstadoServicio() {

        fetch('{{ route('dataservicio') }}', {
            method: 'GET',
            mode: 'no-cors',
        })
            .then(response => response.json())
            .then(data => {

                if (data.activo == 1) {

                    document.getElementById('estadoServicio').innerHTML = 'Online';
                } else {

                    document.getElementById('estadoServicio').innerHTML = 'Offline';
                }
            })
            .catch(error => console.error('Error:', error));
    }

    window.location.onload = verEstadoServicio();

</script>

@endsection