@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('N°')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('N° Virement/Chèque')</th>
                                    <th>@lang('Délégué')</th>
                                    <th>@lang('Montant du financement (FCFA)')</th>
                                    <th>@lang('Prix Unitaire (FCFA)')</th>
                                    <th>@lang('Poids attendu (Kg)')</th>
                                    <th>@lang('Poids livré')</th>
                                    <th>@lang('Balance des comptes')</th>
                                    <th>@lang('Creations Date')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($financements as $finance)
                                    <tr>
                                        <td>
                                            <span class="fw-bold d-block">{{ $loop->iteration }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold d-block">{{ __($finance->datefinance) }}</span> 
                                        </td>
                                        <td>
                                            <span class="fw-bold d-block">{{ __($finance->numeroVirementCheque) }}</span> 
                                        </td>
                                        <td>
                                            <span class="d-block">{{ $finance->user->lastname }} {{ $finance->user->firstname }}</span> 
                                        </td>
                                        <td>
                                            <span class="d-block">{{ number_format($finance->montant,0, '', ' ')  }}</span> 
                                        </td>
                                        <td> 
                                            <span>{{ number_format($finance->prixunitaire,0, '', ' ')  }}</span>
                                        </td>
                                        <td>
                                            <span class="d-block">{{ number_format($finance->poidsattendu,0, '', ' ') }}</span> 
                                        </td> 
                                        <td>
                                        @if($finance->poidslivre>=$finance->poidsattendu) <span  style="color:#ff0303; font-weight:bolder;">{{ number_format($finance->poidslivre,0, '', ' ') }}</span> @else <span style="color:#06d909; font-weight:bolder;">{{ number_format($finance->poidslivre,0, '', ' ') }} </span> @endif
                                          
                                        </td>
                                        <td>
                                        @if($finance->balancefinale>0) <span  style="color:#06d909; font-weight:bolder;">{{ number_format($finance->balancefinale,0, '', ' ') }}</span> @else <span  style="color:#ff0303; font-weight:bolder;">{{ number_format($finance->balancefinale,0, '', ' ') }}</span> @endif 
                                        </td>
                                        
                                        <td>
                                            <span class="d-block">{{ showDateTime($finance->created_at) }}</span>
                                            <span>{{ diffForHumans($finance->created_at) }}</span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline--primary editCooperative"
                                                data-id="{{ $finance->id }}"
                                                data-user="{{ $finance->user_id }}"
                                                data-montant="{{ $finance->montant }}"
                                                data-cheque="{{ $finance->numeroVirementCheque }}"
                                                data-prix="{{ $finance->prixunitaire }}" 
                                                data-pattendu="{{ $finance->poidsattendu }}"
                                                data-binitiale="{{ $finance->balanceinitiale }}"
                                                data-bfinale="{{ $finance->balancefinale }}"
                                                data-plivre="{{ $finance->poidslivre }}"
                                                data-datefinance="{{ $finance->datefinance }}"
                                                 ><i
                                                    class="las la-pen"></i>@lang('Edit')</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if($financements->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($financements) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

    <div id="cooperativeModel" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Créer un nouveau Financement')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i> </button>
                </div>
                <form action="{{ route('admin.financement.delegue.store') }}" class="resetForm" method="POST">
                    @csrf
                    <input type="hidden" name="id"> 
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Nom du délégué')</label>
                            <select class="form-control" name="user" id="user" required>
                                    <option value="">@lang('Choisir un délégué')</option>
                                    @foreach ($delegues as $delegue)
                                        <option value="{{ $delegue->id }}">{{ $delegue->nom }}</option>
                                    @endforeach
                                </select>
                        </div>  
                        <div class="form-group">
                            <label>@lang('N° Virement/Chèque')</label>
                            <input type="text" class="form-control" name="cheque" required>
                        </div>

                        <div class="form-group">
                            <label>@lang('Montant du financement')</label>
                            <input type="number" class="form-control" name="montant" required>
                        </div>

                        <div class="form-group">
                            <label>@lang('Prix Unitaire (FCFA)')</label>
                            <input type="number" class="form-control" name="prix" required>
                        </div>

                        <div class="form-group">
                            <label>@lang('Date de financement')</label>
                            <input type="date" class="form-control" name="datefinance" required>
                        </div>
                        

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Envoyer')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Search here..." />
    <button class="btn  btn-outline--primary h-45 addNewCooperative"><i class="las la-plus"></i>@lang("Ajouter nouveau")</button>
@endpush


@push('script')
    <script>
        (function($) {
            "use strict";
            $('.addNewCooperative').on('click', function() {
                $('.resetForm').trigger('reset');
                $('#cooperativeModel').modal('show');
            });
            $('.editCooperative').on('click', function() {
                let title = "@lang('Update Financement')";
                var modal = $('#cooperativeModel');
                let id = $(this).data('id');
                let user = $(this).data('user');
                let montant = $(this).data('montant');
                let cheque = $(this).data('cheque');
                let prix = $(this).data('prix');
                let pattendu = $(this).data('pattendu');
                let binitiale = $(this).data('binitiale');
                let bfinale = $(this).data('bfinale');
                let plivre = $(this).data('plivre');
                let datefinance = $(this).data('datefinance');
                modal.find('.modal-title').text(title)
                modal.find('input[name=cheque]').val(cheque);
                modal.find('input[name=montant]').val(montant);
                modal.find('input[name=id]').val(id);
                modal.find('select[name=user]').val(user);
                modal.find('input[name=prix]').val(prix);
                modal.find('input[name=pattendu]').val(pattendu);
                modal.find('input[name=binitiale]').val(binitiale);
                modal.find('input[name=bfinale]').val(bfinale);
                modal.find('input[name=plivre]').val(plivre);
                modal.find('input[name=datefinance]').val(datefinance);
                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/fcadmin/js/spectrum.js') }}"></script>
@endpush

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/fcadmin/css/spectrum.css') }}">
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),  
                showButtons: false,
                move: function(color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function() {
                var clr = $(this).val(); 
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });
 
        })(jQuery);
    </script>
@endpush
