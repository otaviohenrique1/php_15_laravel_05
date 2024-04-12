<form action="{{ $action }}" method="post">
{{-- <form action="/series/salvar" method="post"> --}}
    @csrf
    {{-- @isset($nome)
    @method('PUT')
    @endisset --}}
    @if ($update)
    @method('PUT')
    @endif
    <div class="mb-3">
        <label for="nome" class="form-text">Nome:</label>
        <input
            type="text"
            id="nome"
            name="nome"
            class="form-control"
            @isset($nome)value="{{ $nome }}"@endisset
        >
    </div>
    <button type="submit" class="btn btn-primary">Adicionar</button>
</form>
