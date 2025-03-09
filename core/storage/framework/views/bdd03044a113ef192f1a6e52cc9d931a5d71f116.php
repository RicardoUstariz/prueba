<style>
    .container {
        text-align: center;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 20px;
        margin-bottom: 20px;
    }

    .progress-bar {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-direction: row;
        background: transparent;
    }

    .step {
        /*width: 100px;*/
        padding: 10px;
        text-align: center;
        border: 2px solid black;
        border-radius: 10px;
        font-weight: bold;
        color: #000;
    }

    .active1 {
        background-color: limegreen;
        color: white;
    }

    .loading-spinner {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #888888;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 20px auto;
    }

    @keyframes  spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    h2 {
        margin: 20px 0;
    }

    button {
        background-color: #3f007f;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .imgPdf {
        width: 120px;
        margin: 20px auto;
        display: block;
        cursor: pointer;
    }

    button:hover {
        background-color: #29005a;
    }
</style>
<div class="container" id="actualizacion-contador">
    <h1>DEPÓSITO</h1>

    <div class="progress-bar">
        <div class="step <?php echo e($deposit->status == 'Pending' ? 'active1' : ''); ?>">PENDIENTE</div>
        <div class="step <?php echo e($deposit->status == 'Processing' ? 'active1' : ''); ?>">PROCESANDO</div>
        <div class="step <?php echo e($deposit->status == 'Processed' ? 'active1' : ''); ?>">COMPLETO</div>
    </div>

    <div class="loading-spinner" id="loading-spinner"
        style="display: <?php echo e($deposit->status == 'Processed' ? 'none' : 'block'); ?>;"></div>
    <h2>ESTADO: <span id="estado"><?php echo e($deposit->status); ?></span></h2>

    <div id="procedado"></div>
</div>

<script>
    setInterval(function () {

        let protocolo = window.location.protocol;  // Obtiene el protocolo (ejemplo: 'http:' o 'https:')
        let dominio = window.location.hostname;

        if(dominio == '127.0.0.1'){

            let puerto = dominio + ':8000';

            dominio = puerto;
        }

        fetch(protocolo + '//' + dominio + '/dashboard/fetch-deposito/<?php echo e($deposit->id); ?>', {
            method: 'GET',
            mode: 'no-cors',
        })
            .then(response => response.json())
            .then(data => { 

                if(data.status == 'expited' || data.status == undefined){

                    document.getElementById('actualizacion-contador').innerHTML = '<h1>ESTA TRANSACCIÓN YA EXPIRO</h1>';
                    document.getElementById('enCola').setAttribute('style', 'display: none;');

                    return;
                }

                const estado = document.getElementById('estado');
                const steps = document.querySelectorAll('.step');

                if (data.status === 'Processing') {

                    estado.textContent = 'PROCESANDO';
                    steps[0].classList.remove('active1');
                    steps[1].classList.add('active1');
                    document.getElementById('enCola').setAttribute('style', 'display: none;');
                } else if (data.status === 'Processed') {

                    estado.textContent = 'COMPLETO';
                    steps[1].classList.remove('active1');
                    steps[2].classList.add('active1');

                    document.getElementById('loading-spinner').setAttribute('style', 'display: none;');
                    document.getElementById('procedado').innerHTML = '<img class="imgPdf" src="<?php echo e(asset('assets/img/pdf.svg')); ?>" /><br><button onclick="window.open(\'<?php echo e(route('depositofactura', $deposit->id)); ?>\', \'_blank\')" class="button">IMPRIMIR FACTURA</button>';
                
                    document.getElementById('enCola').setAttribute('style', 'display: none;');
                } else {

                    estado.textContent = 'PENDIENTE';
                    steps[2].classList.remove('active1');
                    steps[0].classList.add('active1');
                }
            })
            .catch(error => console.error('Error:', error));
    }, 1000);
</script><?php /**PATH /home/nb9pvggwxcwi/public_html/ultra.multipagos.co/core/resources/views/purpose/livewire/user/deposit/proceso-deposito.blade.php ENDPATH**/ ?>