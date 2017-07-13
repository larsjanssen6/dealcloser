@extends('layout.app')
@section('content')

    @component('layout/hero')
        PRODUCTEN
    @endcomponent

    <div class="container">
        <div class="section">
            @if(!$products->isEmpty())
                @can('register-relations')
                    <div class="column">
                        <a href="#" class="button is-primary is-outlined">
                            Nieuw product
                        </a>
                    </div>
                @endcan
            @endif

            @if(!$products->isEmpty())
                <div class="column">
                    <products inline-template v-cloak>
                        <div>
                            <table class="table">
                                <thead class="thead-is-blue">
                                    <tr>
                                        <th>
                                            <abbr>Product</abbr>
                                        </th>

                                        <th>
                                            <abbr>Verkoopprijs</abbr>
                                        </th>

                                        <th>
                                            <abbr>Aantal</abbr>
                                        </th>

                                        <th>
                                            <abbr>Totaal omzet</abbr>
                                        </th>

                                        <th>
                                            <abbr>Inkoopprijs</abbr>
                                        </th>

                                        <th>
                                            <abbr>Totale inkoop</abbr>
                                        </th>

                                        <th>
                                            <abbr>Bruto marge</abbr>
                                        </th>

                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($products as $product)
                                        <tr @click="show({{json_encode($product->id)}})">
                                            <td>
                                                {{ $product->name }}
                                            </td>

                                            <td>
                                                {{ toMoney($product->price) }}
                                            </td>

                                            <td>
                                                {{ $product->amount }}
                                            </td>

                                            <td>
                                                {{ toMoney($product->revenue) }}
                                            </td>

                                            <td>
                                                {{ toMoney($product->purchase) }}
                                            </td>

                                            <td>
                                                {{ toMoney($product->totalPurchase) }}
                                            </td>

                                            <td>
                                                {{ toMoney($product->grossMargin) }}
                                            </td>

                                            <td>
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </products>
                </div>
            @else
                <div class="notification is-info">
                    <p>
                        Er zijn momenteel geen producten.

                        @can('register-products')
                            Maak deze <a href="#">hier</a> aan.
                        @endcan
                    </p>
                </div>
            @endif
        </div>

        <div class="column is-4 is-offset-4">
            {{ $products->links('vendor.pagination.default') }}
        </div>
    </div>
@endsection