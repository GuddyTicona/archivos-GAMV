<form action="{{ $route }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @if(in_array($method, ['PUT','PATCH']))
        @method($method)
    @endif

    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <h5 class="mb-0">
                {{ in_array($method, ['PUT','PATCH']) ? 'Editar Área de Archivo' : 'Registrar Nueva Área de Archivo' }}
            </h5>
        </div>

        <div class="card-body">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <label for="nombre" class="form-label fw-semibold">Nombre del Área</label>
                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        class="form-control @error('nombre') is-invalid @enderror"
                        placeholder="Nombre del área"
                        value="{{ old('nombre', optional($area)->nombre) }}"
                        required
                    >
                    @error('nombre')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-8">
                    <label for="descripcion" class="form-label fw-semibold">Descripción</label>
                    <textarea
                        id="descripcion"
                        name="descripcion"
                        class="form-control @error('descripcion') is-invalid @enderror"
                        rows="2"
                        placeholder="Descripción del área"
                        required
                    >{{ old('descripcion', optional($area)->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary">
                {{ in_array($method, ['PUT','PATCH']) ? 'Actualizar' : 'Guardar' }}
            </button>
            <a href="{{ route('areas-archivos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </div>
</form>

<script>
(() => {
  'use strict';
  const forms = document.querySelectorAll('.needs-validation');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', e => {
      if (!form.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
      }
      form.classList.add('was-validated');
    });
  });
})();
</script>
