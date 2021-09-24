<div class="flex flex-col space-y-8 text-left items-start border-2 border-gray-800 p-8 rounded-xl">
    <div class="text-3xl">{{ $billing_type }}</div>

    <div class="text-gray-500 text-xl">You will have the opportunity to give me your money {{ $times }} times a month.</div>

    <div class="flex items-end py-8"><span class="font-bold -mb-2 pb-0 text-6xl">${{ $price }}</span><span class="text-2xl text-gray-500">/mo</span></div>

    @if($plan->stripe_price_id === $currentPlan)
    <div class="flex justify-cente">
        You've already subscribed for this plan.
    </div>
    
    @else
    <a href="{{ $checkout }}" class="w-full border-2 hover:border-gray-800 hover:text-white duration-150 hover:bg-gray-900 text-xl font-bold rounded-md p-2 flex justify-center text-gray-900 bg-white ">
        Checkout
    </a>
    @endif

    <div class="flex space-x-4 text-xl">
        <div>-</div>
        <div class="text-gray-500">You will be losing ${{ $price }} per month.</div>
    </div>

    <div class="flex space-x-4 text-xl">
        <div>+</div>
        <div class="text-gray-500">I'll get ${{ $price }} per month.</div>
    </div>
</div>