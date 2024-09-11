@extends("admin.base.base")

@section('content-admin')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                @if(isset($make))
                     <h5>Modifier une marque</h5>
                @else
                     <h5>Enregistrer une marque</h5>
                @endif
            </div>
            <!-- Message de succès -->
            @if(session('success'))
                <div class="alert alert-subtle-success" role="alert">{{ session('success') }}</div>
            @endif
            <div class="card-body">

                @if(isset($make))

                    <form action="{{ route('makes.update', $make->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                @else

                    <form action="{{ route('makes.store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                @endif

                    @csrf
                    <div class="mb-3">
                        <label class="form-label mb-2" for="exampleFormControlInput">Libelle de la marque </label>
                        <input class="form-control" id="exampleFormControlInput" type="text" placeholder="Libelle" name="name" required value="{{ isset($make) ? $make->name : old('name') }}">
                    </div>
                    <div class="mb-0">
                        <label class="form-label mb-2" for="exampleTextarea">Logo de la marque </label>
                        <input class="form-control" id="exampleTextarea" type="file"  name="logo" required>
                        @if(isset($make) && $make->logo)
                            <img src="{{ asset('logos/' . $make->logo) }}" alt="{{ $make->name }}" width="100" class="mt-2">
                        @endif
                    </div>

                    <div class="mb-0 text-end mt-2">
                        <button class="btn btn-primary">
                            {{ isset($make) ? 'Modifier' : 'Enregistrer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Liste des marques</h5>
            </div>

            <div class="card-body">

                <div id="tableExample4" data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;payment&quot;],&quot;page&quot;:5,&quot;pagination&quot;:true,&quot;filter&quot;:{&quot;key&quot;:&quot;payment&quot;}}">
                    <div class="table-responsive">
                      <table class="table table-sm fs-9 mb-0">
                        <thead>
                          <tr class="bg-body-highlight">
                            <th class="sort border-top border-translucent ps-3 desc" data-sort="name">Logo</th>
                            <th class="sort border-top border-translucent" data-sort="email">Libelle</th>
                            <th class="sort border-top border-translucent pe-3" data-sort="payment">Date</th>
                            <th class="sort border-top border-translucent pe-3">Action</th>
                          </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($makes as $make)
                            <tr>
                                <td class="align-middle ps-3 name">
                                    <img src="{{ asset('logos/' . $make->logo) }}" alt="{{ $make->name }}" width="50" class="rounded-circle">
                                </td>
                                <td class="align-middle email">{{ $make->name }}</td>
                                <td class="align-middle payment py-3 pe-3">
                                    {{ $make->created_at }}
                                </td>
                                <td class="align-middle payment d-flex py-3 pe-3">
                                    <a href="{{ route('makes.edit', $make->id) }}" class="btn btn-primary me-2">
                                        <span class="fas fa-edit fs-9"></span>
                                    </a>
                                    <form action="{{ route('makes.destroy', $make->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                            <span class="fas fa-trash fs-9"></span>
                                        </button>
                                    </form>

                                </td>
                              </tr>
                            @endforeach

                        </tbody>
                      </table>
                    </div>
                    <div class="d-flex justify-content-between mt-3"><span class="d-none d-sm-inline-block" data-list-info="data-list-info">1 to 5 <span class="text-body-tertiary"> Items of </span>10</span>
                      <div class="d-flex"><button class="page-link disabled" data-list-pagination="prev" disabled=""><svg class="svg-inline--fa fa-chevron-left" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"></path></svg><!-- <span class="fas fa-chevron-left"></span> Font Awesome fontawesome.com --></button>
                        <ul class="mb-0 pagination"><li class="active"><button class="page" type="button" data-i="1" data-page="5">1</button></li><li><button class="page" type="button" data-i="2" data-page="5">2</button></li></ul><button class="page-link pe-0" data-list-pagination="next"><svg class="svg-inline--fa fa-chevron-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"></path></svg><!-- <span class="fas fa-chevron-right"></span> Font Awesome fontawesome.com --></button>
                      </div>
                    </div>
                  </div>

            </div>
        </div>
    </div>





</div>

@endsection
