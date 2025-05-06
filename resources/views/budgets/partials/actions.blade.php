<a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill"
    data-bs-toggle="tooltip" title="Ver presupuesto"
    onclick="viewRecord({{ $id }})">
    <i class="ri-eye-fill ri-20px"></i>
</a>

<a href="{{ route('supplier.edit', $id) }}" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill"
    data-bs-toggle="tooltip" title="Editar presupuesto">
    <i class="ri-edit-2-line ri-20px"></i>
</a>

<a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill text-success"
    data-bs-toggle="tooltip" title="Aprobar presupuesto"
    onclick="">
    <i class="ri-delete-bin-7-line ri-20px"></i>
</a>

<a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary
    rounded-pill text-danger"
    data-bs-toggle="tooltip" title="Rechazar presupuesto"
    onclick="deleteRecord({{ $id }})">
    <i class="ri-delete-bin-7-line ri-20px"></i>
</a>