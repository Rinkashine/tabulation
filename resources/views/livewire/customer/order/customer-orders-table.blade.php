<div class="overflow-x-auto">
    @forelse ($Orders as $order)
        <div class="mt-2 mb-5 border rounded-md">
            <div class="flex flex-row justify-between px-3 py-5 border">
                <div>
                    #{{ $order->id }}
                    @if ($order->status == "Completed")
                        <span class="text-success">{{ $order->status }} </span>
                    @elseif($order->status == "Cancelled" || $order->status == "Rejected")
                        <span class="text-danger">{{ $order->status }}</span>
                    @else
                        <span class="text-pending">{{ $order->status }}</span>
                    @endif
                </div>
                <div class="px-2 rounded-full bg-slate-50">
                    <span class="text-center whitespace-nowrap"> <a href="{{ Route('order.show',$order->id ) }}"> <i class="w-4 h-4 mr-1 fa-solid fa-eye"></i> Show Details</a></span>

                </div>
            </div>
            <div>
                <table class="table table-fixed bg-slate-50 table-bordered">
                    <tbody>
                        @foreach ($order->orderTransactions as $product)
                            <tr>
                                <td class="text-center truncate  whitespace-nowrap  ">
                                    {{ $product->product_name }}
                                </td>
                                <td class="text-center  whitespace-nowrap ">
                                    {{ $product->quantity }} pcs
                                </td>
                                <td class="text-center  whitespace-nowrap ">
                                    ₱{{ number_format($product->price,2) }}
                                </td>
                            </tr>

                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right">
                                @php
                                    $total = 0
                                @endphp
                                @foreach ($order->orderTransactions as $product)
                                    <?php $total += $product->quantity * $product->price ?>
                                @endforeach
                               Total: ₱{{number_format($total,2)}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <tr>
            <td colspan="5" class="font-medium">No Orders Found</td>
        </tr>
    @endforelse

    <div class="flex flex-wrap items-center col-span-12 mt-5 intro-y sm:flex-row sm:flex-nowrap">
        <nav class="w-full sm:w-auto sm:mr-auto">
            {!! $Orders->onEachSide(1)->links() !!}
        </nav>
        <select wire:model="perPage" class="w-20 mt-3 form-select box sm:mt-0">
            <option>5</option>
            <option>10</option>
            <option>15</option>
            <option>25</option>
        </select>
    </div>
</div>
