<div class="d-flex gap-2">
    <a href="javascript:void(0)" 
       class="btn btn-icon btn-sm btn-view" 
       data-id="{{ $budget->id }}"
       title="Ver presupuesto">
        <i class="ri-eye-line"></i>
    </a>
    @if($budget->status == 'Pendiente')
    <a href="{{ route('budget.edit', $budget->id) }}" 
       class="btn btn-icon btn-sm btn-edit"
       title="Editar presupuesto">
        <i class="ri-edit-line"></i>
    </a>
    <button type="button" 
            class="btn btn-icon btn-sm btn-delete" 
            data-id="{{ $budget->id }}"
            title="Eliminar presupuesto">
        <i class="ri-delete-bin-line"></i>
    </button>
    @endif
    @if($budget->status == 'Aprobado')
    <a href="javascript:void(0)" data-id="{{ $budget->id }}" data-amount="{{ $pendiente }}"
        data-currency="{{ $moneda }}"
       class="btn btn-icon btn-sm text-success payBudget"
       title="Pagar presupuesto">
        <i class="ri-money-dollar-circle-fill"></i>
    </a>
    @endif
</div>