<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invite codes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 space-y-1">
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    @if(!request()->user()->reachedInviteCodeRequestLimit())
                        <form action="{{route('invites')}}" method="post">
                            @csrf

                            <x-button> Request an invite code</x-button>
                        </form>
                    @endif
                    <br>
                    @foreach($inviteCodes as $inviteCode)
                        <div>
                            @if($inviteCode->approved())
                                <span x-data x-on:click="window.navigator.clipboard.writeText($el.innerText)">{{$inviteCode->code}}</span>
                                ({{$inviteCode->quantity_used}} / {{$inviteCode->quantity}} uses)

                            @else
                               (Pending) requested at {{$inviteCode->created_at->toDateString() }}
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
