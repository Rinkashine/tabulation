<div>
    <div class="overflow-x-auto">
        <table class="table rounded table-fixed bg-slate-50 table-bordered">
            <thead class="bg-white">
                <tr>
                    <th class="whitespace-nowrap">Product Name</th>
                    <th class="text-center whitespace-nowrap">Date</th>
                    <th class="text-center whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($wishlists as $wishlist)
                <tr>
                    <td class="whitespace-nowrap"><a href="{{ Route('productshow', $wishlist->product_id)  }}">{{ $wishlist->product->name }}</a></td>
                    <td class="text-center whitespace-nowrap">{{ $wishlist->created_at }}</td>
                    <td class="text-center whitespace-nowrap text-danger">
                        <button type="submit" wire:click="RemoveProduct({{$wishlist->id}})">
                            <i class="fa-regular fa-trash-can"></i>
                            Remove
                        </button>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center whitespace-nowrap">It's empty here, add Products to your Wishlist!</td>

                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
