<div class="card" style="min-height: 100vh;">
    <div class="card-body">
        <div class="card-title">Transacciones</div>
        <div class="card-list" wire:poll.500ms>

            <div class="card-title">Depositos</div>

            @foreach($deposits as $deposit)

                <a href="{{ route('updatestatusdeposit', $deposit['deposit']['id']) }}">
                    <div class="item-list shadow-sm d-flex"
                        style="border: 2px solid #a3f3ff; border-radius: 5px; margin-bottom: 15px;">
                        <div class="info-user ml-3 text-decoration-none" style="display: flex; flex-direction: row;">
                            @if ($deposit['deposit']['payment_mode'] == 'Bancolombia')

                                <img src="{{ asset('assets/img/bancolombialogo.png') }}"
                                    style="width: 60px; display: inline-block; margin-right: 10px; border: 2px solid #a3f3ff; border-radius: 5px;" />
                            @elseif($deposit['deposit']['payment_mode'] == 'Daviplata')

                                <img src="{{ asset('assets/img/logodaviplata.png') }}"
                                    style="width: 60px; display: inline-block; margin-right: 10px; border: 2px solid #a3f3ff; border-radius: 5px;" />
                            @elseif($deposit['deposit']['payment_mode'] == 'Nequi')

                                <img src="{{ asset('assets/img/nequilogo.png') }}"
                                    style="width: 60px; display: inline-block; margin-right: 10px; border: 2px solid #a3f3ff; border-radius: 5px;" />
                            @endif

                            <div>
                                <div class="username font-weight-bolder">{{ $deposit['user']['name'] }}</div>
                                <div class="username">${{ $deposit['deposit']['amount'] }}</div>
                                <div class="status">{{ $deposit['deposit']['status'] }}</div>
                            </div>
                        </div>
                        <div style="padding-right: 10px;">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                <script>
                    playSound();
                </script>

            @endforeach

            <hr />

            <div class="card-title">Retiros</div>

            @foreach($withdrawals as $withdrawal)

                <a href="{{ route('updatestatuswithdrawal', $withdrawal['withdrawal']['id']) }}">
                    <div class="item-list shadow-sm d-flex"
                        style="border: 2px solid #a3f3ff; border-radius: 5px; margin-bottom: 15px;">
                        <div class="info-user ml-3 text-decoration-none" style="display: flex; flex-direction: row;">

                            @if ($withdrawal['withdrawal']['payment_mode'] == 'Bancolombia')

                                <img src="{{ asset('assets/img/bancolombialogo.png') }}"
                                    style="width: 60px; display: inline-block; margin-right: 10px; border: 2px solid #a3f3ff; border-radius: 5px;" />
                            @elseif($withdrawal['withdrawal']['payment_mode'] == 'Daviplata')

                                <img src="{{ asset('assets/img/logodaviplata.png') }}"
                                    style="width: 60px; display: inline-block; margin-right: 10px; border: 2px solid #a3f3ff; border-radius: 5px;" />
                            @elseif($withdrawal['withdrawal']['payment_mode'] == 'Nequi')

                                <img src="{{ asset('assets/img/nequilogo.png') }}"
                                    style="width: 60px; display: inline-block; margin-right: 10px; border: 2px solid #a3f3ff; border-radius: 5px;" />
                            @endif

                            <div>
                                <div class="username font-weight-bolder">{{ $withdrawal['user']['name'] }}</div>
                                <div class="username">${{ $withdrawal['withdrawal']['amount'] }}</div>
                                <div class="status">{{ $withdrawal['withdrawal']['status'] }}</div>
                            </div>
                        </div>
                        <div style="padding-right: 10px;">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                <script>
                    playSound();
                </script>

            @endforeach

        </div>
    </div>
</div>